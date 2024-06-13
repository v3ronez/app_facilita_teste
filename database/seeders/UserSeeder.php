<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'                => 'Admin',
            'document'            => '12615757091',
            'email'               => 'v3ronez.dev@gmail.com',
            'registration_number' => uuid_create(),
            'isAdmin'             => true,
            'password'            => Hash::make('secret123'),
        ]);

        User::create([
            'email'               => 'teste@teste.com',
            'document'            => '23162029007',
            'name'                => 'User teste',
            'registration_number' => uuid_create(),
            'isAdmin'             => false,
            'password'            => Hash::make('secret123'),
        ]);
    }
}
