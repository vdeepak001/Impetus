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
        Schema::table('course_detail_state_council', function (Blueprint $table) {
            $table->json('pass_percentage')->after('course_detail_id')->nullable();
            $table->json('mrp')->after('pass_percentage')->nullable();
            $table->json('offer_price')->after('mrp')->nullable();
            $table->json('points')->after('offer_price')->nullable();
            $table->json('valid_days')->after('points')->nullable();
        });

        // Migrate existing global settings to the pivot table
        $stateCouncils = DB::table('state_councils')->get();
        foreach ($stateCouncils as $council) {
            $passPct = $council->pass_percentage;
            $mrp = $council->mrp;
            $offerPrice = $council->price; // Existing column was named 'price'
            $points = $council->points;
            $validDays = $council->valid_days;

            DB::table('course_detail_state_council')
                ->where('state_council_id', $council->id)
                ->update([
                    'pass_percentage' => $passPct,
                    'mrp' => $mrp,
                    'offer_price' => $offerPrice,
                    'points' => $points,
                    'valid_days' => $validDays,
                    'updated_at' => now(),
                ]);
        }

        // Schema::table('state_councils', function (Blueprint $table) {
        //     $table->dropColumn(['pass_percentage', 'mrp', 'price', 'points', 'valid_days']);
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_detail_state_council', function (Blueprint $table) {
            $table->dropColumn(['pass_percentage', 'mrp', 'offer_price', 'points', 'valid_days']);
        });
    }
};
