<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Loan extends Model
{
    use softDeletes;

    protected $table = 'loans';
    protected $keyType = 'string';
    protected $fillable
        = [
            'user_id',
            'book_id',
            'loan_status'
        ];

    protected static function booted()
    {
        static::creating(fn(Loan $book) => $book->id = (string)Uuid::uuid4());
    }
}
