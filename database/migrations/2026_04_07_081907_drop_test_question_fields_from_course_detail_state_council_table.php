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
        Schema::table('course_detail_state_council', function (Blueprint $table) {
            $table->dropColumn(['pre_test_questions', 'mock_test_questions', 'final_test_questions']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_detail_state_council', function (Blueprint $table) {
            $table->json('pre_test_questions')->after('valid_days')->nullable();
            $table->json('mock_test_questions')->after('pre_test_questions')->nullable();
            $table->json('final_test_questions')->after('mock_test_questions')->nullable();
        });
    }
};
