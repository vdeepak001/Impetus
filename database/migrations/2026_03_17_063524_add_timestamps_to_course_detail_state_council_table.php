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
        if (! Schema::hasTable('course_detail_state_council')) {
            return;
        }

        Schema::table('course_detail_state_council', function (Blueprint $table) {
            if (! Schema::hasColumn('course_detail_state_council', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('course_detail_state_council', 'created_at')) {
            Schema::table('course_detail_state_council', function (Blueprint $table) {
                $table->dropTimestamps();
            });
        }
    }
};
