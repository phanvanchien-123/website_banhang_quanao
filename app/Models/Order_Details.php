<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Details extends Model
{
    use HasFactory;
    protected $table ='order_details';
    protected $fillable = ['order_id', 'product_id','qty', 'amount', 'total','size','color','coupon_id'];
    protected $primaryKey ='id';
    protected $quarded =[];
    public function order(){
        return $this ->belongsTo(Order::class,'order_id','id');
    }
    public function products(){
        return $this ->belongsTo(Product::class,'product_id','id');
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class,'coupon_id','id');
    }
}
