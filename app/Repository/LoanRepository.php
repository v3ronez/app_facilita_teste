<?php

namespace App\Repository;


use App\Models\Loan;
use Illuminate\Database\Eloquent\Model;

class LoanRepository extends BaseRepository
{
    private Model $model;

    public function __construct()
    {
        $this->model = new Loan();
        parent::__construct($this->model);
    }

    public function getPaginateBootstrap($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }
}
