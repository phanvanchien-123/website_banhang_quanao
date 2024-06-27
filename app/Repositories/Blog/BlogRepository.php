<?php
namespace App\Repositories\Blog;

use App\Models\Blog;
use App\Repositories\BaseRepositories;

class BlogRepository extends BaseRepositories implements BlogRepositoryInterface {
    public function getModel()
    {
        return Blog ::class;
    }
    public function getBlogs($limit){
       return $this->model->orderBy('id','desc')
       ->limit($limit)
       ->get();
    }
    public function getlongBlogs($limit){
        return $this->model->where('view', '>', 100) // Thêm điều kiện lượt view > 100
                       ->orderBy('id', 'desc')
                       ->limit($limit)
                       ->get();
    }
    public function getAllBlogsPaginated($perPage) {
        return $this->model->orderBy('id', 'desc')
                           ->paginate($perPage);
    }
}