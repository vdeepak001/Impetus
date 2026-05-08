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
        Schema::table('course_test_attempts', function (Blueprint $table) {
            $table->integer('last_index')->default(0)->after('question_ids');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_test_attempts', function (Blueprint $table) {
            $table->dropColumn('last_index');
        });
    }
};
