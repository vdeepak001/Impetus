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
            $table->string('gender')->nullable()->after('date_of_birth');
            $table->string('pan_number')->nullable()->after('tax_id');
            $table->string('aadhar_number')->nullable()->after('pan_number');
            $table->string('district')->nullable()->after('city');
            $table->string('address_line_1')->nullable()->after('address');
            $table->string('address_line_2')->nullable()->after('address_line_1');
            $table->string('rm_number')->nullable()->after('rn_number');
            $table->string('academic_state')->nullable()->after('qualification');
            $table->string('institution_name')->nullable()->after('academic_state');
            $table->string('completed_year')->nullable()->after('institution_name');
            $table->string('total_years_experience')->nullable()->after('designation');
            $table->string('organization_name')->nullable()->after('total_years_experience');
            $table->string('organization_type')->nullable()->after('organization_name');
            $table->string('department_name')->nullable()->after('organization_type');
            $table->string('professional_address_line_1')->nullable()->after('department_name');
            $table->string('professional_address_line_2')->nullable()->after('professional_address_line_1');
            $table->string('professional_city')->nullable()->after('professional_address_line_2');
            $table->string('professional_district')->nullable()->after('professional_city');
            $table->string('professional_state')->nullable()->after('professional_district');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'pan_number',
                'aadhar_number',
                'district',
                'address_line_1',
                'address_line_2',
                'rm_number',
                'academic_state',
                'institution_name',
                'completed_year',
                'total_years_experience',
                'organization_name',
                'organization_type',
                'department_name',
                'professional_address_line_1',
                'professional_address_line_2',
                'professional_city',
                'professional_district',
                'professional_state',
            ]);
        });
    }
};
