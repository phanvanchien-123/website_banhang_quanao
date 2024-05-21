<?php
namespace App\Service\ProductComment;

use App\Repositories\ProductComment\ProductCommentInterface;
use App\Service\BaseService;


class ProductCommentService extends BaseService implements ProductCommentServiceInterface {
    public $repository;

    public function __construct(ProductCommentInterface $productCommentRepository){
        $this->repository = $productCommentRepository;
    }
    public function getCommentsByProductId($productId, $perPage){
        return $this->repository->getCommentsByProductId($productId, $perPage);
    }
}