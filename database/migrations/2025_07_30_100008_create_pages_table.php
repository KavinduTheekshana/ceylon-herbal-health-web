<?php
// File: database/migrations/2025_07_30_100008_create_pages_table.php

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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->text('excerpt')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('show_in_menu')->default(false);
            $table->string('menu_title')->nullable(); // Different title for menu display
            $table->integer('menu_order')->default(0);
            $table->string('template')->default('default'); // For different page templates
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->timestamps();

            $table->index(['is_active', 'show_in_menu', 'menu_order']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};