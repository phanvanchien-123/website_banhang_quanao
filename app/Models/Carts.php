<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    protected $table ='carts';
    protected $primaryKey ='id';
    protected $fillable = ['user_id'];
    public function cartItems()
    {
        return $this->hasMany(Cart_items::class,'cart_id','id');
    }
}
