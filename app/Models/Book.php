<?php

namespace App\Models;

use App\Enums\BookStatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    public function borrowers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'book_user', 'book_id', 'user_id');
    }

    public function loanStatus()
    {
        return DB::table('book_user')->where('book_id', '=', $this->id)->get();
    }
}
