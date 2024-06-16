<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use softDeletes;
    use HasUuids;

    protected $table = 'loans';
    protected $keyType = 'string';
    protected $fillable
        = [
            'user_id',
            'book_id',
            'loan_status'
        ];
}
