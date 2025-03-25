<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Housing'],
            ['name' => 'Food'],
            ['name' => 'Transportation'],
            ['name' => 'Utilities'],
            ['name' => 'Insurance'],
            ['name' => 'Medical & Healthcare'],
            ['name' => 'Savings'],
            ['name' => 'Debt Payments'],
            ['name' => 'Personal Spending'],
            ['name' => 'Recreation & Entertainment'],
            ['name' => 'Education'],
            ['name' => 'Gifts & Donations'],
            ['name' => 'Other']
        ];

        ExpenseCategory::insert($categories);
    }
}
