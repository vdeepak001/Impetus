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
        Schema::create('course_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question_code', 55)->nullable();
            $table->foreignId('course_id')->nullable()->constrained('course_details')->cascadeOnDelete();
            $table->string('question_type', 20)->default('mcq')->comment('mcq, text');
            $table->string('question_level', 20)->nullable();
            $table->text('question')->nullable();
            $table->string('choice_a', 255)->nullable();
            $table->string('choice_b', 255)->nullable();
            $table->string('choice_c', 255)->nullable();
            $table->string('choice_d', 255)->nullable();
            $table->text('answer')->nullable();
            $table->text('reason')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_questions');
    }
};
