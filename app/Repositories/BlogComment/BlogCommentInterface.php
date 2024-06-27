<?php 
namespace App\Repositories\BlogComment;

use App\Repositories\RepositoriesInterface;


interface BlogCommentInterface  extends RepositoriesInterface
{
    public function getCommentsByBlogId($BlogId, $perPage);
}