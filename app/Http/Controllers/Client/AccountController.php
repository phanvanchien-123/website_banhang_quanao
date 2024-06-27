<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Coupon;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
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
        $orders = $this->orderService->totalorder(Auth::id());
        $pendingorders = $this->orderService->getOrderUserId(Auth::id(),1);
        $confiemedorders = $this->orderService->getOrderUserId(Auth::id(),3);
        $finishorders = $this->orderService->getOrderUserId(Auth::id(),7);
        $cancelorders = $this->orderService->getOrderUserId(Auth::id(),0);


        $ordersCount = count($orders);
        $pendingOrdersCount = 0;
        $confiemedOrderCount =0;
        $finishOrderCount=0;
        $cancelOrderCount =0;
        foreach ($pendingorders as $order) {
            if ($order->status === 1) {
                $pendingOrdersCount++;
            }
        }
        foreach ($confiemedorders as $order) {
            if ($order->status === 3) {
                $confiemedOrderCount++;
            }
        }
        foreach ( $finishorders as $order) {
            if ($order->status === 7) {
                $finishOrderCount++;
            }
        }
        foreach ($cancelorders as $order) {
            if ($order->status === 0) {
                $cancelOrderCount++;
            }
        }
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();

        return view('Client.my_account.index', compact('orders', 'ordersCount', 'pendingOrdersCount','confiemedOrderCount'
    ,'finishOrderCount','cancelOrderCount','confiemedorders','finishorders','cancelorders','pendingorders','provinces','districts','wards'));
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
    public function reorder($id)
    {
        // Find the canceled order by ID
        $order = $this->orderService->find($id);
    
        // Check if the order exists and is canceled
        if ($order && $order->status == 0) { // Assuming status 0 is the canceled status
            // Update the status of the original order to active
            $order->status = 1; // Assuming status 1 is the active status
            $order->save();
    
            // Get the order details
            $orderDetails = DB::table('order_details')->where('order_id', $id)->get();
            foreach ($orderDetails as $detail) {
                // Reduce product quantity if it was previously restored
                $product = \App\Models\Product::find($detail->product_id);
                if ($product) {
                    $product->qty -= $detail->qty;
                    $product->save();
                }
                $productDetail = DB::table('product_details')
                    ->where('product_id', $detail->product_id)
                    ->where('size', $detail->size)
                    ->where('color', $detail->color)
                    ->first();
    
                if ($productDetail) {
                    DB::table('product_details')
                        ->where('id', $productDetail->id)
                        ->update(['qty' => $productDetail->qty - $detail->qty]);
                }
            }
    
            return redirect()->back()->with('success', 'Đơn hàng đã được đặt lại.');
        }
    
        return redirect()->back()->with('error', 'Không thể đặt lại đơn hàng này.');
    }
    

}
