<?php
namespace App\Service\Blog;

use App\Repositories\Blog\BlogRepositoryInterface;
use App\Service\BaseService;

class BlogService extends BaseService implements BlogServiceInterface {
    public $repository;

    public function __construct(BlogRepositoryInterface $BlogRepository){
        $this->repository =$BlogRepository;
    }
    public function getBlogs($limit){
       return $this ->repository->getBlogs($limit);
    }
       public function getlongBlogs($limit){
        return $this->repository->getlongBlogs($limit);
       }
       public function getAllBlogsPaginated($perPage){
        return $this->repository->getAllBlogsPaginated($perPage);
       }
      
}