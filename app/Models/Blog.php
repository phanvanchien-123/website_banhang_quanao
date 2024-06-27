<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table ='blogs';
    protected $primaryKey ='id';
    protected $quarded =[];
    protected $fillable=[
        'id',
        'title',
        'subtitle',
        'image',
        'category',
        'content',
        'view',
        'user_id',
    ];

    public function blogComments(){
        return $this ->hasMany(blog_comment::class,'blog_id','id');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
