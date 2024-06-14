<?php

namespace Database\Factories;

use App\Enums\BookStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'               => $this->faker->sentence(),
            'author'              => $this->faker->name(),
            'registration_number' => uuid_create(),
            'status'              => BookStatusEnum::AVAILABLE,
        ];
    }
}
