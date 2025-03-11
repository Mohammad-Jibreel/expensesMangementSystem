<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction; // Add this import statement
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate 20 random transactions
        foreach (range(1, 20) as $index) {
            Transaction::create([
                'userID' => 1, // Assigning to the first user, change as needed
                'transactionDate' => $faker->date(),
                'amount' => $faker->randomFloat(2, 10, 500),
                'method' => $faker->randomElement(['cash', 'credit card', 'bank transfer']),
            ]);
        }
    }
}
