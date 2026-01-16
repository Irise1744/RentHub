<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Notification;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'avatar',
        'is_admin',
        'status',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
        'password' => 'hashed',
        'status' => 'string',
    ];
     public function products()
    {
        return $this->hasMany(Product::class, 'owner_id');
    }

    // A user has many rentals (as renter/borrower)
    public function rentals()
    {
        return $this->hasMany(Booking::class, 'renter_id');
    }

    // Messages sent by this user
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Messages received by this user
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }

    // Borrowed products by the user
    public function borrowedProducts()
    {
        return $this->hasManyThrough(
            Product::class,
            Booking::class,
            'renter_id', // Foreign key on bookings table
            'product_id', // Foreign key on products table
            'id', // Local key on users table
            'product_id' // Local key on bookings table
        )->where('bookings.status', 'completed');
    }
}
