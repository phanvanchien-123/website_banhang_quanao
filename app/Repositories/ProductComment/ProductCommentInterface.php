<?php 
namespace App\Repositories\ProductComment;

use App\Repositories\RepositoriesInterface;


interface ProductCommentInterface  extends RepositoriesInterface
{
    public function getCommentsByProductId($productId, $perPage);
}