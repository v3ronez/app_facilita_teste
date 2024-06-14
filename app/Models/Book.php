<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Book extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'books';
    protected $keyType = 'string';
    protected $fillable
        = [
            'title',
            'author',
            'registration_number',
            'status',
            'quantity_available'
        ];

    protected static function booted()
    {
        static::creating(fn(Book $book) => $book->id = (string)Uuid::uuid4());
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
