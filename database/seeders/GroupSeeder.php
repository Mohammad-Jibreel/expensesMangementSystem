<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Group; // Add this import statement

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Group::create([
            'group_name' => 'Friends Savings',
            'owner_id' => 1, // Assuming User ID 1 exists
        ]);

        Group::create([
            'group_name' => 'Family Budget',
            'owner_id' => 2, // Assuming User ID 2 exists
        ]);
    }
}
