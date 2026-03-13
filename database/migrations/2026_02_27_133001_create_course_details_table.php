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
        Schema::create('course_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->string('course_code', 55)->nullable();
            $table->string('couse_name', 100)->nullable();
            $table->text('course_url')->nullable();
            $table->text('description')->nullable();
            $table->string('attachment', 255)->nullable();
            $table->string('seo_key', 255)->nullable();
            $table->string('seo_title', 255)->nullable();
            $table->text('seo_des')->nullable();
            $table->integer('active_status')->nullable();
            $table->integer('sequence')->nullable();
            $table->text('qa_content')->nullable();
            $table->text('practice_content')->nullable();
            $table->string('pre_test', 50)->nullable();
            $table->string('mock_test', 50)->nullable();
            $table->string('final_test', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_details');
    }
};
