<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $timestamps = true;
    protected $primaryKey ='id';
    protected $fillable=[
        'id',
        'name',
        'description',
        'content',
        'price',
        'cost',
        'qty',
        'discount',
        'weight',
        'sku',
        'featured',
        'tag',
        'avatar',
        'view',
        'brand_id',
        'product_category_id',
    ];
    public function brand(){
        return $this ->belongsTo(Brand::class,'brand_id','id');
    }
    public function productCategory(){
        return $this ->belongsTo(Category::class,'product_category_id','id');
    }
    public function productImages(){
        return $this ->hasMany(Product_image::class,'product_id','id');
    
    }
    public function productDetails(){
        return $this ->hasMany(ProductDetail::class,'product_id','id');
    
    }
    public function productComments(){
        return $this ->hasMany(product_comment::class,'product_id','id');
    
    }
}
