<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'admin_reply',
        'replied_at',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Status constants
    const STATUS_NEW = 'new';
    const STATUS_READ = 'read';
    const STATUS_REPLIED = 'replied';
    const STATUS_CLOSED = 'closed';

    public static function getStatuses(): array
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_READ => 'Read',
            self::STATUS_REPLIED => 'Replied',
            self::STATUS_CLOSED => 'Closed',
        ];
    }

    /**
     * Scope a query to only include new contacts.
     */
    public function scopeNew(Builder $query): void
    {
        $query->where('status', self::STATUS_NEW);
    }

    /**
     * Scope a query to only include unread contacts.
     */
    public function scopeUnread(Builder $query): void
    {
        $query->whereIn('status', [self::STATUS_NEW]);
    }

    /**
     * Scope a query to only include read contacts.
     */
    public function scopeRead(Builder $query): void
    {
        $query->whereIn('status', [self::STATUS_READ, self::STATUS_REPLIED, self::STATUS_CLOSED]);
    }

    /**
     * Mark the contact as read.
     */
    public function markAsRead(): bool
    {
        if ($this->status === self::STATUS_NEW) {
            return $this->update(['status' => self::STATUS_READ]);
        }
        
        return true;
    }

    /**
     * Mark the contact as replied.
     */
    public function markAsReplied(string $reply = null): bool
    {
        $data = [
            'status' => self::STATUS_REPLIED,
            'replied_at' => now(),
        ];

        if ($reply) {
            $data['admin_reply'] = $reply;
        }

        return $this->update($data);
    }

    /**
     * Mark the contact as closed.
     */
    public function markAsClosed(): bool
    {
        return $this->update(['status' => self::STATUS_CLOSED]);
    }

    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return self::getStatuses()[$this->status] ?? $this->status;
    }

    /**
     * Check if the contact is new.
     */
    public function isNew(): bool
    {
        return $this->status === self::STATUS_NEW;
    }

    /**
     * Check if the contact has been replied to.
     */
    public function isReplied(): bool
    {
        return $this->status === self::STATUS_REPLIED;
    }

    /**
     * Check if the contact is closed.
     */
    public function isClosed(): bool
    {
        return $this->status === self::STATUS_CLOSED;
    }
}