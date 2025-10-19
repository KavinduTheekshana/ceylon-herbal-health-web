<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class TherapistHoliday extends Model
{
    use HasFactory;

    protected $fillable = [
        'therapist_id',
        'start_date',
        'end_date',
        'reason',
        'notes',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the therapist that owns this holiday.
     */
    public function therapist(): BelongsTo
    {
        return $this->belongsTo(Therapist::class);
    }

    /**
     * Get the duration in days
     */
    public function getDurationAttribute(): int
    {
        return $this->start_date->diffInDays($this->end_date) + 1;
    }

    /**
     * Check if the holiday is active (current or future)
     */
    public function isActive(): bool
    {
        return $this->end_date->isFuture() || $this->end_date->isToday();
    }

    /**
     * Scope to get approved holidays
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get pending holidays
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
