<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    protected $table ='suppliers';
    protected $primaryKey ='id';
    public $timestamps = true;
    protected $fillable=[
        'id',
        'name',
        'avatar',
        'address',
        'phone',
        'email',
    ];
    public function products(){
        return $this ->hasMany(Product::class,'brand_id','id');
    }
}
