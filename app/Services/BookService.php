<?php

namespace App\Services;

use App\Repository\BaseRepositoryInterface;

class BookService
{
    private $repository;

    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $fields)
    {
        return $this->repository->create($fields);
    }

    public function update(string $id, array $fields)
    {
        return $this->repository->updateById($id, $fields);
    }

    public function delete(string $id)
    {
        return $this->repository->delete($id);
    }

    public function getPaginateBootstrap()
    {
        return $this->repository->getPaginateBootstrap();
    }

    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    public function withRelations($id, array $array = [])
    {
        return $this->repository->withRelations($id, $array);
    }
}
