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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_detail_id')->constrained('course_details')->cascadeOnDelete();
            $table->foreignId('state_council_id')->nullable()->constrained('state_councils')->nullOnDelete();
            $table->string('payment_mode', 64);
            $table->date('start_date');
            $table->date('end_date');
            $table->text('remarks')->nullable();
            $table->string('payment_status', 32)->default('completed');
            $table->foreignId('recorded_by_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
