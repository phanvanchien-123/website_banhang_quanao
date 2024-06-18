<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterLink extends Model
{
    use HasFactory;
    protected $table ='footer_links';
    protected $primaryKey ='id';
    public $timestamps = true;
    protected $fillable=[
        'id',
        'subtitle',
        'title',
        'link',
    ];

}
