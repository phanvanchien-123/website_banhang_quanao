<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepositories;

class OrderRepository extends BaseRepositories implements OrderRepositoryInterface
{
    public function getModel(){
        return Order ::class;
    }
    public function getOrderUserId($userId){
        return $this->model->where('user_id',$userId)->get();
    }
    public function delete($orderId) {
        return Order::where('id', $orderId)->delete();
    }
}