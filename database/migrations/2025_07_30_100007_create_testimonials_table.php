<?php
// File: database/migrations/2025_07_30_100007_create_testimonials_table.php

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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_title')->nullable(); // e.g., "Ayurveda Patient"
            $table->string('client_location')->nullable(); // e.g., "London, UK"
            $table->text('content');
            $table->string('client_image')->nullable();
            $table->integer('rating')->default(5); // 1-5 stars
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete(); // Which service they used
            $table->date('treatment_date')->nullable(); // When they received treatment
            $table->timestamps();

            $table->index(['is_active', 'is_featured', 'order']);
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};