<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notebook>
 */
class NoteBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fio' => fake()->name(),
            'company' => fake()->company(),
            'tel' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'bth' => fake()->date(),
            'photo' => fake()->imageUrl(640, 480),
        ];
    }
}
