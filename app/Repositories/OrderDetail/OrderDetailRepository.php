<?php

namespace App\Repositories\OrderDetail;


use App\Models\Order_Details;
use App\Repositories\BaseRepositories;

class OrderDetailRepository extends BaseRepositories implements OrderDetailRepositoryInterface
{
    public function getModel(){
        return Order_Details::class;
    }
    public function deleteByOrderId($orderId) {
        return Order_Details::where('order_id', $orderId)->delete();
    }
}