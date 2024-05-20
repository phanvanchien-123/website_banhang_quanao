<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\product_comment;
use App\Models\Product_comment as ModelsProduct_comment;
use App\Models\ProductDetail;
use App\Service\Product\ProductServiceInterface;
use App\Service\ProductComment\ProductCommentServiceInterface;
use Illuminate\Http\Request;

class ShopController extends Controller

{
    private $productServices;
    private $productCommentServices;
    public function __construct(ProductServiceInterface $productService,
                                ProductCommentServiceInterface $productCommentService
    )
    {
        $this->productServices = $productService;
        $this->productCommentService=$productCommentService;
    }
    public function index(){
        $products = $this->productServices->all();
        return view ('Client.shop.shop',compact('products'));
    }
    public function show($id, Request $request)
    {
        $products = $this->productServices->find($id);
        $selectedColor = $request->input('color');
        $selectedSize = $request->input('size');
        $sizes = [];
        $quantity = 0;
        $comments = $this->productCommentService->getCommentsByProductId($id,2);
        if ($selectedColor) {
            $sizes = ProductDetail::where('product_id', $id)
                ->where('color', $selectedColor)
                ->get(['size', 'qty']);

            if ($selectedSize) {
                $variant = ProductDetail::where('product_id', $id)
                    ->where('color', $selectedColor)
                    ->where('size', $selectedSize)
                    ->first();

                if ($variant) {
                    $quantity = $variant->qty;
                }
            }
        }
      

        return view('Client.shop.details', compact('products', 'selectedColor', 'selectedSize', 'sizes', 'quantity','comments'));
    }
    // public function filterSizes(Request $request, $productId){
    //     $selectedColor = $request->input('color');
    //     $products = $this->productServices->find($productId);
    //     $sizes = ProductDetail::where('product_id', $productId)
    //                             ->where('color', $selectedColor)
    //                             ->get(['size', 'qty']);
    //                             $qty=$sizes->qty;
    //     return view('Client.shop.details', compact('products',  'selectedColor', 'sizes','qty'));
    // }
    public function postComment(Request $request){
        $this->productCommentService->create($request->all());
        return redirect()->back();
    }
    
}
