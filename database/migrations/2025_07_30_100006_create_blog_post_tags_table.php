<?php
// File: database/migrations/2025_07_30_100006_create_blog_post_tags_table.php

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
        Schema::create('blog_post_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_post_id')->constrained('blog_posts')->cascadeOnDelete();
            $table->foreignId('blog_tag_id')->constrained('blog_tags')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['blog_post_id', 'blog_tag_id']);
            $table->index('blog_post_id');
            $table->index('blog_tag_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_post_tags');
    }
};