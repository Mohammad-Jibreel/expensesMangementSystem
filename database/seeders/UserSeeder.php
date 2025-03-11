<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Add this import statement
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        // Create an admin user with a unique email
        User::create([
            'name' => 'Admin User',
            'email' => 'admin_' . $faker->unique()->safeEmail, // Ensures a unique admin email
            'password' => Hash::make('password123'),
            'current_team_id' => null,
            'profile_photo_path' => null,
        ]);

        // Generate 10 random users
        foreach (range(1, 10) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail, // Faker will create unique emails
                'password' => Hash::make('password'),
                'current_team_id' => null,
                'profile_photo_path' => $faker->imageUrl,
            ]);
        }
    }
}
