<?php 
namespace App\Repositories\Order;

use App\Repositories\RepositoriesInterface;


interface OrderRepositoryInterface  extends RepositoriesInterface
{
    public function getOrderUserId($userId);
    public function delete($orderId);
}