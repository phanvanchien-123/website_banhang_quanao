<?php
namespace App\Http\Controllers\Client;

use Throwable;
use PayOS\PayOS;
use App\Models\User;
use App\Models\Carts;
use App\Models\Cart_items;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Untilities\Constant;
use Illuminate\Http\Request;
use App\Models\Order_Details;
use App\Models\ProductDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PaymentSuccessNotification;
use Illuminate\Support\Facades\Log;

// use App\Service\PayOSService;

class PayOSController extends Controller
{
    public function __construct()
    {
    }

    public function createPayment(Request $request) {
        // Tạo mã đơn hàng duy nhất
        $orderCode = intval(substr(strval(microtime(true) * 10000), -6));
        $amount = $request->input('amount') * 1000; 
        $couponCode = $request->input('applied_coupon_code');
        $coupon = Coupon::where('code', $couponCode)->first();
        
        // Tạo đơn hàng với trạng thái ban đầu là "pending"
        $order = new Order();
        $order->id = $orderCode;
        $order->user_id = auth()->id();
        $order->first_name = $request->input('first_name');
        $order->last_name = $request->input('last_name');
        $order->phone = $request->input('phone');
        $order->email = $request->input('email');
        $order->street_address = $request->input('street_address');
        $order->town_city = $request->input('town_city');
        $order->country = 'VietNam';
        $order->status = 1;
        $order->payment_type = '1';
        $order->total = $amount;
        $order->coupon_id = $coupon ? $coupon->id : null;
        $order->save();
        
        // Lưu thông tin giỏ hàng
        $userId = Auth::id();
        $cart = Carts::where('user_id', $userId)->firstOrFail();
        $cartItems = $cart->cartItems;

        foreach ($cartItems as $cartItem) {
            $data = [
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'qty' => $cartItem->quantity,
                'amount' => $cartItem->price,
                'total' => $cartItem->quantity * $cartItem->price,
                'size' => $cartItem->size,
                'color' => $cartItem->color,
            ];
            $orderDetail = Order_Details::create($data);
        }

        //dữ liệu cho PayOS
        $data = [
            "orderCode" => $orderCode,
            "amount" => $amount,
            "description" => "Thanh toán đơn hàng",
            "returnUrl" => route('QRsuccess'),
            "cancelUrl" => route('list')
        ];

        error_log($data['orderCode']);
        $PAYOS_CLIENT_ID = env('PAYOS_CLIENT_ID');
        $PAYOS_API_KEY = env('PAYOS_API_KEY');
        $PAYOS_CHECKSUM_KEY = env('PAYOS_CHECKSUM_KEY');

        $payOS = new PayOS($PAYOS_CLIENT_ID, $PAYOS_API_KEY, $PAYOS_CHECKSUM_KEY);
        try {
            $response = $payOS->createPaymentLink($data);
            return redirect($response['checkoutUrl']);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }


    public function success(Request $request)
    {
        return redirect()->route('dashboard.index')->with('PayOSsuccess', 'Payment successful!');
    }

    public function handleWebhook(Request $request)
    {
        $webhookData = json_decode($request->getContent(), true);

        Log::info('Webhook received', $webhookData);

        try {
            $PAYOS_CHECKSUM_KEY = env('PAYOS_CHECKSUM_KEY');
            $PAYOS_CLIENT_ID = env('PAYOS_CLIENT_ID');
            $PAYOS_API_KEY = env('PAYOS_API_KEY');

            $payOS = new PayOS($PAYOS_CLIENT_ID, $PAYOS_API_KEY, $PAYOS_CHECKSUM_KEY);
            $payOS->verifyPaymentWebhookData($webhookData);

            $orderCode = $webhookData['data']['orderCode'];
            $order = Order::where('id', $orderCode)->first();

            if ($order) {
                $order->update(['status' => 1]);
                $paymentDetails = [
                    'user' => $order->user_id,
                    'total' => $order->total,
                    'infor' => 'payOS',
                ];
                
                // Gửi thông báo cho tất cả admin có role 'super-admin'
                $admins = User::role('super-admin')->get();
                foreach ($admins as $admin) {
                    $admin->notify(new PaymentSuccessNotification($paymentDetails));
                    session()->flash('PaymentSuccess', 'Thanh toán thành công! +'. $order->total);
                }

                $this->processOrderDetails($order);

                // Xóa giỏ hàng của người dùng sau khi đơn hàng được cập nhật thành công
                // $cart = Carts::where('user_id', $order->user_id)->first();
                // if ($cart) {
                //     $cart->cartItems()->delete();
                //     $cart->delete();
                // }
                $cart = Carts::where('user_id', $order->user_id)->firstOrFail();
                $selectedItemIds = session('selected_cart_items', []);
                $cartItems = Cart_items::whereIn('id', $selectedItemIds)->where('cart_id', $cart->id)->get();
                Cart_items::whereIn('id', $selectedItemIds)->delete();
                session()->forget(['selected_cart_items', 'total', 'infor']);
            }

            return response()->json(['message' => 'Webhook handled successfully'], 200);
        } catch (\Throwable $th) {
            Log::error('Error handling webhook', ['error' => $th->getMessage()]);
            return response()->json(['message' => 'Error handling webhook', 'error' => $th->getMessage()], 500);
        }
    }

    protected function processOrderDetails($order)
    {
        $orderDetails = $order->orderDetails;

        foreach ($orderDetails as $orderDetail) {
            $product = Product::find($orderDetail->product_id);
            $productDetail = ProductDetail::where('product_id', $orderDetail->product_id)
                                          ->where('size', $orderDetail->size)
                                          ->where('color', $orderDetail->color)
                                          ->first();

            // Trừ số lượng từ bảng sản phẩm và chi tiết sản phẩm
            $product->qty -= $orderDetail->qty;
            $productDetail->qty -= $orderDetail->qty;

            $product->save();
            $productDetail->save();
        }
    }

}