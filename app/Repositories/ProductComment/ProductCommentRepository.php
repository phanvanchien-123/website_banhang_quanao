<?php

namespace App\Repositories\ProductComment;

use App\Models\product_comment;
use App\Repositories\BaseRepositories;

class ProductCommentRepository extends BaseRepositories implements ProductCommentInterface
{
    public function getModel(){
        return product_comment::class;
    }
    public function getCommentsByProductId($productId, $perPage) {
        return $this->model->where('product_id', $productId)->paginate($perPage);
    }
}