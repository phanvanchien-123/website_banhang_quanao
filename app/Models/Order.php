<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table ='orders';
    protected $fillable = ['user_id','address','home_address', 'email', 'phone','coupon_id','total','payment_type','status'];
    protected $primaryKey ='id';
    protected $quarded =[];

    public function orderDetails(){
        return $this ->hasMany(Order_Details::class,'order_id','id');
    }
    public function user(){
        return $this ->belongsTo(User::class,'user_id','id');
    }
    public function coupon()
    {
        return $this->belongsTo(Coupon::class,'coupon_id','id');
    }
}
