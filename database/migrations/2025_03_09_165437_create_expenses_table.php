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
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id'); // Ensure this matches the type of users.id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Ensure table name is plural
            $table->unsignedBigInteger('category_id'); // Ensure this matches the type of users.id
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // Ensure table name is plural
            $table->double('amount');
            $table->date('date')->default(DB::raw('CURRENT_DATE'));
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
