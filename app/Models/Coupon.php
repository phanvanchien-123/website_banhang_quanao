<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table ='coupons';
    protected $primaryKey ='id';
    protected $fillable = [
        'code', 'discount_value', 'discount_type', 'minimum_order_value', 'usage_limit', 'used_count', 'expires_at'
    ];
    public function isExpired() {
        return $this->expiration_date->isPast();
    }

    protected $dates = [
        'expires_at',
    ];
}
