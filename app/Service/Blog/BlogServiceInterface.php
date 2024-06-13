<?php 
namespace App\Service\Blog;

use App\Service\ServiceInterface;

interface BlogServiceInterface  extends ServiceInterface
{
    public function getBlogs($limit);
    public function getlongBlogs($limit);
    public function getAllBlogsPaginated($perPage);
}