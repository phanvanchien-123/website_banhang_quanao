<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::latest()->take(5)->get();
        $blogs = Blog::latest()->take(5)->get();
        $users = User::latest()->take(5)->get();

        $totalBlogs = Blog::count();
        $totalUsers = User::count();
        $totalQty = 0;
        foreach ($products as $product) {
            $totalQty += $product->productDetails->sum('qty');
        }

        $viewData = [
            'products' => $products,
            'blogs' => $blogs,
            'users' => $users,

            'totalQty' => $totalQty,
            'totalBlogs' => $totalBlogs,
            'totalUsers' => $totalUsers,


        ];
        return view('admin.dashboard.index', $viewData);
    }

}
