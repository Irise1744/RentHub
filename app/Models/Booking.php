<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Booking extends Model
{
    use HasFactory;

    /**
     * Match the migration primary key name.
     */
    protected $primaryKey = 'booking_id';

    /**
     * Allowed attributes for mass assignment.
     */
    protected $fillable = [
        'product_id',
        'renter_id',
        'owner_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'booking_id';
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function renter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'renter_id', 'id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}