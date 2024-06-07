<?php

namespace App\Repositories\ProductCategory;

use App\Models\Category;
use App\Repositories\BaseRepositories;

class ProductCategoryRepository extends BaseRepositories implements ProductCategoryRepositoryInterface
{
    public function getModel(){
        return Category::class;
    }
}