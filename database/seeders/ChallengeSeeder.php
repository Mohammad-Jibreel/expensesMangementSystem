<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Challenge; // Add this import statement

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Challenge::create([
            'user_id' => 1, // John Doe
            'challenge_name' => 'Save $100 in a month',
            'completed' => false,
        ]);

        Challenge::create([
            'user_id' => 2, // Jane Smith
            'challenge_name' => 'Reduce weekly spending by 20%',
            'completed' => true,
        ]);
    }
}
