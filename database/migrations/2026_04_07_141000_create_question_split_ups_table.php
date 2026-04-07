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
        Schema::create('question_split_ups', function (Blueprint $table) {
            $table->id();
            
            // Mock Test Split Up
            $table->integer('mock_l1')->default(0);
            $table->integer('mock_l2')->default(0);
            $table->integer('mock_l3')->default(0);

            // Pre Test Split Up
            $table->integer('pre_l1')->default(0);
            $table->integer('pre_l2')->default(0);
            $table->integer('pre_l3')->default(0);

            // Final Test Split Up
            $table->integer('final_l1')->default(0);
            $table->integer('final_l2')->default(0);
            $table->integer('final_l3')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_split_ups');
    }
};
