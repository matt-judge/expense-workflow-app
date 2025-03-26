<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\User;
use App\Models\ExpenseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'category_id' => ExpenseCategory::factory(),
            'description' => $this->faker->sentence,
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'receipt_image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}