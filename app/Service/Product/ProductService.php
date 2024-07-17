<?php
namespace App\Service\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Service\BaseService;

class ProductService extends BaseService implements ProductServiceInterface {
    public $repository;

    public function __construct(ProductRepositoryInterface $productRepository){
        $this->repository =$productRepository;
    }
    public function find( $id)
    {
        // sử lí phần đánh giá dựa vào comment
        // Implement logic để tìm một bản ghi theo ID
        $product = $this->repository->find($id);
        $avgRating=0;
        $sumRating = array_sum(array_column($product->productComments->toArray(),'rating'));
        $countRating = count($product->productComments);
        if($countRating !=0){
            $avgRating =$sumRating/$countRating;
        }
        $product->avgRating =$avgRating;
        $stars = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
            foreach ($product->productComments as $comment) {
                $stars[$comment->rating]++;
            }
            foreach ($stars as $star => $count) {
                $stars[$star] = $countRating ? ($count / $countRating) * 100 : 0;
            }
            $product->starPercentage = $stars;
        
        return $product;
    }
    public function all()
{
    $products = $this->repository->all(); // Assuming this gets all products

    foreach ($products as $product) {
        $sumRating = array_sum(array_column($product->productComments->toArray(), 'rating'));
        $countRating = count($product->productComments);
        $avgRating = $countRating ? $sumRating / $countRating : 0;
        $product->avgRating = $avgRating;
    }

    return $products;
}
    
    public function getRelatedProducts($product ,$limit = 4){
      return  $this ->repository ->getRelatedProducts($product,$limit);
    }
      public function getLatestProducts($limit){
        return $this ->repository->getLatestProducts($limit);
    }
    public function getLatestFeaturedProduct($limit){
        return $this->repository->getLatestFeaturedProduct($limit);
    }
    public function getProductsDiscountedOver30($limit = 8){
        return $this->repository->getProductsDiscountedOver30($limit);
    }
    public function getFeaturedProducts(){
        return[
            "Men"=> $this ->repository->getFeaturedProductsByCategory(5),
            "Women"=> $this ->repository->getFeaturedProductsByCategory(6),
            
        ];
    }
    public function getPagination($request){
        return $this ->repository->getPagination($request);
    }
    public function getProductsByCategory($categoryName,$request){
    return $this->repository->getProductsByCategory($categoryName,$request);
    }
    public function getproductsviewlong($limit){
        return $this->repository->getproductsviewlong($limit);
    }
    public function getProductsSoldOverThreshold($threshold,$limit){
        return $this->repository->getProductsSoldOverThreshold($threshold,$limit);
    }
}