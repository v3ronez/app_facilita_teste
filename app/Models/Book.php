<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
            'gender'
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genders(): BelongsToMany
    {
        return $this->belongsToMany(Gender::class);
    }
}
