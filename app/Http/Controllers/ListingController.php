<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ListingController extends Controller
{
    use AuthorizesRequests;

    /**
     * Show "My Rentals" for the logged-in user.
     */
    public function myRentals()
    {
        $user = Auth::user();

        // Rentals where the user is the renter
        $rentals = Booking::with(['product', 'owner'])
            ->where('renter_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('listings.my-rentals', compact('rentals'));
    }

    /**
     * Show "Products I Rented Out" for the logged-in user.
     */
    public function rentedOut()
    {
        $user = Auth::user();

        // Rentals where the user is the owner
        $rentedOut = Booking::with(['product', 'renter'])
            ->where('owner_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('listings.rented-out', compact('rentedOut'));
    }

    /**
     * Show all rentals for admins.
     */
    public function allRentals()
    {
        $this->authorize('viewAny', Booking::class); // Ensure only admins can access

        // All rentals
        $allRentals = Booking::with(['product', 'renter', 'owner'])
            ->latest()
            ->paginate(10);

        return view('listings.all-rentals', compact('allRentals'));
    }
}
