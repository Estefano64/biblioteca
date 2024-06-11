<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
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
            'title' => fake()->sentence(3), // Genera un título con 3 palabras
            'year' => fake()->year(), // Genera un año aleatorio
            'author' => fake()->name(), // Genera un nombre de autor
            'publisher' => fake()->company(), // Genera un nombre de editorial
        ];
    }
}
