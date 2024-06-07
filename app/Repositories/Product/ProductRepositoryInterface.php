<?php 
namespace App\Repositories\Product;

use App\Repositories\RepositoriesInterface;


interface ProductRepositoryInterface  extends RepositoriesInterface
{
    public function getRelatedProducts($product ,$limit = 4);
    public function getFeaturedProductsByCategory(int $categoryID);
    public function getPagination($request);
    public function getProductsByCategory($categoryName, $request);
    public function getLatestProducts($limit = 10);
    public function getLatestFeaturedProduct($limit = 10);
    public function getProductsDiscountedOver30($limit = 10);
    
}