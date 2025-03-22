<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GroupExpense; // Add this import statement

class GroupExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        GroupExpense::create([
            'group_id' => 1, // Friends Savings
            'user_id' => 1,  // John Doe
            'amount' => 50.00,
            'description' => 'Dinner with friends',
        ]);

        GroupExpense::create([
            'group_id' => 2, // Family Budget
            'user_id' => 2,  // Jane Smith
            'amount' => 200.00,
            'description' => 'Grocery shopping',
        ]);
    }
}
