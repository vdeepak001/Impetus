<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('course_detail_state_council')) {
            return;
        }

        Schema::create('course_detail_state_council', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_council_id')->constrained('state_councils')->cascadeOnDelete();
            $table->foreignId('course_detail_id')->constrained('course_details')->cascadeOnDelete();
            $table->unique(['state_council_id', 'course_detail_id'], 'cdsc_council_course_unique');
            $table->timestamps();
        });

        if (Schema::hasColumn('state_councils', 'course_detail_id')) {
            $now = now();
            $stateCouncils = DB::table('state_councils')->whereNotNull('course_detail_id')->get();
            $inserts = $stateCouncils->map(fn ($row) => [
                'state_council_id' => $row->id,
                'course_detail_id' => $row->course_detail_id,
                'created_at' => $now,
                'updated_at' => $now,
            ])->all();
            if (! empty($inserts)) {
                DB::table('course_detail_state_council')->insert($inserts);
            }
            Schema::table('state_councils', function (Blueprint $table) {
                $table->dropForeign(['course_detail_id']);
                $table->dropColumn('course_detail_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('state_councils', 'course_detail_id')) {
            Schema::table('state_councils', function (Blueprint $table) {
                $table->foreignId('course_detail_id')->nullable()->after('council_name')->constrained('course_details')->cascadeOnDelete();
            });
            $firstCourse = DB::table('course_detail_state_council')->select('state_council_id', 'course_detail_id')->orderBy('state_council_id')->get()->groupBy('state_council_id');
            foreach ($firstCourse as $stateCouncilId => $pivots) {
                DB::table('state_councils')->where('id', $stateCouncilId)->update(['course_detail_id' => $pivots->first()->course_detail_id]);
            }
            Schema::table('state_councils', function (Blueprint $table) {
                $table->dropForeign(['course_detail_id']);
            });
        }
        Schema::dropIfExists('course_detail_state_council');
    }
};
