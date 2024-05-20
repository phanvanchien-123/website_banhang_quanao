<?php 
namespace App\Service\ProductComment;

use App\Service\ServiceInterface;

interface ProductCommentServiceInterface extends ServiceInterface{
    public function getCommentsByProductId($productId, $perPage);
}