<?php 
namespace App\Service\Product;

use App\Service\ServiceInterface;

interface ProductServiceInterface extends ServiceInterface{
    public function getRelatedProducts($product ,$limit=4);
    public function getFeaturedProducts();
    public function getPagination($request);
    public function getProductsByCategory($categoryName,$request);
    public function getLatestProducts($limit);
    public function getLatestFeaturedProduct($limit);
    public function getProductsDiscountedOver30($limit = 8);
    public function getproductsviewlong($limit);
    public function getProductsSoldOverThreshold($threshold,$limit);

}