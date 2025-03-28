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
            $table->string('goal_name'); // Name of the savings goal (e.g., "New Laptop")
            $table->decimal('goal_amount', 10, 2); // Total goal amount (e.g., 1200)
            $table->decimal('monthly_savings', 10, 2); // How much to save monthly (calculated based on goal amount and months)
            $table->decimal('saved_amount', 10, 2)->default(0); // Amount already saved (starts from 0)
            $table->integer('remaining_months'); // Number of months to complete the goal
            $table->foreignId('budget_id')->constrained()->onDelete('cascade'); // Budget that this goal is associated with
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who owns the goal
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
