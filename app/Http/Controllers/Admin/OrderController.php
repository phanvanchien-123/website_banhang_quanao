<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
    public function index(){

        $orders = Order::paginate(10);

         // Tính tổng total
         foreach ($orders as $order) {
            $order->total_sum = $order->orderDetails->sum('total');
        }

        return view('admin.order.index',compact('orders'));
    }

    public function update(Request $request, $id){

        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return response()->json(['success' => true]);
    }

    public function show($id){

        $order = Order::findOrFail($id);

        return view('admin.order.show',compact('order'));
    }

    public function delete(){

    }
}
