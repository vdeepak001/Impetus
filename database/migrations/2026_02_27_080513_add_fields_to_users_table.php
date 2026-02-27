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
        Schema::table('users', function (Blueprint $table) {
            $table->text('first_name')->after('id')->nullable();
            $table->text('last_name')->after('first_name')->nullable();
            $table->string('role_type')->after('password')->default('admin'); // superadmin, admin, sme, support
            $table->boolean('active_status')->after('role_type')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'role_type', 'active_status']);
        });
    }
};
