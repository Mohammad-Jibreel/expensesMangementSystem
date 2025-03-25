<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; // Add this import statement

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            'Food & Dining',
            'Transportation',
            'Shopping',
            'Health & Fitness',
            'Entertainment',
            'Bills & Utilities',
            'Education',
            'Travel',
            'Salary',
            'Miscellaneous'
        ];

        foreach ($categories as $category) {
            Category::create([
                'category_name' => $category,
            ]);
        }
    }
}
