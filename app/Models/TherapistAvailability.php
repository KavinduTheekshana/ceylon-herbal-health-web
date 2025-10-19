<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TherapistAvailability extends Model
{
    use HasFactory;

    protected $table = 'therapist_availability';

    protected $fillable = [
        'therapist_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_available',
        'notes',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'is_available' => 'boolean',
    ];

    /**
     * Get formatted day name
     */
    public function getDayNameAttribute(): string
    {
        return ucfirst($this->day_of_week);
    }

    /**
     * Get the therapist that owns this availability.
     */
    public function therapist(): BelongsTo
    {
        return $this->belongsTo(Therapist::class);
    }
}
