<?php
namespace App\Service\Order;

use App\Repositories\Order\OrderRepositoryInterface;
use App\Service\BaseService;


class OrderService extends BaseService implements OrderServiceInterface {
    public $repository;

    public function __construct(OrderRepositoryInterface $OrderRepository){
        $this->repository = $OrderRepository;
    }
    public function getOrderUserId($userId,$status){
        return $this->repository->getOrderUserId($userId,$status);
    }
    public function totalorder($userId){
        return $this->repository->totalorder($userId);
    }
   
}