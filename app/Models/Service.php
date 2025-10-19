<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'image',
        'short_description',
        'description',
        'is_featured',
        'is_active',
        'order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'meta_keywords' => 'array',
    ];

    /**
     * Get the therapists that can provide this service.
     */
    public function therapists(): BelongsToMany
    {
        return $this->belongsToMany(Therapist::class, 'service_therapist')
            ->withTimestamps();
    }

    /**
     * Scope a query to only include active services.
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured services.
     */
    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }
}