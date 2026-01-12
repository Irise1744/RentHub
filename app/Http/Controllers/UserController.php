<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Booking;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(20);
        $products = \App\Models\Product::where('status','active')->latest()->take(10)->get();
        return view('users.index', compact('users','products'));
    }

    /**
     * Show the authenticated user's home/dashboard view.
     */
    public function home(Request $request)
    {
        $user = $request->user();

        $discoverPreview = Product::with('owner')
            ->where('status', 'active')
            ->when($user, fn($q) => $q->where('owner_id', '!=', $user->id))
            ->latest()
            ->take(6)
            ->get();

        // Dashboard placeholders for story-style UI
        $featuredStories = collect();
        $stats = [
            'stories' => 0,
            'reads' => 0,
            'followers' => 0,
            'responses' => 0,
        ];
        $suggestedAuthors = [];
        $readingList = [];
        $writingStreak = null;
        $wordCount = null;

        $myListingsCount = Product::where('owner_id', $user->id)->count();
        $myBookingsCount = Booking::where('renter_id', $user->id)->count();

        return view('users.home', [
            'user' => $user,
            'discoverPreview' => $discoverPreview,
            'featuredStories' => $featuredStories,
            'stats' => $stats,
            'suggestedAuthors' => $suggestedAuthors,
            'readingList' => $readingList,
            'writingStreak' => $writingStreak,
            'wordCount' => $wordCount,
            'myListingsCount' => $myListingsCount,
            'myBookingsCount' => $myBookingsCount,
        ]);
    }

    public function myListings(Request $request)
    {
        $user = $request->user();
        if (! $user) {
            abort(403);
        }

        $products = Product::where('owner_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('my-listings', [
            'user' => $user,
            'products' => $products,
        ]);
    }

    public function myProductList(Request $request)
    {
        $user = $request->user();
        if (! $user) {
            abort(403);
        }

        $featuredProducts = Product::where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        // Allow filtering by listing status via ?filter=active|inactive|all
        $filter = strtolower($request->query('filter', 'all'));

        $myProductsQuery = Product::where('owner_id', $user->id)->latest();
        if (in_array($filter, ['active', 'inactive'])) {
            $myProductsQuery->where('status', $filter);
        }

        // paginate results and preserve query string (filter)
        $myProducts = $myProductsQuery->paginate(9)->withQueryString();

        // counts for tabs
        $totalCount = Product::where('owner_id', $user->id)->count();
        $activeCount = Product::where('owner_id', $user->id)->where('status', 'active')->count();
        $inactiveCount = Product::where('owner_id', $user->id)->where('status', 'inactive')->count();

        return view('users.my-product-list', [
            'user' => $user,
            'featuredProducts' => $featuredProducts,
            'myProducts' => $myProducts,
            'filter' => $filter,
            'totalCount' => $totalCount,
            'activeCount' => $activeCount,
            'inactiveCount' => $inactiveCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'role' => ['required', 'in:user,admin'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'is_admin' => $validated['role'] === 'admin',
            'role' => $validated['role'],
            'status' => 'active',
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
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
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'role' => ['required', 'in:user,admin'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        $user->address = $validated['address'] ?? null;
        $user->is_admin = $validated['role'] === 'admin';
        $user->role = $validated['role'];

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $auth = Auth::user();
        if (! $auth) {
            abort(403);
        }

        // Only admins or the user themself can delete
        if ($auth->id !== $user->id && ! $auth->is_admin) {
            abort(403);
        }

        $isSelf = $auth->id === $user->id;

        $user->delete();

        if ($isSelf) {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/')->with('success', 'This account has been deleted.');
        }

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
