<?php

namespace App\Models;

use App\Enums\BookStatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use softDeletes;
    use HasUuids;

    protected $table = 'books';
    protected $keyType = 'string';
    protected $fillable
        = [
            'title',
            'author',
            'registration_number',
            'status',
            'gender',
        ];

    protected $casts = ['status' => BookStatusEnum::class];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
