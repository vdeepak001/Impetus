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
        Schema::table('state_councils', function (Blueprint $table) {
            $table->dropColumn(['state_name', 'courses']);
        });

        Schema::table('state_councils', function (Blueprint $table) {
            $table->foreignId('state_id')->nullable()->after('id')->constrained('states')->cascadeOnDelete();
            $table->foreignId('course_detail_id')->nullable()->after('council_name')->constrained('course_details')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('state_councils', function (Blueprint $table) {
            $table->dropForeign(['state_id']);
            $table->dropForeign(['course_detail_id']);
        });

        Schema::table('state_councils', function (Blueprint $table) {
            $table->string('state_name')->nullable()->after('id');
            $table->json('courses')->nullable()->after('council_name');
        });
    }
};
