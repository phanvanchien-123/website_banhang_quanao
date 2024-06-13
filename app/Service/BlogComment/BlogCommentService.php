<?php
namespace App\Service\BlogComment;

use App\Repositories\BlogComment\BlogCommentInterface;
use App\Service\BaseService;


class BlogCommentService extends BaseService implements BlogCommentServiceInterface {
    public $repository;

    public function __construct(BlogCommentInterface $BlogCommentRepository){
        $this->repository = $BlogCommentRepository;
    }
    public function getCommentsByBlogId($BlogId, $perPage){
        return $this->repository->getCommentsByBlogId($BlogId, $perPage);
    }
}