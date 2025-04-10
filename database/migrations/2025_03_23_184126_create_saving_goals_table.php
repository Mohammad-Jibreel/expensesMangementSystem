<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('saving_goals', function (Blueprint $table) {
            $table->id();
            $table->string('goal_name'); // اسم الهدف (مثلاً: شراء لابتوب)
            $table->decimal('goal_amount', 10, 2); // المبلغ المطلوب لتحقيق الهدف
            $table->integer('saving_percentage'); // نسبة التوفير الشهرية (مثلاً: 10)
            $table->decimal('monthly_savings', 10, 2); // المبلغ الذي سيتم توفيره شهريًا (يحسب تلقائيًا)
            $table->integer('remaining_months'); // عدد الأشهر المتوقع لتحقيق الهدف (يحسب تلقائيًا)
            $table->foreignId('budget_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saving_goals');
    }
};
