<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_test_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_detail_id')->constrained('course_details')->cascadeOnDelete();
            $table->foreignId('state_council_id')->nullable()->constrained('state_councils')->nullOnDelete();
            $table->string('test_type', 20);
            $table->string('status', 20);
            /** @var array<int, int> Ordered question ids for this attempt */
            $table->json('question_ids');
            $table->decimal('score_percent', 5, 2)->nullable();
            $table->unsignedSmallInteger('correct_count')->default(0);
            $table->unsignedSmallInteger('total_questions')->default(0);
            $table->boolean('passed')->nullable();
            $table->decimal('pass_threshold_percent', 5, 2)->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'course_detail_id', 'test_type', 'status'], 'cta_user_course_test_status_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_test_attempts');
    }
};
