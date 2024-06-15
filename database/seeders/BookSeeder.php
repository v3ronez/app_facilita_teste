<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Gender;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::factory(40)->create();
        for ($index = 1; $index < Gender::all()->count(); $index++) {
            $gender = Gender::find($index);
            $book = $books[$index];
            $book->gender = $gender->name;
        }
    }
}
