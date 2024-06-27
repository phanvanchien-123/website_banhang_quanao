<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table ='photos';
    protected $primaryKey ='id';
    public $timestamps = true;
    protected $fillable=[
        'id',
        'path',
        'title',
        'type',
    ];

}
