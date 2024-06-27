<?php

namespace App\Repositories\OrderDetail;


use App\Models\Order_Details;
use App\Repositories\BaseRepositories;

class OrderDetailRepository extends BaseRepositories implements OrderDetailRepositoryInterface
{
    public function getModel(){
        return Order_Details::class;
    }
    public function countProductSold($productId)
    {
        return $this->model->where('product_id', $productId)
            ->whereHas('order', function($query) {
                $query->where('status', 7);
            })
            ->sum('qty');
    }
 
}