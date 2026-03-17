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
        Schema::create('state_councils', function (Blueprint $table) {
            $table->id();
            $table->string('state_name')->nullable();
            $table->string('council_name')->nullable();
            $table->json('courses')->nullable();
            $table->json('pass_percentage')->nullable();
            $table->json('mrp')->nullable();
            $table->json('price')->nullable();
            $table->json('points')->nullable();
            $table->json('valid_days')->nullable();
            $table->boolean('active_status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_councils');
    }
};
