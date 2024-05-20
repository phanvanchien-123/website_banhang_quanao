<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey ='id';
    public $timestamps = true;
    protected $fillable=[
        'id',
        'name',
        'description',
        'avatar',
    ];
    public function products(){
        return $this ->hasMany(product::class,'product_category_id','id');
    
    }

}
