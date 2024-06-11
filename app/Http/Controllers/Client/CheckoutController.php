<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart_items;
use App\Models\Carts;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Service\Order\OrderServiceInterface;
use App\Service\OrderDetail\OrderDetailService;
use App\Service\OrderDetail\OrderDetailServiceInterface;
use App\Untilities\Constant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
    public function index(Request $request){
        $coupons = Coupon::all(); 
        $userId = Auth::id();
        $cart = Carts::where('user_id', $userId)->firstOrFail(); // Lấy giỏ hàng của người dùng
        // Lấy tất cả các mục trong giỏ hàng và tính tổng giá
        $cartItems = $cart->cartItems;
        $totalItems = $cart->cartItems->sum('quantity');

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
        return view('Client.checkout.index',compact('cartItems','totalPrice','totalItems', 'discount','coupons','appliedCouponCode'));
    }
    public function addOrder(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'street_address' => 'required|string|max:255',
            'town_city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postcode_zip' => 'required|string|max:10',
            'payment_type' => 'required|in:0,1',
            'applied_coupon_code' => 'nullable|string|max:255', // Add validation for the coupon code
        ]);
        $couponCode = $validated['applied_coupon_code'];
    $coupon = Coupon::where('code', $couponCode)->first();
    $order = new Order();
    $order->user_id = auth()->id();
    $order->first_name = $validated['first_name'];
    $order->last_name = $validated['last_name'];
    $order->phone = $validated['phone'];
    $order->email = $validated['email'];
    $order->street_address = $validated['street_address'];
    $order->town_city = $validated['town_city'];
    $order->country = $validated['country'];
    $order->status = Constant::order_status_ReceiveOrders;
    $order->payment_type = $validated['payment_type'];
    $order->coupon_id= $coupon->id ?? null;
    
    $userId = Auth::id();
    $cart = Carts::where('user_id', $userId)->firstOrFail();
    $cartItems = $cart->cartItems;
    
    // Tính tổng giá trị của giỏ hàng
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
            // $this->sendMail($order, $totalPrice);
    
            // Xóa giỏ hàng
            Cart_items::whereHas('cart', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->delete();
    
            // Trả về kết quả thông báo
            return "Thành Công";
        }
    }
    public function vnPayCheck(Request $request){
         $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'street_address' => 'required|string|max:255',
            'town_city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postcode_zip' => 'required|string|max:10',
            'payment_type' => 'required|in:0,1',
            'applied_coupon_code' => 'nullable|string|max:255', // Add validation for the coupon code
        ]);
        $couponCode = $validated['applied_coupon_code'];
        $coupon = Coupon::where('code', $couponCode)->first();
        $order = new Order();
        $order->user_id = auth()->id();
        $order->first_name = $validated['first_name'];
        $order->last_name = $validated['last_name'];
        $order->phone = $validated['phone'];
        $order->email = $validated['email'];
        $order->street_address = $validated['street_address'];
        $order->town_city = $validated['town_city'];
        $order->country = $validated['country'];
        $order->status = Constant::order_status_ReceiveOrders;
        $order->payment_type = $validated['payment_type'];
        $order->coupon_id= $coupon->id ?? null;
        
        $userId = Auth::id();
        $cart = Carts::where('user_id', $userId)->firstOrFail();
        $cartItems = $cart->cartItems;
        
        // Tính tổng giá trị của giỏ hàng
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

        foreach($cartItems as $cart){
            $data = [
                'order_id'=>$order->id,
                'product_id'=>$cart->product_id,
                'qty'=>$cart->quantity,
                'amount'=>$cart->price,
                'total'=>$cart->quantity * $cart->price ,
                'size'=>$cart->size,
                'color'=>$cart->color,

            ];
            $this->orderDetailService->create($data);
        }
        if($request->payment_type == 1){
            $orders = $this->orderService->all();
            $userId = Auth::id();
        $cart = Carts::where('user_id', $userId)->firstOrFail(); // Lấy giỏ hàng của người dùng
        // Lấy tất cả các mục trong giỏ hàng và tính tổng giá
        $cartItems = $cart->cartItems;
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
        
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/checkout/Vnpay";
            $vnp_TmnCode = "V52DRY11";//Mã website tại VNPAY 
            $vnp_HashSecret = "QVHYIETOHTABFJHAWQQRQQNYTGDACSWT"; //Chuỗi bí mật
            foreach ($orders as $order) {
            $vnp_TxnRef = $order->id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            }
            $vnp_OrderInfo ='Thanh toan don hang ';
            $vnp_OrderType = 50;
            $vnp_Amount =  $totalPrice * 100000 ;
            $vnp_Locale = 'vn';
            $vnp_BankCode ='VNBANK';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Add Params of 2.0.1 Version
           // $vnp_ExpireDate = $_POST['txtexpire'];
            //Billing
           
            $inputData = array(
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
               
            );
            
            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }
            
            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            
            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url);
                if (isset($_POST['redirect'])) {
                    header('Location: ' . $vnp_Url);
                    $this->orderService->update(['status'=>Constant::order_status_Paid],$vnp_TxnRef);
                    $order=$this->orderService->find($vnp_TxnRef);
                    $this->sendMail($order,$subtotal);
                     // Xóa giỏ hàng 
             Cart_items::whereHas('cart', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
                ->delete();      
                    die();
                } else {
                    echo json_encode($returnData);
                }
                // vui lòng tham khảo thêm tại code demo
                }            
        }
        public function returnVNPay(){
            return view('Client.VNPay.VNPay');
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
}
