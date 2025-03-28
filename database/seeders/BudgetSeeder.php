<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Budget;
use Faker\Factory as Faker;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Create 5 users
        foreach (range(1, 5) as $index) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);

            // Create 5 categories
            foreach (range(1, 5) as $categoryIndex) {
                Category::create([
                    'category_name' => $faker->word,
                ]);
            }

            // Create a budget for each user for each month
            foreach (range(1, 12) as $month) {
                Budget::create([
                    'user_id' => $user->id,
                    'salary' => $faker->randomFloat(2, 1000, 5000),
                    'total_expenses' => 0,
                    'remaining_balance' => $faker->randomFloat(2, 1000, 5000),
                    'year' => now()->year,
                    'month' => $month,
                ]);
            }

            // Create 5 random expenses for each user
            foreach (range(1, 5) as $expenseIndex) {
                Expense::create([
                    'user_id' => $user->id,
                    'amount' => $faker->randomFloat(2, 10, 1000),
                    'date' => $faker->date,
                    'description' => $faker->sentence,
                    'category_id' => rand(1, 5), // Random category ID between 1 and 5
                ]);
            }
        }
    }
}
