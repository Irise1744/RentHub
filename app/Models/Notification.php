<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Booking;

class Notification extends Model
{
    use HasFactory;

    /**
     * Primary key to match migration.
     */
    protected $primaryKey = 'notification_id';

    protected $fillable = [
        'user_id',
        'type',
        'message',
        'is_read',
        'booking_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }
}
