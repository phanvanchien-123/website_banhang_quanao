<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart_items;
use App\Models\Carts;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
       
        $userId = Auth::id();
        $cart = Carts::where('user_id', $userId)->firstOrFail(); // Lấy giỏ hàng của người dùng
        // Lấy tất cả các mục trong giỏ hàng và tính tổng giá
        $cartItems = $cart->cartItems;
        $totalPrice = $cartItems->sum(function ($item){
             $item->product->price * $item->quantity;
        });
    return view ('Client.shop.cart',compact('cartItems','totalPrice'));
    }
    public function add($id, Request $request)
    {
        // Lấy thông tin người dùng hiện đang đăng nhập
        $userId = Auth::id();
        // Tìm thông tin sản phẩm dựa trên id
        $product = Product::find($id);
        // Kiểm tra nếu sản phẩm không tồn tại
        if (!$product) {
            return back()->with('error', 'Product not found.');
        }
        // Lấy thông tin số lượng, kích thước và màu sắc từ request
        $qty = $request->quantity;
        $size = $request->size;
        $color = $request->color;
    
        // Tìm giỏ hàng của người dùng
        $cart = Carts::where('user_id', $userId)->first();
    
        // Nếu giỏ hàng không tồn tại, tạo mới
        if (!$cart) {
            $cart = new Carts(['user_id' => $userId]);
            $cart->save();
        }
    
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $existingCartItem = Cart_items::where('cart_id', $cart->id)
                                    ->where('product_id', $product->id)
                                    ->where('size', $size)
                                    ->where('color', $color)
                                    ->first();
    
        if ($existingCartItem) {
            // Nếu sản phẩm đã tồn tại, cập nhật số lượng
            $existingCartItem->quantity += $qty;
            $existingCartItem->save();
    
            return back()->with('success', 'Item quantity updated in cart successfully.');
        } else {
            // Tạo một bản ghi mới trong giỏ hàng
            $cartItem = new Cart_items([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $qty,
                'price' => $product->discount ?? $product->price,
                'size' => $size,
                'color' => $color,
            ]);
    
            // Lưu bản ghi mới vào cơ sở dữ liệu
            $cartItem->save();
    
            return back()->with('success', 'Item added to cart successfully.');
        }
    }
    
}
