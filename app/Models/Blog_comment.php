<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog_comment extends Model
{
    use HasFactory;
    protected $table ='blog_comments';
    protected $primaryKey ='id';
    protected $quarded =[];

    public function blog(){
        return $this ->belongsTo(blog::class,'blog_id','id');
    }
    public function user(){
        return $this ->belongsTo(User::class,'user_id','id');
    }
}
