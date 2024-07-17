<?php

namespace App\Repositories\Product;

use App\Models\Category;
use App\Models\product;
use App\Models\product_categorie;
use App\Repositories\BaseRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepositories implements ProductRepositoryInterface
{
    public function getModel()
    {
        return product::class;
    }
    public function getproductsviewlong($limit){
        $productsview= $this->model->where('view','>',100)->limit($limit)->get();
        foreach ($productsview as $Product) {
            $this->Evaluate($Product);
        }
        return $productsview;
    }
    public function getProductsSoldOverThreshold($threshold, $limit)
    {
        $topSellingProducts = $this->model
            ->join('order_details', 'products.id', '=', 'order_details.product_id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id') // Thêm join với bảng orders
            ->select(
                'products.id', 
                'products.name',
                'products.discount',
                'products.avatar', 
                'products.price', 
                'products.product_category_id', 
                'products.created_at', 
                'products.updated_at', 
                DB::raw('SUM(order_details.qty) as total_sold')
            )
            ->where('orders.status', '=', 7) // Lọc các đơn hàng có trạng thái là 7
            ->groupBy(
                'products.id', 
                'products.name',
                'products.discount',
                'products.avatar', 
                'products.price', 
                'products.product_category_id', 
                'products.created_at', 
                'products.updated_at'
            )
            ->having('total_sold', '>', $threshold) // Lọc các sản phẩm bán được hơn $threshold sản phẩm
            ->orderBy('total_sold', 'desc')
            ->limit($limit) // Giới hạn kết quả trả về là $limit sản phẩm
            ->get();
    
        foreach ($topSellingProducts as $product) {
            $this->Evaluate($product);
            
        }
    
        return $topSellingProducts;
    }
    
    
    public function getRelatedProducts($product, $limit = 4)
    {

        // Lấy các sản phẩm tương tự
        $relatedProducts = $this->model->where('product_category_id', $product->product_category_id)
            ->where('tag', $product->tag)
            ->where('id', '!=', $product->id)  // Exclude the current product
            ->limit($limit)
            ->get();

        // Tính toán đánh giá trung bình cho từng sản phẩm
        foreach ($relatedProducts as $Product) {
            $this->Evaluate($Product);
        }

        return $relatedProducts;
    }
    private function Evaluate($Product)
    {
        $sumRating = array_sum(array_column($Product->productComments->toArray(), 'rating'));
        $countRating = count($Product->productComments);

        $avgRating = $countRating ? $sumRating / $countRating : 0;
        $Product->avgRating = $avgRating;
    }
    public function getLatestProducts($limit)
    {
        // Lấy các sản phẩm mới nhất
        $latestProducts = $this->model->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
        // Tính toán đánh giá trung bình cho từng sản phẩm
        foreach ($latestProducts as $Product) {
            $this->Evaluate($Product);
        }
        return $latestProducts;
    }
    public function getLatestFeaturedProduct($limit)
    {
        // Lấy các sản phẩm nổi bật mới nhất
        $featuredProducts = $this->model->where('featured', true)
                                        ->orderBy('created_at', 'desc')
                                        ->limit($limit)
                                        ->get();

        // Tính toán đánh giá trung bình cho từng sản phẩm
        foreach ($featuredProducts as $Product) {
            $this->Evaluate($Product);
        }

        return $featuredProducts;
    }
    public function getProductsDiscountedOver30($limit = 8)
    {
        // Giả sử bảng sản phẩm có cột 'original_price' và 'discounted_price'
        $discountedProducts = $this->model->whereRaw('(price - discount) / price = 0.3')
                                          ->limit($limit)
                                          ->get();
    
        foreach ($discountedProducts as $product) {
            $this->Evaluate($product);
        }
    
        return $discountedProducts;
    }
    
    public function getFeaturedProductsByCategory(int $categoryID)
    {
        $featuredProducts=  $this->model->where('featured', true)
            ->where('product_category_id', $categoryID)
            ->get();
            foreach ($featuredProducts as $Product) {
                $this->Evaluate($Product);
            }
    
            return $featuredProducts;
    }
    public function getPagination($request)
    {


        $search = $request->search ?? '';
        $products = $this->model->where('name', 'like', '%' . $search . '%');
        $products = $this->filter($products, $request);
        $products = $this->Paginate($products, $request);
        foreach ($products as $Product) {
            $this->Evaluate($Product);
        }
        return $products;
    }
    public function getProductsByCategory($categoryName, $request)
    {
        $products = Category::where('name', $categoryName)->first()->products->toQuery();
        $products = $this->filter($products, $request);
        $products = $this->Paginate($products, $request);
        foreach ($products as $Product) {
            $this->Evaluate($Product);
        }
        return $products;
        return $products;
    }
    private function Paginate($products, Request $request)
    {
        $perPage = $request->show ?? 6;
        $sortBy = $request->sort_by ?? 'latest';
        $queryParams = $request->except('page');
        switch ($sortBy) {
            case 'latest':
                $products = $products->orderByDesc('id');
                break;
            case 'oldest':
                $products = $products->orderBy('id');
                break;
            case 'name-ascending':
                $products = $products->orderBy('name');
                break;
            case 'name-descending':
                $products = $products->orderByDesc('name');
                break;
            case 'price-ascending':
                $products = $products->orderBy('price');
                break;
            case 'price-descending':
                $products = $products->orderByDesc('price');
                break;
            default:
                $products = $products->orderBy('id');
        }

        $products = $products->paginate($perPage);
        //$products ->appends(['sort_by'=>$sortBy,'show'=>$perPage]);
        $products->appends($queryParams);
        return $products;
    }
    private function filter($products, Request $request)
    {
        //Brand 
        $brands = $request->brand ?? [];
        $brand_ids = array_keys($brands);
        $products = !empty($brand_ids) ? $products->whereIn('brand_id', $brand_ids) : $products;

        //price
        $priceMin = $request->price_min;
        $priceMax = $request->price_max;
        $priceMin = str_replace('$', '', $priceMin);
        $priceMax = str_replace('$', '', $priceMax);
        
        $products = ($priceMin != null && $priceMax != null)
            ? $products->where(function($query) use ($priceMin, $priceMax) {
                $query->where(function($subQuery) use ($priceMin, $priceMax) {
                    // Điều kiện lọc sản phẩm có giảm giá nằm trong khoảng giá
                    $subQuery->whereBetween('discount', [$priceMin, $priceMax])
                             ->orWhere(function($subSubQuery) use ($priceMin, $priceMax) {
                                 $subSubQuery->whereNotNull('discount')  // Sản phẩm có giảm giá
                                             ->whereBetween('price', [$priceMin, $priceMax]);
                             });
                })
                ->orWhere(function($subQuery) use ($priceMin, $priceMax) {
                    // Điều kiện lọc sản phẩm không có giảm giá và giá gốc nằm trong khoảng giá
                    $subQuery->whereNull('discount')  // Sản phẩm không có giảm giá
                             ->whereBetween('price', [$priceMin, $priceMax]);
                });
            })
            : $products;
    
    
    
    


        // color
        $color = $request->color;
        $products = $color != null
            ? $products->whereHas('productDetails', function ($query) use ($color) {
                return $query->where('color', $color)
                    ->where('qty', '>', 0);
            }) : $products;
        return $products;
    }
}
