<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Therapist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization',
        'bio',
        'image',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the services that this therapist can provide.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'service_therapist')
            ->withTimestamps();
    }

    /**
     * Scope a query to only include active therapists.
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }
}
