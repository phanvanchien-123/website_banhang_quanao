<?php

namespace App\Repositories\Product;

use App\Models\product;
use App\Models\product_categorie;
use App\Repositories\BaseRepositories;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepositories implements ProductRepositoryInterface
{
    public function getModel(){
        return product::class;
    }
    public function getRelatedProducts($product ,$limit = 4){
        return $this->model->where('product_category_id',$product->product_category_id)
        ->where('tag',$product->tag)
        ->limit($limit)
        ->get();
    }
    public function getFeaturedProductsByCategory(int $categoryID){
        return $this->model->where('featured',true)
        ->where('product_category_id',$categoryID)
        ->get();
        
    }
    public function getPagination($request){

       
        $search =$request->search ?? '';

        $products = $this->model->where('name','like','%'.$search.'%');
        $products = $this->filter($products,$request);
        $products =$this->Paginate($products,$request);
        return $products;
    }
    public function getProductsByCategory($categoryName, $request){
        $products = product_categorie::where('name',$categoryName)->first()->products->toQuery();
        $products = $this->filter($products,$request);
        $products =$this->Paginate($products,$request);
        return $products;
    }
    private function Paginate($products,Request $request){
        $perPage=$request->show ?? 6;
        $sortBy =$request->sort_by ??'latest';
        $queryParams = $request->except('page');
        switch($sortBy){
            case 'latest':
                $products = $products->orderBy('id');
                break;
            case 'oldesc':
                $products = $products->orderByDesc('id');
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

        $products =$products->paginate($perPage)->withQueryString();
        //$products ->appends(['sort_by'=>$sortBy,'show'=>$perPage]);
        $products->appends($queryParams);
        return $products;
    }
    private function filter($products, Request $request){
        //Brand 
        $brands = $request->brand ?? [];
        $brand_ids = array_keys($brands);
        $products = !empty($brand_ids) ? $products->whereIn('brand_id', $brand_ids) : $products;

        //price
        $priceMin = $request->price_min;
        $priceMax = $request->price_max;
        $priceMin =str_replace('$', '', $priceMin);
        $priceMax=str_replace('$', '', $priceMax);
        $products =($priceMin !=null && $priceMax !=null)? $products->whereBetween('price',[$priceMin,$priceMax]) : $products;

        // color
        $color = $request->color;
        $products = $color !=null
         ? $products->whereHas('productDetails',function($query) use($color){
                return $query->where('color',$color)
                ->where('qty','>',0);
         }):$products;
        return $products;
    }
}