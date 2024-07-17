<?php

namespace App\Http\Controllers\Client;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Blog\BlogServiceInterface;
use App\Service\Brand\BrandServiceInterface;
use App\Service\OrderDetail\OrderDetailServiceInterface;
use App\Service\Product\ProductServiceInterface;
use App\Service\ProductCategory\ProductCategoryService;

class HomeController extends Controller
{
    private $productServices ;
    private $productcategory;
    private $brands;
    private $blogs;
    private $order;
    public function __construct(ProductServiceInterface $productService,
                               ProductCategoryService $productCategoryService,
                               BrandServiceInterface $brandService,
                               BlogServiceInterface $blogService,
                               OrderDetailServiceInterface $orderDetailService,
    ){
        $this->productServices = $productService;
        $this->productcategory=$productCategoryService;
        $this->brands = $brandService;
        $this->blogs=$blogService;
        $this->order=$orderDetailService;
    }
    public function index(){
        $latestProducts = $this->productServices->getLatestProducts(8);
        $featuredProducts = $this->productServices->getLatestFeaturedProduct(8);
        $featuredProductsCategory = $this->productServices->getFeaturedProducts();
        $ProductsDiscountedOver30 = $this->productServices->getProductsDiscountedOver30();
        $productsview=$this->productServices->getproductsviewlong(8);
        $category = $this->productcategory->all();
        $brands = $this->brands->all();
        $blogs =$this->blogs->getlongBlogs(3);
        $best_selling = $this->productServices->getProductsSoldOverThreshold(5,10);
        $slide = Photo::where('type', 'slide')->get();

        $viewData = [
            'slide' => $slide,
            'latestProducts' => $latestProducts,
            'featuredProducts' => $featuredProducts,
            'featuredProductsCategory' => $featuredProductsCategory,
            'ProductsDiscountedOver30' => $ProductsDiscountedOver30,
            'productsview' => $productsview,
            'category' => $category,
            'brands' => $brands,
            'blogs'=>$blogs,
            'best_selling'=>$best_selling,
        ];

        return view ('index',$viewData);

        
    }
}
