<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Budget; // Add this import statement
use Faker\Factory as Faker;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate 5 random budgets for users
        foreach (range(1, 5) as $index) {
            Budget::create([
                'userID' => 1, // Assigning to the first user, change as needed
                'limit' => $faker->randomFloat(2, 100, 5000),
                'startDate' => $faker->date(),
                'endDate' => $faker->date(),
            ]);
        }
    }
}
