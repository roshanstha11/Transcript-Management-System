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
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('programme_name');
            $table->unsignedBigInteger('transcript_number');
            $table->string('registration_number');
            $table->string('school_name');
            $table->string('student_name');
            $table->string('nationality');
            $table->string('gender');
            $table->string('result_type');
            $table->decimal('result',5,2);
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_submissions');
    }
};
