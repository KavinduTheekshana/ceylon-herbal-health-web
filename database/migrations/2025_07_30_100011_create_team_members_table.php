<?php
// File: database/migrations/2025_07_30_100011_create_team_members_table.php

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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title'); // e.g., "Senior Ayurvedic Practitioner"
            $table->string('slug')->unique();
            $table->text('bio')->nullable();
            $table->longText('detailed_bio')->nullable(); // For individual team member pages
            $table->string('image')->nullable();
            $table->json('qualifications')->nullable(); // Array of qualifications
            $table->json('specializations')->nullable(); // Array of specializations
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->integer('experience_years')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'is_featured', 'order']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
