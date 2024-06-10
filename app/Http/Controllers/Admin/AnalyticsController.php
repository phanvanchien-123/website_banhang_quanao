<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Order_Details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AnalyticsController extends Controller
{
    //
    public function index(Request $request){

      // Lấy giá trị ngày bắt đầu và kết thúc từ request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Truy vấn dữ liệu từ CSDL
        $query = Order_Details::select(
            DB::raw('DATE(order_details.created_at) as date'),
            DB::raw('SUM(total) as sales'), // Doanh thu
            DB::raw('SUM(order_details.qty * (order_details.amount - products.cost)) as profit')
        )
        ->leftJoin('products', 'order_details.product_id', '=', 'products.id')
        ->leftJoin('orders', 'order_details.order_id', '=', 'orders.id') // Thêm join với bảng orders
        ->where('orders.status', '!=', 0) // Chỉ lấy kết quả của các đơn hàng có status khác 0
        ->groupBy(DB::raw('DATE(order_details.created_at)'));

        // Kiểm tra xem ngày bắt đầu và kết thúc có được nhập hay không
        if ($startDate && $endDate) {
            $query->whereBetween('order_details.created_at', [$startDate, $endDate]);
        }

        // Lấy kết quả
        $results = $query->get();

        // Trả dữ liệu về view
        return view('admin.analysis.index', ['results' => $results]);
    }
}
