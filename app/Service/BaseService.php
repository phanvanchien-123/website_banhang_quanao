<?php 
namespace App\Service;
class BaseService implements ServiceInterface{
    public $repository;

    public function all()
    {
        // Implement logic để lấy tất cả các bản ghi
       return $this->repository->all();
    }

    public function find( $id)
    {
        // Implement logic để tìm một bản ghi theo ID
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        // Implement logic để tạo một bản ghi mới
        return $this->repository->create($data);
    }

    public function update( array $data,$id)
    {
        // Implement logic để cập nhật một bản ghi
        return $this->repository->update($data,$id);
    }

    public function delete($id)
    {
        // Implement logic để xóa một bản ghi
        return $this->repository->delete($id);
    }
}