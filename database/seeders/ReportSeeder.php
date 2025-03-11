<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report; // Add this import statement
use App\Models\User; // Add this import statement

use Faker\Factory as Faker;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate 5 random reports for users
        foreach (range(1, 5) as $index) {
            Report::create([
                'userID' => User::inRandomOrder()->first()->id, // Get a random user ID
                'totalExpenses' => $faker->randomFloat(2, 50, 1000),
                'totalIncome' => $faker->randomFloat(2, 100, 2000),
                'netBalance' => $faker->randomFloat(2, 50, 1500),
                'startDate' => $faker->date(),
                'endDate' => $faker->date(),
            ]);
        }
    }
}
