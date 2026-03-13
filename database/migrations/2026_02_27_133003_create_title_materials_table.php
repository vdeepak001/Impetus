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
        Schema::create('title_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained('course_details')->cascadeOnDelete();
            $table->foreignId('course_title_id')->nullable()->constrained('course_title')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('description')->nullable();
            $table->text('attachment')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('title_materials');
    }
};
