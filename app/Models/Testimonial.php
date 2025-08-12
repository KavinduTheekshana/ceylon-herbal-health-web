<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_title',
        'client_location',
        'content',
        'client_image',
        'rating',
        'is_featured',
        'is_active',
        'order',
        'service_id',
        'treatment_date',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'treatment_date' => 'date',
        'rating' => 'integer',
    ];

    /**
     * Get the service associated with the testimonial.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Scope a query to only include active testimonials.
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured testimonials.
     */
    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    /**
     * Scope a query to order by the order field.
     */
    public function scopeOrdered(Builder $query): void
    {
        $query->orderBy('order')->orderBy('id', 'desc');
    }

    /**
     * Get rating stars array for display.
     */
    public function getRatingStarsAttribute(): array
    {
        $stars = [];
        $fullStars = floor($this->rating);
        $hasHalfStar = ($this->rating - $fullStars) >= 0.5;
        
        // Add full stars
        for ($i = 0; $i < $fullStars; $i++) {
            $stars[] = 'full';
        }
        
        // Add half star if needed
        if ($hasHalfStar && count($stars) < 5) {
            $stars[] = 'half';
        }
        
        // Add empty stars
        while (count($stars) < 5) {
            $stars[] = 'empty';
        }
        
        return $stars;
    }
}