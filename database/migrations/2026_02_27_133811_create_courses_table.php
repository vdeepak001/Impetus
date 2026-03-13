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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code')->nullable();
            $table->string('course_name')->nullable();
            $table->string('path')->nullable();
            $table->longText('description')->nullable();
            $table->string('attachment')->nullable();
            $table->string('seo_key')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_title')->nullable();
            $table->integer('sequence')->nullable();
            $table->text('qa_text')->nullable();
            $table->text('practice_text')->nullable();
            $table->json('mock_test')->nullable();
            $table->json('pre_test')->nullable();
            $table->json('final_test')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
