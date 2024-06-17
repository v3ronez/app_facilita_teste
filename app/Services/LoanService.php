<?php

namespace App\Services;

use App\Enums\BookStatusEnum;
use App\Enums\LoanStatusEnum;
use App\Repository\BookRepository;
use App\Repository\LoanRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoanService
{
    private BookRepository $bookRepository;
    private LoanRepository $loanRepository;

    public function __construct($bookRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->loanRepository = new LoanRepository();
    }

    public function attach(Model $user, Model $book)
    {
        if ($user->books()->where('book_id', $book->id)->exists()) {
            return;
        }
        $user->books()->attach($book);
        $this->bookRepository->updateById($book->id, ['status' => BookStatusEnum::BORROWED]);
    }

    public function detach(Model $user, Model $book)
    {
        $user->books()->detach($book);
        $this->bookRepository->updateById($book->id, ['status' => BookStatusEnum::AVAILABLE]);
    }

    public function changeLoanStatus(Model $user, Model $book, LoanStatusEnum $status)
    {
        if ($status === LoanStatusEnum::RETURNED) {
            return $this->detach($user, $book);
        }
        return DB::table('book_user')
            ->where([
                ['book_id', '=', $book->id],
                ['user_id', '=', $user->id]
            ])
            ->whereNull('deleted_at')
            ->update(['loan_status' => $status->value]);
    }

    public function getAllLoans()
    {
        return $this->loanRepository->getAllLoans();
    }
}
