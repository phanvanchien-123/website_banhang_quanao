<?php 
namespace App\Service\BlogComment;

use App\Service\ServiceInterface;

interface BlogCommentServiceInterface extends ServiceInterface{
    public function getCommentsByBlogId($BlogId, $perPage);
}