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
        // Drop the old table
        Schema::dropIfExists('therapist_availability');

        // Create new weekly schedule table
        Schema::create('therapist_availability', function (Blueprint $table) {
            $table->id();
            $table->foreignId('therapist_id')->constrained()->onDelete('cascade');
            $table->enum('day_of_week', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_available')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();

            // Ensure no duplicate schedules for same therapist and day
            $table->unique(['therapist_id', 'day_of_week', 'start_time'], 'therapist_weekly_schedule_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('therapist_availability');

        // Recreate old table structure
        Schema::create('therapist_availability', function (Blueprint $table) {
            $table->id();
            $table->foreignId('therapist_id')->constrained()->onDelete('cascade');
            $table->date('available_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('is_available')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->unique(['therapist_id', 'available_date', 'start_time'], 'therapist_availability_unique');
        });
    }
};
