<?php 
namespace App\Service\Order;

use App\Service\ServiceInterface;

interface OrderServiceInterface extends ServiceInterface{
    public function getOrderUserId($userId,$status);
    public function totalorder($userId);
 
}