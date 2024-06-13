<?php

namespace App\Repository;

interface BaseRepositoryInterface
{
    public function findById(string $id);

    public function create(array $attributes);

    public function updateById(string $id, array $newValues);

    public function delete(string $id);
}
