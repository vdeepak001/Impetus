<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_test_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_test_attempt_id')->constrained('course_test_attempts')->cascadeOnDelete();
            $table->foreignId('course_question_id')->constrained('course_questions')->cascadeOnDelete();
            $table->unsignedSmallInteger('display_index');
            $table->char('selected_choice', 1)->nullable();
            $table->boolean('is_correct')->nullable();
            $table->timestamps();

            $table->unique(['course_test_attempt_id', 'course_question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_test_answers');
    }
};
