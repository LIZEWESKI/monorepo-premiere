<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Borrower;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $borrow_date = fake()->dateTimeBetween('-1 month');
        $return_date = fake()->randomElement([null,fake()->dateTimeBetween($borrow_date,"now")]);
        $status = $return_date !== null ? "returned" : fake()->randomElement(["borrowed","overdue"]);
        return [
            "book_id" => Book::factory(),
            "borrower_id" => Borrower::factory(),
            "borrow_date" => $borrow_date,
            "return_date" => $return_date,
            "status" => $status
        ];
    }
}
