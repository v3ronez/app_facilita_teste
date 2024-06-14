<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gender::create([
            'name' => 'ficção'
        ]);
        Gender::create([
            'name' => 'romance'
        ]);
        Gender::create([
            'name' => 'fantasia'
        ]);
        Gender::create([
            'name' => 'aventura'
        ]);
        Gender::create([
            'name' => 'terror'
        ]);
    }
}
