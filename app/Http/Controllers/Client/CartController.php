<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart_items;
use App\Models\Carts;
use App\Models\Product;
use App\Models\product_details;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $cart = Carts::firstOrCreate(
            ['user_id' => $userId], // Điều kiện để tìm kiếm
            ['user_id' => $userId]  // Nếu không tìm thấy, tạo mới với các thuộc tính này
        );
        // Lấy lại giỏ hàng để chắc chắn
        $cart = Carts::where('user_id', $userId)->first(); // Lấy giỏ hàng của người dùng
        // Lấy tất cả các mục trong giỏ hàng và tính tổng giá
        $cartItems = $cart->cartItems;
        // Truy vấn cơ sở dữ liệu để lấy số lượng tối đa cho mỗi sản phẩm dựa trên color và size
        $maxQuantities = [];
        foreach ($cartItems as $item) {
            $maxQuantity = ProductDetail::where('product_id', $item->product_id)
                ->where('color', $item->color)
                ->where('size', $item->size)
                ->value('qty');
            $maxQuantities[$item->id] = $maxQuantity;
        }
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        return view('Client.shop.cart', compact('cartItems', 'totalPrice', 'maxQuantities'));
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
        // Tìm biến thể sản phẩm dựa trên kích thước và màu sắc
        $productVariant = ProductDetail::where('product_id', $id)
            ->where('size', $size)
            ->where('color', $color)
            ->first();
        // Kiểm tra nếu biến thể sản phẩm không tồn tại
        if (!$productVariant) {
            return back()->with('error', 'Product variant not found.');
        }
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
            // Kiểm tra nếu số lượng yêu cầu vượt quá số lượng có sẵn của biến thể
            if ($existingCartItem->quantity + $qty > $productVariant->qty) {
                return back()->with('error', 'Số lượng yêu cầu vượt quá lượng hàng có sẵn cho mẫu mã này.');
            }
            // Nếu sản phẩm đã tồn tại, cập nhật số lượng
            $existingCartItem->quantity += $qty;
            $existingCartItem->save();
            return back()->with('success', 'Số lượng mặt hàng được cập nhật vào giỏ hàng thành công.');
        } else {
            // Kiểm tra nếu số lượng yêu cầu vượt quá số lượng có sẵn của biến thể
            if ($qty > $productVariant->qty) {
                return back()->with('error', 'Số lượng yêu cầu vượt quá lượng hàng có sẵn cho mẫu mã này.');
            }
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
            return back()->with(['success' => 'Thêm vào giỏ hàng thành công.']);
        }
    }
    
    
    public function update($id, Request $request)
    {
        // Tìm mục trong giỏ hàng dựa trên ID
        $cartItem = Cart_items::find($id);
        // Kiểm tra nếu mục trong giỏ hàng không tồn tại
        if (!$cartItem) {
            return back()->with('error', 'Không tìm thấy mục giỏ hàng.');
        }
        // Lấy thông tin từ request
        $qty = $request->input('quantity');
        // Cập nhật thông tin mục trong giỏ hàng
        $cartItem->quantity = $qty;
        $cartItem->save();
        return back()->with('success', 'Cập Nhật số lượng thành công.');
    }
    public function delete($id)
    {
        // Lấy thông tin người dùng hiện đang đăng nhập
        $userId = Auth::id();
        // Tìm mục trong giỏ hàng dựa trên ID và kiểm tra quyền sở hữu của người dùng
        $cartItem = Cart_items::where('id', $id)
            ->whereHas('cart', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->first();
        // Kiểm tra nếu mục trong giỏ hàng không tồn tại
        if (!$cartItem) {
            return back()->with('error', 'Không tìm thấy mặt hàng giỏ hàng.');
        }
        // Xóa mục khỏi giỏ hàng
        $cartItem->delete();
        return back()->with('success', 'Xóa khỏi giỏ hàng thành công.');
    }
    public function clearCart()
    {
        $userId = Auth::id();
        // Xóa toàn bộ các mục trong giỏ hàng của người dùng
        Cart_items::whereHas('cart', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->delete();
        return back()->with('success', 'Xóa khỏi giỏ hàng thành công.');
    }
    public function orderSelected(Request $request)
{
    $selectedItems = $request->input('selected_items', []);
    if (empty($selectedItems)) {
        return redirect()->back()->with('error', 'No items selected.');
    }

    $userId = Auth::id();
    $cart = Carts::where('user_id', $userId)->firstOrFail();
    $cartItems = Cart_items::whereIn('id', $selectedItems)->where('cart_id', $cart->id)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Invalid items selected.');
    }

    // Save selected items to session
    session(['selected_cart_items' => $cartItems->pluck('id')->toArray()]);

    return redirect()->route('list');
}

}
