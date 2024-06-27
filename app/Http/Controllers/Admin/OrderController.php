<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\Order_details;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
    public function index(Request $request){

        $sort = $request->get('sort', 'id'); // Mặc định sắp xếp theo tên sản phẩm
        $order = $request->get('order', 'asc'); 

        $orders = Order::query();

        if ($request->has('search')) {
            $name = $request->input('search');
            $orders->where('id', 'like', '%' . $name . '%');
        }

        $orders->orderBy($sort, $order);

        $orders = $orders->paginate(10);

         // Tính tổng total
         foreach ($orders as $order) {
            $order->total_sum = $order->orderDetails->sum('total');
        }

        return view('admin.order.index',compact('orders'));
    }

    public function update(Request $request, $id){

        $order = Order::findOrFail($id);
        $initialStatus = $order->status;
        $updatedStatus = $request->input('status');
        
        $order->status = $updatedStatus;
        $order->save();

        $orderDetails = $order->orderDetails;
        
        // Kiểm tra và cập nhật số lượng sản phẩm
        foreach ($orderDetails as $orderDetail) {
            $product = $orderDetail->products;

            // Lấy product_detail tương ứng với sản phẩm và tên từ order_detail
            $productDetail = ProductDetail::where('product_id', $orderDetail->product_id)
                                        ->where('size', $orderDetail->size)
                                        ->where('color', $orderDetail->color)
                                        ->first();

            if ($productDetail) {
                if ($initialStatus != 0 && $updatedStatus == 0) {
                    // Trả lại số lượng sản phẩm
                    $productDetail->qty += $orderDetail->qty;
                } elseif ($initialStatus == 0 && $updatedStatus != 0) {
                    // Trừ số lượng sản phẩm
                    $productDetail->qty -= $orderDetail->qty;
                }
                
                $productDetail->save();
            }

            // Cập nhật tổng số lượng sản phẩm từ tất cả các chi tiết sản phẩm
            $product->qty = $product->productDetails->sum('qty');
            $product->save();
        }

        return response()->json(['success' => true]);
    }

    public function show($id){

        $order = Order::findOrFail($id);

        return view('admin.order.show',compact('order'));
    }

    public function delete($id){
        try{

            $order = Order::findOrFail($id);
            Order_details::where('order_id', $order->id)->delete();
            
            $order->delete();

            return redirect()->back()->with(['success' => 'xoá đơn hàng thành công']);

        }catch (Exception $ex) {
            Log::error("ERROR => ProductController@store =>". $ex->getMessage());
            return redirect()->back()->with(['error' => 'xoá đơn hàng thất bại']);
        }
        

    }
}
