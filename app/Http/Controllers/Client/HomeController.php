<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Service\Brand\BrandServiceInterface;
use App\Service\Product\ProductServiceInterface;
use App\Service\ProductCategory\ProductCategoryService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $productServices ;
    private $productcategory;
    private $brands;
    public function __construct(ProductServiceInterface $productService,
                               ProductCategoryService $productCategoryService,
                               BrandServiceInterface $brandService,
    ){
        $this->productServices = $productService;
        $this->productcategory=$productCategoryService;
        $this->brands = $brandService;
    }
    public function index(){
        $latestProducts = $this->productServices->getLatestProducts();
        $featuredProducts = $this->productServices->getLatestFeaturedProduct();
        $featuredProductsCategory = $this->productServices->getFeaturedProducts();
        $ProductsDiscountedOver30 = $this->productServices->getProductsDiscountedOver30();
        $category = $this->productcategory->all();
        $brands = $this->brands->all();
        return view ('index',compact('latestProducts','featuredProducts','category','featuredProductsCategory','ProductsDiscountedOver30','brands'));
    }
}
