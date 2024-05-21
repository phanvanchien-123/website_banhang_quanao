<?php

namespace App\Repositories;
abstract class BaseRepositories implements RepositoriesInterface
{
    protected $model;
    public function __construct(){
       $this->model =app()->make(
        $this->getModel()
       );
    }
    abstract public function getModel();

    public function all()
    {
        // Implement logic để lấy tất cả các bản ghi
        return $this->model->all();
    }

    public function find(int $id)
    {
        // Implement logic để tìm một bản ghi theo ID
        return $this->model->findorFail($id);
    }

    public function create(array $data)
    {
        // Implement logic để tạo một bản ghi mới
        return $this->model->create($data);
    }

    public function update( array $data,$id)
    {
        // Implement logic để cập nhật một bản ghi
        $objcect = $this->model ->find($id);
        return $objcect->update($data);
    }

    public function delete($id)
    {
        // Implement logic để xóa một bản ghi
        $objcect = $this->model ->find($id);
        return $objcect->delete();
    }
}