<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(){
        $products = Product::whereDate('created_at', '<', Carbon::now()->subMonths(6))->get();

        if($products){
            foreach ($products as $product) {
                $discount = $product->price *30 /100 ;

                $product->update(['discount' => $discount]); 
            }
        }
        
    }
}
