<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GroupMember; // Add this import statement

class GroupMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        GroupMember::create([
            'group_id' => 1, // Friends Savings
            'user_id' => 1,  // John Doe
        ]);

        GroupMember::create([
            'group_id' => 1,
            'user_id' => 2,  // Jane Smith
        ]);

        GroupMember::create([
            'group_id' => 2, // Family Budget
            'user_id' => 2,
        ]);
    }
}
