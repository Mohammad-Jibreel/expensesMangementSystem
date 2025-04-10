<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SavingGoal;

class SavingGoalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // بيانات تجريبية
        $goals = [
            [
                'goal_name'         => 'Buy New Laptop',
                'goal_amount'       => 1000.00,
                'monthly_income'    => 600.00,
                'saving_percentage' => 20, // نسبة 20%
                // حساب التوفير الشهري
                'monthly_savings'   => 600.00 * (20 / 100), // 120.00
                // حساب عدد الأشهر المتوقع لتحقيق الهدف باستخدام الدالة ceil للتقريب للأعلى
                'remaining_months'  => (int) ceil(1000.00 / (600.00 * (20 / 100))),
                'budget_id'         => 1, // تأكد من وجود ميزانية بالـ id المطلوب
                'user_id'           => 1, // تأكد من وجود مستخدم بالـ id المطلوب
            ],
            [
                'goal_name'         => 'Car Down Payment',
                'goal_amount'       => 5000.00,
                'monthly_income'    => 1500.00,
                'saving_percentage' => 15, // نسبة 15%
                'monthly_savings'   => 1500.00 * (15 / 100), // 225.00
                'remaining_months'  => (int) ceil(5000.00 / (1500.00 * (15 / 100))),
                'budget_id'         => 2, // تأكد من وجود الميزانية بالـ id المطلوب
                'user_id'           => 1,
            ],
            // يمكنك إضافة المزيد من البيانات هنا
        ];

        foreach ($goals as $goal) {
            SavingGoal::create($goal);
        }
    }
}
