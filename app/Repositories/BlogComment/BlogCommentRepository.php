<?php

namespace App\Repositories\BlogComment;

use App\Models\Blog_comment;
use App\Repositories\BaseRepositories;

class BlogCommentRepository extends BaseRepositories implements BlogCommentInterface
{
    public function getModel(){
        return Blog_comment::class;
    }
    public function getCommentsByBlogId($BlogId, $perPage) {
        return $this->model->where('blog_id', $BlogId)->paginate($perPage);
    }
}