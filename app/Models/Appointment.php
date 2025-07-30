<?php
// File: app/Models/Appointment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'service_id',
        'preferred_date',
        'preferred_time',
        'message',
        'status',
        'admin_notes',
        'confirmed_at',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'preferred_time' => 'string',
        'confirmed_at' => 'datetime',
    ];

    /**
     * Get the service associated with the appointment
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Scope for pending appointments
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for confirmed appointments
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Get formatted appointment date and time
     */
    public function getFormattedDateTimeAttribute()
    {
        return $this->preferred_date->format('M j, Y') . ' at ' . 
               \Carbon\Carbon::parse($this->preferred_time)->format('g:i A');
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'confirmed' => 'success',
            'cancelled' => 'danger',
            'completed' => 'info',
            default => 'secondary'
        };
    }
}