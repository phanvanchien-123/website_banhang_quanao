<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_comment extends Model
{
    use HasFactory;
    protected $table ='product_comments';
    protected $primaryKey ='id';
    protected $quarded =[];
    protected $fillable = [ 'product_id', 'user_id','messages', 'rating','status'];

    public function product(){
        return $this ->belongsTo(product::class,'product_id','id');
    
    }
    public function user(){
        return $this ->belongsTo(User::class,'user_id','id');
    
    }
}
