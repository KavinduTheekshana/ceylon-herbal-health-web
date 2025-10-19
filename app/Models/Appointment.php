<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'age',
        'service_id',
        'therapist_id',
        'practitioner_id',
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
        'age' => 'integer',
    ];

    /**
     * Get the service associated with the appointment
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the therapist associated with the appointment
     */
    public function therapist(): BelongsTo
    {
        return $this->belongsTo(Therapist::class);
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
     * Scope for today's appointments
     */
    public function scopeToday($query)
    {
        return $query->whereDate('preferred_date', Carbon::today());
    }

    /**
     * Get formatted appointment date and time
     */
    public function getFormattedDateTimeAttribute()
    {
        return $this->preferred_date->format('M j, Y') . ' at ' . 
               Carbon::parse($this->preferred_time)->format('g:i A');
    }

    /**
     * Get status badge color for admin
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

    /**
     * Check if appointment is upcoming
     */
    public function getIsUpcomingAttribute()
    {
        $appointmentDateTime = Carbon::parse($this->preferred_date->format('Y-m-d') . ' ' . $this->preferred_time);
        return $appointmentDateTime->isFuture();
    }

    /**
     * Get practitioner name (legacy - kept for backward compatibility)
     * Use therapist relationship instead for new appointments
     */
    public function getPractitionerNameAttribute()
    {
        // If therapist relationship exists, use it
        if ($this->therapist) {
            return $this->therapist->name;
        }

        // Fallback to legacy practitioner_id
        return match($this->practitioner_id) {
            1 => 'Dr. Kumara Perera',
            2 => 'Dr. Anisha Silva',
            3 => 'Therapist Nimal Fernando',
            default => 'Any Available Practitioner'
        };
    }
}