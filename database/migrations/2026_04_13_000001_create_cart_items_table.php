<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_detail_id')->constrained('course_details')->cascadeOnDelete();
            $table->foreignId('state_council_id')->nullable()->constrained('state_councils')->nullOnDelete();
            $table->unsignedInteger('mrp')->nullable();
            $table->unsignedInteger('offer_price')->nullable();
            $table->unsignedInteger('points')->nullable();
            $table->unsignedInteger('valid_days')->nullable();
            $table->unsignedInteger('pass_percentage')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'course_detail_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
