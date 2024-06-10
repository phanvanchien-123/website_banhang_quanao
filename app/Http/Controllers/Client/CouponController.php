<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
     public function index(){
        $coupons = Coupon::all(); 
        return view ('Client.discount.index',compact('coupons'));
    }
    
    public function applyCoupon(Request $request)
    {
        // Lấy mã giảm giá từ yêu cầu
        $code = $request->input('code');
        
        // Tìm mã giảm giá trong cơ sở dữ liệu
        $coupon = Coupon::where('code', $code)->first();
        
        // Lấy ID người dùng hiện tại
        $userId = Auth::id();
        
        // Tìm giỏ hàng của người dùng
        $cart = \App\Models\Carts::where('user_id', $userId)->first();
        
        // Lấy các sản phẩm trong giỏ hàng
        $cartItems = $cart->cartItems;
        
        // Tính tổng giá trị của giỏ hàng
        $totalPrice = $cartItems->sum(function ($item){
            return $item->price * $item->quantity;
        });
    
        // Kiểm tra nếu mã giảm giá tồn tại
        if ($coupon) {
            // Kiểm tra xem mã giảm giá có hết hạn không
            if ($coupon->expires_at && Carbon::parse($coupon->expires_at)->isPast()) {
                return response()->json(['success' => false, 'message' => 'Coupon has expired.']);
            }
    
            // Kiểm tra điều kiện tối thiểu của đơn hàng (nếu có)
            if ($coupon->minimum_order_value && $totalPrice < $coupon->minimum_order_value) {
                return response()->json(['success' => false, 'message' => 'Minimum order value not met for this coupon.']);
            }
    
            // Kiểm tra xem mã giảm giá có vượt quá số lần sử dụng không
            if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
                return response()->json(['success' => false, 'message' => 'Coupon usage limit has been reached.']);
            }
    
            // Tính toán giá trị giảm giá
            $discountAmount = 0;
            if ($coupon->discount_type == 'fixed') {
                $discountAmount = $coupon->discount_value;
            } elseif ($coupon->discount_type == 'percent') {
                $discountAmount = ($totalPrice * $coupon->discount_value) / 100;
            }
    
            // Cập nhật tổng giá sau khi áp dụng giảm giá
            $totalPrice -= $discountAmount;
    
            // Lưu mã giảm giá vào session
            session(['applied_coupon_code' => $code]);
    
          
    
            // Trả về phản hồi JSON
            return response()->json(['success' => true, 'discount' => number_format($discountAmount, 2), 'total' => number_format($totalPrice, 2), 'message' => 'Coupon applied successfully.']);
        } else {
            // Mã giảm giá không hợp lệ
            return response()->json(['success' => false, 'message' => 'Invalid coupon code.']);
        }
    }
    
    public function removeCoupon(Request $request)
{
    $userId = Auth::id();
    $cart = Carts::where('user_id', $userId)->first();
    $cartItems = $cart->cartItems;
    $totalPrice = $cartItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });

    session()->forget('applied_coupon_code');

    return response()->json(['success' => true, 'total' => number_format($totalPrice, 3), 'message' => 'Coupon removed successfully.']);
}
}
