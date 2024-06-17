<?php

namespace App\Repository;


use App\Models\Loan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getAllLoans()
    {
        return DB::table('book_user')
            ->select([
                'book_user.id',
                'users.id',
                'users.cpf',
            ])
            ->Join('users', 'book_user.user_id', '=', 'users.id')
            ->join('books', 'book_user.book_id', '=', 'books.id')
            ->get();
    }
}
