<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Coupon;
use App\Service\Order\OrderServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    private $orderService;
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->getOrderUserId(Auth::id());
        $ordersCount = count($orders);
        $pendingOrdersCount = 0;
        foreach ($orders as $order) {
            if ($order->status === 1) {
                $pendingOrdersCount++;
            }
        }

        return view('Client.my_account.index', compact('orders', 'ordersCount', 'pendingOrdersCount'));
    }
    public function show($id)
    {

        $order = $this->orderService->find($id);
        return view('Client.my_account.show', compact('order'));
    }
    public function cancelOrder($id)
    {
        // Tìm đơn hàng theo ID
        $order = $this->orderService->find($id);

        // Kiểm tra xem đơn hàng có tồn tại và có thể hủy không
        if ($order && $order->status == 1) { // Giả sử trạng thái 1 là trạng thái có thể hủy
            $orderDetails = DB::table('order_details')->where('order_id', $id)->get();
            // Thay đổi trạng thái đơn hàng
            foreach ($orderDetails as $detail) {
                // Lấy sản phẩm và cập nhật số lượng
                $product = \App\Models\Product::find($detail->product_id);

                // Cộng lại số lượng đã trừ trước đó
                if ($product) {
                    $product->qty += $detail->qty;
                    $product->save();
                }
                $productDetail = DB::table('product_details')
                    ->where('product_id', $detail->product_id)
                    ->where('size', $detail->size)
                    ->where('color', $detail->color)
                    ->first();

                // Cộng lại số lượng đã trừ trước đó
                if ($productDetail) {
                    DB::table('product_details')
                        ->where('id', $productDetail->id)
                        ->update(['qty' => $productDetail->qty + $detail->qty]);
                }
            }
            $order->status = 0; // Giả sử trạng thái 0 là trạng thái đã hủy
            $order->save();

            return redirect()->back()->with('success', 'Đơn hàng đã được hủy.');
        }

        return redirect()->back()->with('error', 'Không thể hủy đơn hàng này.');
    }
}
