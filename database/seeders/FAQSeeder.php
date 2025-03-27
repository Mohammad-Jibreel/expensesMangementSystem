<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FAQ;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FAQ::insert([
            [
                'question' => 'How does this expense management system work?',
                'answer'   => 'Our system helps you track expenses, set budgets, and save efficiently. You can categorize your expenses, generate reports, and achieve financial goals easily.',
            ],
            [
                'question' => 'Is my financial data secure?',
                'answer'   => 'Yes! We use the latest security protocols to ensure your data remains safe and confidential.',
            ],
            [
                'question' => 'Can I use this app for shared expenses or group savings?',
                'answer'   => 'Absolutely! Our app supports group savings and shared expenses, making it easy to manage finances with family, friends, or colleagues.',
            ],
            [
                'question' => 'Is there a mobile app available?',
                'answer'   => 'We are currently working on a mobile version! Stay tuned for updates on our official website.',
            ],
            [
                'question' => 'How can I contact customer support?',
                'answer'   => 'You can reach out to us via email at support@yourexpenseapp.com or call us at +1 (555) 123-4567.',
            ],
        ]);
    }
}
