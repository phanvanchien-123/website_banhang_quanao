<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\product_comment;
use App\Models\Product_comment as ModelsProduct_comment;
use App\Models\ProductDetail;
use App\Service\Brand\BrandServiceInterface;
use App\Service\Product\ProductServiceInterface;
use App\Service\ProductCategory\ProductCategoryServiceInterface;
use App\Service\ProductComment\ProductCommentServiceInterface;
use Illuminate\Http\Request;

class ShopController extends Controller

{
    private $productServices;
    private $productCommentServices;
    private $productCategoryServices;
    private $productBrands;
    public function __construct(ProductServiceInterface $productService,
                                ProductCommentServiceInterface $productCommentService,
                                ProductCategoryServiceInterface $productCategoryService,
                                BrandServiceInterface $brandService,
    )
    {
        $this->productServices = $productService;
        $this->productCommentServices=$productCommentService;
        $this->productCategoryServices = $productCategoryService;
        $this->productBrands = $brandService;
    }
    public function index(Request $request){
        $products = $this->productServices->getPagination($request);
        $categories = $this->productCategoryServices->all();
        $brands = $this->productBrands->all();
        return view ('Client.shop.shop',compact('products','categories','brands'));
    }
    public function show($id, Request $request)
    {
        $products = $this->productServices->find($id);
        $products->increment('view');     
        $categories = $this->productCategoryServices->all();
        $brands = $this->productBrands->all();
        $selectedColor = $request->input('color');
        $selectedSize = $request->input('size');
        $sizes = [];
        $quantity = 0;
        $comments = $this->productCommentServices->getCommentsByProductId($id,2);
        $relatedproducts= $this->productServices->getRelatedProducts($products);
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
      

        return view('Client.shop.details', compact('products','selectedColor', 'selectedSize', 'sizes', 'quantity','comments','relatedproducts','categories','brands'));
    }
    public function postComment(Request $request){
        $this->productCommentServices->create($request->all());
        return redirect()->back();
    }
    public function category($categoryName,Request $request){
        $categories = $this->productCategoryServices->all();
        $products = $this->productServices->getProductsByCategory($categoryName,$request);
        $brands = $this->productBrands->all();
        return view ('client.shop.shop',compact('products','categories','brands'));

    }
    
}
