<?php
namespace app\Repositories;

use App\Models\Result;

class ResultRepository
{
    public function __construct(
        protected Result $resultModel
    ){}

    public function findById($id)
    {
        return $this->resultModel->find($id);
    }

    public function create(array $data)
    {
        return $this->resultModel->create($data);
    }
}
