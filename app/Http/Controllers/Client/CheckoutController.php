<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Carts;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Cart_items;
use App\Untilities\Constant;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutOrderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Service\Order\OrderServiceInterface;
use App\Service\OrderDetail\OrderDetailService;
use App\Notifications\PaymentSuccessNotification;
use App\Service\OrderDetail\OrderDetailServiceInterface;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    private $orderService;
    private $orderDetailService;
    public function __construct(OrderServiceInterface $orderService,
                                OrderDetailServiceInterface $orderDetailService
    
    )
    {
        $this->orderService = $orderService;
        $this->orderDetailService =$orderDetailService;
    }
    public function index(Request $request)
    {
        
      
        $coupons = Coupon::all(); 
        $userId = Auth::id();
        $cart = Carts::where('user_id', $userId)->firstOrFail();
        $selectedItemIds = session('selected_cart_items', []);
        $cartItems = Cart_items::whereIn('id', $selectedItemIds)->where('cart_id', $cart->id)->get();
        $totalItems = $cartItems->sum('quantity');
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    
        // Kiểm tra mã giảm giá
        $discount = 0;
        $couponCode = $request->session()->get('coupon_code');
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->first();
            if ($coupon && !$coupon->isExpired()) {
                $discount = $coupon->discount;
                $totalPrice -= $discount;
            } else {
                $request->session()->forget('coupon_code');
            }
        }
    
        $appliedCouponCode = session('applied_coupon_code');
    
        return view('Client.checkout.index', compact('cartItems', 'totalPrice', 'totalItems', 'discount', 'coupons', 'appliedCouponCode'));
    }
    public function addOrder(CheckoutOrderRequest $request)
    {
        $validated = $request->validated();
        $couponCode = $validated['applied_coupon_code'];
        $coupon = Coupon::where('code', $couponCode)->first();
        
        $order = new Order();
        $order->user_id = auth()->id();
        $order->address = $validated['address'];
        $order->home_address = $validated['home_address'];
        $order->phone = $validated['phone'];
        $order->email = $validated['email'];
        $order->status = Constant::order_status_ReceiveOrders;
        $order->payment_type = $validated['payment_type'];
        $order->coupon_id= $coupon->id ?? null;
    
        $userId = Auth::id();
        $cart = Carts::where('user_id', $userId)->firstOrFail();
        $selectedItemIds = session('selected_cart_items', []);
        $cartItems = Cart_items::whereIn('id', $selectedItemIds)->where('cart_id', $cart->id)->get();
       
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    
    // Kiểm tra mã giảm giá
    $discountAmount = 0;
    if ($request->has('applied_coupon_code')) {
        $couponCode = $request->input('applied_coupon_code');
        $coupon = Coupon::where('code', $couponCode)->first();
        if ($coupon) {
            if ($coupon->discount_type == 'fixed') {
                $discountAmount = $coupon->discount_value;
            } elseif ($coupon->discount_type == 'percent') {
                $discountAmount = ($totalPrice * $coupon->discount_value) / 100;
            }
            // Cập nhật tổng giá sau khi áp dụng mã giảm giá
            $totalPrice -= $discountAmount;
            $coupon->used_count += 1;
            $coupon->save();
        }
    }
    // Lưu tổng giá trị đơn hàng vào cơ sở dữ liệu
    $order->total = $totalPrice;
    $order->save();
    foreach ($cartItems as $cartItem) {
        $product = Product::find($cartItem->product_id);
        $productDetail = ProductDetail::where('product_id', $cartItem->product_id)
                                       ->where('size', $cartItem->size)
                                       ->where('color', $cartItem->color)
                                       ->first();
    
      // Trừ số lượng từ bảng sản phẩm và chi tiết sản phẩm
       $product->qty -= $cartItem->quantity;
       $productDetail->qty -= $cartItem->quantity;

       $product->save();
       $productDetail->save();
    }
    // Tính toán lại giá cho từng mục trong giỏ hàng và lưu vào chi tiết đơn hàng
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
        $this->orderDetailService->create($data);
    }
    
        if ($request->payment_type == 0) {
            // Gửi Email (nếu cần)
            $this->sendMail($order, $totalPrice);
    
            // Xóa giỏ hàng
            // Cart_items::whereHas('cart', function ($query) use ($userId) {
            //     $query->where('user_id', $userId);
            // })->delete();
            Cart_items::whereIn('id', $selectedItemIds)->delete();

    
            // Trả về kết quả thông báo
            return redirect('checkout/thanks');
        }
    }

    public function vnPayCheck(CheckoutOrderRequest $request){
        $validated = $request->validated();
        $couponCode = $validated['applied_coupon_code'];
        $coupon = Coupon::where('code', $couponCode)->first();

        $order = new Order();
        $order->user_id = auth()->id();
        $order->address = $validated['address'];
        $order->home_address = $validated['home_address'];
        $order->phone = $validated['phone'];
        $order->email = $validated['email'];
        $order->status = Constant::order_status_ReceiveOrders;
        $order->payment_type = $validated['payment_type'];
        $order->coupon_id= $coupon->id ?? null;
    
        $userId = Auth::id();
        $cart = Carts::where('user_id', $userId)->firstOrFail();
        $selectedItemIds = session('selected_cart_items', []);
        $cartItems = Cart_items::whereIn('id', $selectedItemIds)->where('cart_id', $cart->id)->get();
    
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    
        $discountAmount = 0;
        if ($request->has('applied_coupon_code')) {
            $couponCode = $request->input('applied_coupon_code');
            $coupon = Coupon::where('code', $couponCode)->first();
            if ($coupon) {
                if ($coupon->discount_type == 'fixed') {
                    $discountAmount = $coupon->discount_value;
                } elseif ($coupon->discount_type == 'percent') {
                    $discountAmount = ($totalPrice * $coupon->discount_value) / 100;
                }
                $totalPrice -= $discountAmount;
                $coupon->used_count += 1;
                $coupon->save();
            }
        }
        $order->total = $totalPrice;
        $order->save();
    

    
        foreach ($cartItems as $cart) {
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'qty' => $cart->quantity,
                'amount' => $cart->price,
                'total' => $cart->quantity * $cart->price,
                'size' => $cart->size,
                'color' => $cart->color,
            ];
            $this->orderDetailService->create($data);
        }
    
        if ($request->payment_type == 1) {
            $orders = $this->orderService->all();
            $userId = Auth::id();
            $cart = Carts::where('user_id', $userId)->firstOrFail();
            $cartItems = $cart->cartItems;
            $subtotal = $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });
    
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = route('checkout.vnpayReturn'); // Ensure this route exists
            $vnp_TmnCode = "V52DRY11";
            $vnp_HashSecret = "QVHYIETOHTABFJHAWQQRQQNYTGDACSWT";
            
            $vnp_TxnRef = $order->id; // Use current order ID
            $vnp_OrderInfo = 'Thanh toan don hang';
            $vnp_OrderType = 50;
            $vnp_Amount = $totalPrice * 100000;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'VNBANK';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    
            $inputData = [
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            ];
    
            ksort($inputData);
            $hashData = "";
            $query = "";
            foreach ($inputData as $key => $value) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            $hashData = ltrim($hashData, '&');
            $query = rtrim($query, '&');
    
            $vnpSecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
            $vnp_Url .= "?" . $query . '&vnp_SecureHash=' . $vnpSecureHash;
    
            return redirect()->away($vnp_Url);
        }
    }
 
    public function vnPayReturn(Request $request) {
        $vnp_HashSecret = "QVHYIETOHTABFJHAWQQRQQNYTGDACSWT";
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $inputData = $request->except('vnp_SecureHash');
        $vnp_OrderInfo = 'Thanh toan don hang';
    
        ksort($inputData);
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
        }
        $hashData = ltrim($hashData, '&');
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    
        if ($secureHash === $vnp_SecureHash) {
            $vnp_ResponseCode = $request->input('vnp_ResponseCode');
            $vnp_TxnRef = $request->input('vnp_TxnRef');
    
            $order = Order::find($vnp_TxnRef);
    
            if ($order) {
                if ($vnp_ResponseCode == '00') {
                    $subtotal = $order->total;
                    $this->sendMail($order, $subtotal);
                    // Notify admins about successful payment
                    $paymentDetails = [
                        'user' => auth()->user()->name,
                        'total' => $subtotal,
                        'infor' =>  $vnp_OrderInfo,
                    ];
                    $admins = User::role('super-admin')->get();
                    foreach ($admins as $admin) {
                        $admin->notify(new PaymentSuccessNotification($paymentDetails));
                    }
                    
                    // Payment successful
                    $this->orderService->update(['status'=>Constant::order_status_ReceiveOrders],$vnp_TxnRef);
                    $order->save();
    
                 
    
                    $userId = Auth::id();
                    $cart = Carts::where('user_id', $userId)->firstOrFail();
                    $selectedItemIds = session('selected_cart_items', []);
                    $cartItems = Cart_items::whereIn('id', $selectedItemIds)->where('cart_id', $cart->id)->get();
                    Cart_items::whereIn('id', $selectedItemIds)->delete();
                    session()->forget(['selected_cart_items', 'total', 'infor']);

                    foreach ($cartItems as $cartItem) {
                        $product = Product::find($cartItem->product_id);
                        $productDetail = ProductDetail::where('product_id', $cartItem->product_id)
                                                       ->where('size', $cartItem->size)
                                                       ->where('color', $cartItem->color)
                                                       ->first();
                    
                      // Trừ số lượng từ bảng sản phẩm và chi tiết sản phẩm
                       $product->qty -= $cartItem->quantity;
                       $productDetail->qty -= $cartItem->quantity;
                
                       $product->save();
                       $productDetail->save();
                    }   
    
                    
    
                    return view('Client.VNPay.VNPay')->with('message', 'Thanh toán thành công!');
                } else {
                    // Payment failed or canceled
                    $order->orderDetails()->delete();
                    $order->delete();
                  
                    return view('Client.VNPay.VNPay')->with('message', 'Thanh toán không thành công hoặc đã bị hủy.');
                }
            } else {
                // Order not found
                return view('Client.VNPay.VNPay')->with('message', 'Không tìm thấy đơn hàng.');
            }
        } else {
            // Invalid signature, possible fraud attempt
            return response('Invalid signature', 400);
        }
    }   
    private function sendMail($order,$subtotal){
        $email_to = $order->email;
        Mail::send('Client.checkout.email',compact('order','subtotal'),
        function($message) use ($email_to){
            $message->from('phanvanchien26032003@gmail.com','Phan Van Chien');
            $message->to($email_to,$email_to);
            $message->subject('Order Notification');
        });
    }
    public function thanks(){
        return view('Client.checkout.thanks');
    }
}
