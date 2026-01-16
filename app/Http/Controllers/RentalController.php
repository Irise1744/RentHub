<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();
        
        if (!$user) {
            // Redirect to login if user is not authenticated
            return redirect()->route('login');
        }
        
        $userId = $user->id;

        $rentingOut = Booking::where('owner_id', $userId)
            ->with(['product', 'renter']) // Changed from 'item' to 'product'
            ->orderBy('created_at', 'desc')
            ->get();

        $renting = Booking::where('renter_id', $userId)
            ->with(['product', 'owner']) // Changed from 'item' to 'product'
            ->orderBy('created_at', 'desc')
            ->get();

        return view('rentals.index', compact('rentingOut', 'renting'));
    }
}