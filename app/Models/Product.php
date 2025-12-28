<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Table name is "products" by default

    protected $fillable = [
        'owner_id',
        'title',
        'description',
        'category',
        'condition',
        'price_per_day',
        'location',
        'status',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
