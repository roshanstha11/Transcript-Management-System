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
        Schema::create('transcript', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_submission_id')->constrained()->onDelete('cascade');
            $table->string('transcript_number')->unique();
            $table->timestamp('issued_date')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transcript');
    }
};
