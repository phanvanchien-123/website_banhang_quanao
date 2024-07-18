<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\product_comment;
use App\Models\Product_comment as ModelsProduct_comment;
use App\Models\ProductDetail;
use App\Service\Brand\BrandServiceInterface;
use App\Service\OrderDetail\OrderDetailService;
use App\Service\Product\ProductServiceInterface;
use App\Service\ProductCategory\ProductCategoryServiceInterface;
use App\Service\ProductComment\ProductCommentServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller

{
    private $productServices;
    private $productCommentServices;
    private $productCategoryServices;
    private $productBrands;
    private $orderdetails;
    public function __construct(ProductServiceInterface $productService,
                                ProductCommentServiceInterface $productCommentService,
                                ProductCategoryServiceInterface $productCategoryService,
                                BrandServiceInterface $brandService,
                                OrderDetailService $orderDetailService,
    )
    {
        $this->productServices = $productService;
        $this->productCommentServices=$productCommentService;
        $this->productCategoryServices = $productCategoryService;
        $this->productBrands = $brandService;
        $this->orderdetails =$orderDetailService;
    }
    public function index(Request $request){
        $products = $this->productServices->getPagination($request);
        $countproducts = $this->productServices->all();
        $categories = $this->productCategoryServices->all();
        $brands = $this->productBrands->all();
        $orderCount =$this->orderdetails->countProductSold($products);
        return view ('Client.shop.shop',compact('products','categories','brands','countproducts','orderCount'));
    }
    // public function show($id, Request $request)
    // {
    //     $products = $this->productServices->find($id);
    //     $products->increment('view');     
    //     $categories = $this->productCategoryServices->all();
    //     $brands = $this->productBrands->all();
    //     $selectedColor = $request->input('color');
    //     $selectedSize = $request->input('size');
    //     $sizes = [];
    //     $quantity = 0;
    //     $comments = $this->productCommentServices->getCommentsByProductId($id,2);
    //     $relatedproducts= $this->productServices->getRelatedProducts($products);
    //     if ($selectedColor) {
    //         $sizes = ProductDetail::where('product_id', $id)
    //             ->where('color', $selectedColor)
    //             ->get(['size', 'qty']);

    //         if ($selectedSize) {
    //             $variant = ProductDetail::where('product_id', $id)
    //                 ->where('color', $selectedColor)
    //                 ->where('size', $selectedSize)
    //                 ->first();

    //             if ($variant) {
    //                 $quantity = $variant->qty;
    //             }
    //         }
    //     }
      

    //     return view('Client.shop.details', compact('products','selectedColor', 'selectedSize', 'sizes', 'quantity','comments','relatedproducts','categories','brands'));
    // }
    public function show($id){
        $products = $this->productServices->find($id);
        $products->increment('view');     
         $categories = $this->productCategoryServices->all();
        $brands = $this->productBrands->all();
        $colors = $products->productDetails->pluck('color')->unique();
        $relatedProducts = $this->productServices->getRelatedProducts($products);
        $comments = $this->productCommentServices->getCommentsByProductId($id,5);
     $relatedproducts= $this->productServices->getRelatedProducts($products);
     $orderCount =$this->orderdetails->countProductSold($id);
        return view('client.shop.details', compact('products', 'relatedProducts', 'colors','comments','relatedproducts','categories','brands','orderCount'));
    }
    
    public function getSizesByColor(Request $request, $productId)
    {
        $color = $request->input('color');
        $sizes = ProductDetail::where('product_id', $productId)
                                ->where('color', $color)
                                ->get(['size', 'qty']);
    
        return response()->json($sizes);
    }
    public function postComment(Request $request){
        $userId = auth()->id(); // Lấy ID của người dùng hiện tại
    $productId = $request->input('product_id'); // Lấy ID của sản phẩm từ request

    // Kiểm tra xem người dùng đã đánh giá sản phẩm này chưa
    $lastComment = DB::table('product_comments')
        ->where('user_id', $userId)
        ->where('product_id', $productId)
        ->orderBy('created_at', 'desc')
        ->first();

    if ($lastComment) {
        // Nếu đã có đánh giá trước đó, kiểm tra xem có đơn hàng mới sau đánh giá đó không
        $newOrderExists = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.user_id', $userId)
            ->where('order_details.product_id', $productId)
            ->where('orders.status', 7) // Kiểm tra trạng thái đơn hàng là 7
            ->where('orders.created_at', '>', $lastComment->created_at) // Đơn hàng mới sau đánh giá trước
            ->exists();

        if (!$newOrderExists) {
            // Nếu không có đơn hàng mới sau đánh giá trước đó, không cho phép đánh giá
            return redirect()->back()->with('error', 'Bạn đã đánh giá sản phẩm này. Vui lòng mua lại sản phẩm để đánh giá tiếp.');
        }
    } else {
        // Nếu chưa có đánh giá trước đó, kiểm tra xem người dùng đã mua sản phẩm này chưa
        $orderExists = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.user_id', $userId)
            ->where('order_details.product_id', $productId)
            ->where('orders.status', 7) // Kiểm tra trạng thái đơn hàng là 7
            ->exists();

        if (!$orderExists) {
            // Nếu người dùng chưa mua sản phẩm này, không cho phép đánh giá
            return redirect()->back()->with('error', 'Bạn phải mua sản phẩm này trước mới được đánh giá về sản phẩm.');
        }
    }

    // Nếu có đơn hàng mới hoặc chưa từng đánh giá, tạo bình luận
    $this->productCommentServices->create($request->all());
    return redirect()->back()->with('success', 'Bình luận của bạn đã được gửi.');
    }
    public function category($categoryName,Request $request){
        $categories = $this->productCategoryServices->all();
        $products = $this->productServices->getProductsByCategory($categoryName,$request);
        $brands = $this->productBrands->all();
        return view ('client.shop.shop',compact('products','categories','brands'));

    }
    
}
