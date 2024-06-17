<?php

namespace App\Services;

use App\Enums\BookStatusEnum;
use App\Enums\LoanStatusEnum;
use App\Repository\BookRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoanService
{
    private BookRepository $bookRepository;

    public function __construct($bookRepository)
    {
        $this->bookRepository = $bookRepository;
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
}
