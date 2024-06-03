<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart_items;
use App\Models\Carts;
use App\Service\Order\OrderServiceInterface;
use App\Service\OrderDetail\OrderDetailService;
use App\Service\OrderDetail\OrderDetailServiceInterface;
use App\Untilities\Constant;
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
    public function index(){
        $userId = Auth::id();
        $cart = Carts::where('user_id', $userId)->firstOrFail(); // Lấy giỏ hàng của người dùng
        // Lấy tất cả các mục trong giỏ hàng và tính tổng giá
        $cartItems = $cart->cartItems;
        $totalItems = $cart->cartItems->sum('quantity');
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        return view('Client.checkout.index',compact('cartItems','totalPrice','totalItems'));
    }
    public function addOrder(Request $request){
         // thêm đơn hàng 
         $data = $request->all();
         $data['status'] = Constant::order_status_ReceiveOrders;
         $order = $this->orderService->create($data);
          //Thêm chi tiết đơn hàng 
        $userId = Auth::id();
        $cart = Carts::where('user_id', $userId)->firstOrFail(); // Lấy giỏ hàng của người dùng
        // Lấy tất cả các mục trong giỏ hàng và tính tổng giá
        $cartItems = $cart->cartItems;
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
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
        if($request->payment_type == 'pay_later'){
            // gửi Email 
            // $this->sendMail($order,$subtotal);
             // Xóa giỏ hàng 
             Cart_items::whereHas('cart', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
                ->delete();
        // trả về kết quả thông báo 
        return"Thành Công ";
        } 
    }
    public function vnPayCheck(Request $request){
        // thêm đơn hàng 
        $data = $request->all();
        $data['status'] = Constant::order_status_ReceiveOrders;
        $orders = $this->orderService->create($data);
        //Thêm chi tiết đơn hàng 
        $userId = Auth::id();
        $cart = Carts::where('user_id', $userId)->firstOrFail(); // Lấy giỏ hàng của người dùng
        // Lấy tất cả các mục trong giỏ hàng và tính tổng giá
        $cartItems = $cart->cartItems;
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        foreach($cartItems as $cart){
            $data = [
                'order_id'=>$orders->id,
                'product_id'=>$cart->product_id,
                'qty'=>$cart->quantity,
                'amount'=>$cart->price,
                'total'=>$cart->quantity * $cart->price ,
                'size'=>$cart->size,
                'color'=>$cart->color,

            ];
            $this->orderDetailService->create($data);
        }
        if($request->payment_type == 'online_payment'){
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
