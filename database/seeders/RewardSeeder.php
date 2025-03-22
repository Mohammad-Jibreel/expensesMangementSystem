<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reward; // Add this import statement

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Reward::create([
            'user_id' => 1, // John Doe
            'reward_name' => 'Savings Bonus',
            'points' => 100,
        ]);

        Reward::create([
            'user_id' => 2, // Jane Smith
            'reward_name' => 'Expense Control Award',
            'points' => 200,
        ]);
    }
}
