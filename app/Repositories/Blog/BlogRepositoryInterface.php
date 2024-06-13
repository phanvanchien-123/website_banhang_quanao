<?php 
namespace App\Repositories\Blog;

use App\Repositories\RepositoriesInterface;

interface BlogRepositoryInterface  extends RepositoriesInterface
{
    public function getBlogs($limit);
    public function getlongBlogs($limit);
    public function getAllBlogsPaginated($perPage);
}