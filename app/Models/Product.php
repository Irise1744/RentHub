<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * Primary key column name matches migration
     */
    protected $primaryKey = 'product_id';

    /**
     * Ensure route model binding uses product_id
     */
    public function getRouteKeyName()
    {
        return 'product_id';
    }

    /**
     * Key type and incrementing
     */
    public $incrementing = true;

    protected $keyType = 'int';
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
        'available_from',
        'available_to',
        'image_url',
    ];

    public function owner()
{
    return $this->belongsTo(User::class, 'owner_id', 'id');
}

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
