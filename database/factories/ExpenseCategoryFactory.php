<?php

namespace Database\Factories;

use App\Models\ExpenseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseCategoryFactory extends Factory
{
    protected $model = ExpenseCategory::class;

    public function definition()
    {
        $categories = [
            'Travel',
            'Meals',
            'Supplies',
            'Equipment',
            'Other',
        ];

        return [
            'name' => $this->faker->randomElement($categories),
        ];
    }
}