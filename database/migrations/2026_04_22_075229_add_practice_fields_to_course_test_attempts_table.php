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
            $table->integer('practice_level')->nullable()->after('test_type');
            $table->integer('practice_set')->nullable()->after('practice_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_test_attempts', function (Blueprint $table) {
            $table->dropColumn(['practice_level', 'practice_set']);
        });
    }
};
