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
        Schema::table('transcript', function (Blueprint $table) {
            $table->string('programme_name')->after('form_submission_id');
            $table->string('registration_number')->after('programme_name');
            $table->string('school_name')->after('registration_number');
            $table->string('student_name')->after('school_name');
            $table->string('nationality')->after('student_name');
            $table->string('gender')->after('nationality');
            $table->string('result_type')->after('gender');
            $table->decimal('result', 5, 2)->after('result_type');
            $table->string('remarks')->nullable()->after('result');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transcript', function (Blueprint $table) {
            $table->dropColumn([
                'programme_name',
                'registration_number',
                'school_name',
                'student_name',
                'nationality',
                'gender',
                'result_type',
                'result',
                'remarks'
            ]);
        });
    }
};
