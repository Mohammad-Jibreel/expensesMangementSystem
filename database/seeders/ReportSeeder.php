<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report; // Add this import statement
use App\Models\User; // Add this import statement
use App\Models\Category; // Add this import statement

use Faker\Factory as Faker;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate reports for multiple users and categories
        foreach (range(1, 10) as $index) { // Create 10 reports
            $user = User::inRandomOrder()->first();
            $category = Category::inRandomOrder()->first();

            Report::create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'total_expense' => $faker->randomFloat(2, 50, 1000), // Random expense
                'month' => $faker->numberBetween(1, 12), // Random month (1-12)
                'year' => $faker->numberBetween(2023, 2025), // Random year
            ]);
        }
    }
}
