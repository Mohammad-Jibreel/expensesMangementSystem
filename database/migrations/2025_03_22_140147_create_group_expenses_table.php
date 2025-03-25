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
        Schema::create('group_expenses', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing primary key named 'id'
            $table->unsignedBigInteger('user_id'); // Foreign key for users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Ensure table name is plural

            $table->double('amount'); // Column for the expense amount
            $table->date('date'); // Column for the date of the expense
            $table->string('description'); // Column for a description of the expense
            $table->timestamps(); // Creates created_at and updated_at timestamp columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_expenses');
    }
};
