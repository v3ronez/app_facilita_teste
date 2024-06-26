<?php

namespace App\Repository;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository
{
    private Model $model;

    public function __construct()
    {
        $this->model = new User();
        parent::__construct($this->model);
    }

    public function getPaginateBootstrap($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }
}
