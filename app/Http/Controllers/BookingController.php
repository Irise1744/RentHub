<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Product;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the logged-in user
        $user = $request->user();

        // Fetch bookings where the logged-in user is the renter
        $bookings = Booking::with(['product', 'owner'])
            ->where('renter_id', $user->id)
            ->orderBy('start_date', 'desc') // Order by start date (most recent first)
            ->paginate(10); // Paginate results

        // Return the bookings to the view
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $user = $request->user();
        if (! $user) {
            abort(403);
        }

        if ($product->owner_id === $user->id) {
            return redirect()->route('products.show', $product)
                ->with('error', 'You cannot rent your own listing.');
        }

        $validated = $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        $start = Carbon::parse($validated['start_date']);
        $end = Carbon::parse($validated['end_date']);

        $days = $start->diffInDays($end) + 1; // inclusive of end date
        $total = $days * $product->price_per_day;

        $booking = Booking::create([
            'product_id' => $product->product_id,
            'renter_id' => $user->id,
            'start_date' => $start,
            'end_date' => $end,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        Notification::create([
            'user_id' => $product->owner_id,
            'type' => 'booking_request',
            'booking_id' => $booking->booking_id,
            'message' => sprintf(
                '%s requested to rent "%s" from %s to %s for %d %s. Total: $%s',
                $user->name ?? 'A user',
                $product->title,
                $start->format('M d, Y'),
                $end->format('M d, Y'),
                $days,
                $days === 1 ? 'day' : 'days',
                number_format($total, 2)
            ),
            'is_read' => false,
        ]);

        return redirect()->route('products.show', $product)
            ->with('success', 'Rental request submitted. We will notify you once the owner responds.');
    }

    public function ownerRequests(Request $request)
    {
        $user = $request->user();
        if (! $user) {
            abort(403);
        }

        $requests = Booking::with(['product', 'renter'])
            ->whereHas('product', fn($q) => $q->where('owner_id', $user->id))
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);

        return view('bookings.requests', compact('requests'));
    }

    public function accept(Request $request, Booking $booking)
    {
        $user = $request->user();

        // 1️⃣ Authorization: only owner can accept
        if (! $user || ($booking->product?->owner_id !== $user->id && ! ($user->is_admin ?? false))) {
            abort(403, 'You are not authorized to accept this booking.');
        }

        // 2️⃣ Check if booking is still pending
        if ($booking->status !== 'pending') {
            return back()->with('error', 'This booking has already been processed.');
        }

        // 3️⃣ Wrap in a transaction to ensure atomicity
        DB::transaction(function () use ($booking) {
            // a) Mark booking as completed/confirmed
            $booking->update(['status' => 'completed']);

            // b) Update product rental_status and availability window
            $product = $booking->product;
            if ($product) {
                $product->update([
                    'status' => 'inactive',
                    'available_from' => $booking->start_date,
                    'available_to' => $booking->end_date,
                ]);
            }

            // c) Notify the renter
            Notification::create([
                'user_id' => $booking->renter_id,
                'type' => 'booking_response',
                'booking_id' => $booking->booking_id,
                'message' => sprintf('Your booking for "%s" has been accepted.', $product?->title ?? 'the item'),
                'is_read' => false,
            ]);
        });

        // 4️⃣ Return back with success message
        return back()->with('success', 'Booking accepted.');
    }


    public function reject(Request $request, Booking $booking)
    {
        $user = $request->user();
        if (! $user || $booking->product?->owner_id !== $user->id) {
            abort(403);
        }

        if ($booking->status !== 'pending') {
            return back()->with('error', 'This booking has already been processed.');
        }

        DB::transaction(function () use ($booking) {
            // mark booking as rejected
            $booking->update(['status' => 'rejected']);

            // ensure product rental status becomes available again
            $product = $booking->product;
            if ($product) {
                $product->update([
                    'rental_status' => 'available',
                    'available_from' => null,
                    'available_to' => null,
                ]);
            }

            Notification::create([
                'user_id' => $booking->renter_id,
                'type' => 'booking_response',
                'booking_id' => $booking->booking_id,
                'message' => sprintf('Your booking for "%s" was rejected by the owner.', $product?->title ?? 'the item'),
                'is_read' => false,
            ]);
        });

        return back()->with('success', 'Booking rejected.');
    }

    /**
     * Complete a booking and mark product as available again
     */
    public function complete(Request $request, Booking $booking)
    {
        $user = $request->user();
        if (! $user || ($booking->product?->owner_id !== $user->id && ! ($user->is_admin ?? false))) {
            abort(403);
        }

        if ($booking->status === 'completed') {
            return back()->with('error', 'This booking is already completed.');
        }

        DB::transaction(function () use ($booking) {
            $booking->update(['status' => 'completed']);

            $product = $booking->product;
            if ($product) {
                $product->update([
                    'rental_status' => 'available',
                    'available_from' => null,
                    'available_to' => null,
                ]);
            }

            Notification::create([
                'user_id' => $booking->renter_id,
                'type' => 'booking_response',
                'booking_id' => $booking->booking_id,
                'message' => sprintf('Your booking for "%s" has been completed.', $product?->title ?? 'the item'),
                'is_read' => false,
            ]);
        });

        return back()->with('success', 'Booking completed and product is now available.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Display rental history for the authenticated renter
     */
    public function myRentals(Request $request)
    {
        $user = $request->user();
        if (! $user) {
            abort(403);
        }

        $rentals = Booking::with(['product', 'renter'])
            ->where('renter_id', $user->id)
            ->latest()
            ->paginate(15);

        return view('bookings.my_rentals', compact('rentals'));
    }

    /**
     * Display rental history for products rented out by the authenticated user
     */
    public function rentedOut(Request $request)
    {
        $user = $request->user();
        if (! $user) {
            abort(403);
        }

        $rentals = Booking::with(['product', 'renter'])
            ->whereHas('product', fn($q) => $q->where('owner_id', $user->id))
            ->latest()
            ->paginate(15);

        return view('bookings.rented_out', compact('rentals'));
    }

    /**
     * Display all rentals (admin view)
     */
    public function allRentals(Request $request)
    {
        $user = $request->user();

        if (! $user || ! Gate::allows('view-all-rentals', $user)) {
            abort(403);
        }

        $rentals = Booking::with(['product', 'renter'])
            ->latest()
            ->paginate(15);

        return view('bookings.all_rentals', compact('rentals'));
    }
}
