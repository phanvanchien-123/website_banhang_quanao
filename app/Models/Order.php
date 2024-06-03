<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table ='orders';
    protected $fillable = ['user_id', 'first_name','last_name','country', 'street_address', 'town_city', 'email', 'phone', 'payment_type','status'];

    protected $primaryKey ='id';
    protected $quarded =[];
    public function orderDetails(){
        return $this ->hasMany(Order_Details::class,'order_id','id');
    }
}
