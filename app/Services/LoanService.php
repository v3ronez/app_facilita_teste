<?php

namespace App\Services;

use App\Enums\BookStatusEnum;
use App\Models\Book;
use App\Models\User;
use App\Repository\BaseRepository;

class LoanService
{
    private BaseRepository $bookRepository;

    public function __construct($bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function attach(User $user, Book $book)
    {
        $user->books()->attach($book);
        return $this->bookRepository->updateById($book->id, ['status' => BookStatusEnum::BORROWED]);
    }
}
