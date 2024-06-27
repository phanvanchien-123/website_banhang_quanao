<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepositories;

class OrderRepository extends BaseRepositories implements OrderRepositoryInterface
{
    public function getModel(){
        return Order ::class;
    }
    public function getOrderUserId($userId,$status)
    {
        return $this->model->where('user_id', $userId)->where('status', $status)->get();
    }
    public function totalorder($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }
   
}