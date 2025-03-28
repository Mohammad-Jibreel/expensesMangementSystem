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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // العلاقة مع جدول المستخدمين
            $table->decimal('salary', 10, 2); // الراتب الأساسي
            $table->decimal('total_expenses', 10, 2)->default(0); // إجمالي المصاريف
            $table->decimal('remaining_balance', 10, 2)->default(0); // الرصيد المتبقي بعد خصم المصاريف
            $table->integer('year'); // سنة الميزانية
            $table->integer('month'); // شهر الميزانية (من 1 إلى 12)
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['user_id', 'year', 'month']); // ضمان أن يكون لكل مستخدم ميزانية شهرية واحدة فقط

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
