<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Expense; // Add this import statement

class ExpenseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Generate 5 random expenses for users
        foreach (range(1, 5) as $index) {
            Expense::create([
                'user_id' => 1, // Assigning to the first user, change as needed
                'amount' => $faker->randomFloat(2, 10, 1000),
                'date' => $faker->date(),
                'description' => $faker->sentence(),
            ]);
        }
    }
}
