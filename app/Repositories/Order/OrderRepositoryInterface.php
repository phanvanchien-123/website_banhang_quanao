<?php 
namespace App\Repositories\Order;

use App\Repositories\RepositoriesInterface;


interface OrderRepositoryInterface  extends RepositoriesInterface
{
    public function getOrderUserId($userId,$status);
    public function totalorder($userId);
    
}