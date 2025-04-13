<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            "title" => fake()->words(2,true),
            "author" => fake()->name(),
            "genre" => fake()->randomElement(["Horror","Comedy","Drama","Romance","Fantasy"]),
            "published_year" => fake()->year("2000"),
            "isbn" => fake()->isbn13(),
            "status" => fake()->randomElement(["available","borrowed","lost"]),
        ];
    }
}
