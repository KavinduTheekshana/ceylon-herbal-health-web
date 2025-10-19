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
        Schema::create('therapist_availability', function (Blueprint $table) {
            $table->id();
            $table->foreignId('therapist_id')->constrained()->onDelete('cascade');
            $table->date('available_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_available')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();

            // Ensure no duplicate time slots for same therapist on same date
            $table->unique(['therapist_id', 'available_date', 'start_time'], 'therapist_availability_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('therapist_availability');
    }
};
