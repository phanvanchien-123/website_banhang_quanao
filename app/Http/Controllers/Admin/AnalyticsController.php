<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Untilities\Constant;
use Illuminate\Http\Request;
use App\Models\Order_Details;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AnalyticsController extends Controller
{
    //
    public function index(Request $request)
    {
        // Lấy giá trị ngày bắt đầu và kết thúc từ request
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            if ($startDate) {
                $startDate = Carbon::parse($startDate)->startOfDay();
            }

            if ($endDate) {
                $endDate = Carbon::parse($endDate)->endOfDay();
            }

        // Sales & Profit
            $salesAndProfitQuery = Order_Details::select(
                DB::raw('DATE(order_details.created_at) as date'),
                DB::raw('SUM(orders.total) as sales'),
                DB::raw('SUM(order_details.qty * (order_details.amount - products.cost)) as profit')
            )
            ->leftJoin('products', 'order_details.product_id', '=', 'products.id')
            ->leftJoin('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.status', '!=', 0)
            ->groupBy(DB::raw('DATE(order_details.created_at)'));

            if ($startDate && $endDate) {
                $salesAndProfitQuery->whereBetween('order_details.created_at', [$startDate, $endDate]);
            }

            $salesAndProfit = $salesAndProfitQuery->get();

        // Tổng số sản phẩm
            $totalProductsQuery = Product::query();
            if ($startDate && $endDate) {
                $totalProductsQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
            $totalProducts = $totalProductsQuery->count();

        // Tổng số bài viết
            $totalPostsQuery = Blog::query();
            if ($startDate && $endDate) {
                $totalPostsQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
            $totalPosts = $totalPostsQuery->count();

        // Tổng số đơn hàng
            $totalOrdersQuery = Order::query();
            if ($startDate && $endDate) {
                $totalOrdersQuery->whereBetween('created_at', [$startDate, $endDate]);
            }
            $totalOrders = $totalOrdersQuery->count();

        // Thống kê số lượng đơn hàng theo các trạng thái
            $orderStatusCountsQuery = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status');

            if ($startDate && $endDate) {
            $orderStatusCountsQuery->whereBetween('created_at', [$startDate, $endDate]);
            }

            $orderStatusCounts = $orderStatusCountsQuery->get()
            ->pluck('count', 'status')
            ->toArray();

            // Tạo mảng dữ liệu cho biểu đồ
            $orderStatusData = [];
            foreach (Constant::$order_status as $status => $statusLabel) {
            $orderStatusData[$statusLabel] = $orderStatusCounts[$status] ?? 0;
            }

            // dd($orderStatusData);
        
        // Lấy danh sách khách hàng đặt hàng nhiều nhất
            $topCustomersQuery = User::select('users.id', 'users.name', 'users.email', DB::raw('COUNT(orders.id) as total_orders'))
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('orders.status', '!=', 0)
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderBy('total_orders', 'DESC')
            ->limit(5);

            if ($startDate && $endDate) {
                $topCustomersQuery->whereBetween('orders.created_at', [$startDate, $endDate]);
            }
            $topCustomers = $topCustomersQuery->get();

        // Lấy danh sách sản phẩm bán chạy nhất
            $topProductsQuery  = Product::select('products.id', 'products.name', DB::raw('SUM(order_details.qty) as total_quantity_sold'))
                ->join('order_details', 'products.id', '=', 'order_details.product_id')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->where('orders.status', '!=', 0)
                ->groupBy('products.id', 'products.name')
                ->orderBy('total_quantity_sold', 'DESC')
                ->limit(5);

            if ($startDate && $endDate) {
                $topProductsQuery->whereBetween('orders.created_at', [$startDate, $endDate]);
            }
        
            $topProducts = $topProductsQuery->get();

        // Trả về view cùng với dữ liệu thống kê
        return view('admin.analysis.index', [
            'salesAndProfit' => $salesAndProfit,
            'totalProducts' => $totalProducts,
            'totalPosts' => $totalPosts,
            'totalOrders' => $totalOrders,
            'orderStatusData' => $orderStatusData,
            'topCustomers' => $topCustomers,
            'topProducts' => $topProducts,
        ]);
    }
}
