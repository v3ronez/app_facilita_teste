<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

class BookRepository extends BaseRepository
{
    private Model $model;

    public function __construct()
    {
        $this->model = new Book();
        parent::__construct($this->model);
    }

    public function getPaginateBootstrap($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }


}
