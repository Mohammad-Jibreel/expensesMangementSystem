<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\GroupExpense; // Add this import statement

class GroupExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        GroupExpense::create([
            'user_id' => 1,  // John Doe
            'amount' => 50.00,
            'description' => 'Dinner with friends',
            'date' => $faker->date(),
            'group_id'=>1,
            'category_id'=>1



        ]);

        GroupExpense::create([
            'user_id' => 2,  // Jane Smith
            'amount' => 200.00,
            'description' => 'Grocery shopping',
            'date' => $faker->date(),
            'group_id'=>1,
            'category_id'=>1

        ]);
    }
}
