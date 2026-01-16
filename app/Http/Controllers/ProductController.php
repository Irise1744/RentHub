<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = $request->user()?->id;

        // Only show active products to other users
        $products = Product::with('owner')
            ->where('status', 'active') // Only show active AND available listings
            ->when($userId, fn($q) => $q->where('owner_id', '!=', $userId))
            ->when($request->has('search') && !empty($request->search), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
            })
            ->when($request->has('category') && !empty($request->category), function ($query) use ($request) {
                $query->where('category', $request->category);
            })
            ->when($request->has('sort') && !empty($request->sort), function ($query) use ($request) {
                if ($request->sort === 'price_low') {
                    $query->orderBy('price_per_day', 'asc');
                } elseif ($request->sort === 'price_high') {
                    $query->orderBy('price_per_day', 'desc');
                } elseif ($request->sort === 'newest') {
                    $query->orderBy('created_at', 'desc');
                }
            })
            ->latest()
            ->paginate(20);

        $borrowedProducts = $request->user()?->borrowedProducts()->with('owner')->get();

        return view('products.index', [
            'products' => $products,
            'borrowedProducts' => $borrowedProducts
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        if (! $user) {
            abort(403);
        }

        return view('products.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (! $user) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string', 'max:100'],
            'condition' => ['required', 'string', 'max:50'],
            'price_per_day' => ['required', 'numeric', 'min:0'],
            'location' => ['required', 'string', 'max:255'],
            'available_from' => ['nullable', 'date'],
            'available_to' => ['nullable', 'date', 'after_or_equal:available_from'],
            'image' => ['nullable', 'image', 'max:2048'],
            'status' => ['nullable', 'in:active,inactive'], // Add status validation
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'owner_id' => $user->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'condition' => $validated['condition'],
            'price_per_day' => $validated['price_per_day'],
            'location' => $validated['location'],
            'status' => $validated['status'] ?? 'active', // Default to inactive if not provided
            'available_from' => $validated['available_from'] ?? null,
            'available_to' => $validated['available_to'] ?? null,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('users.my-listings')->with('success', 'Listing created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $user = Auth::user();
        if (! $user || ($product->owner_id !== $user->id && ! $user->is_admin)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string', 'max:100'],
            'condition' => ['required', 'string', 'max:50'],
            'price_per_day' => ['required', 'numeric', 'min:0'],
            'location' => ['required', 'string', 'max:255'],
            'available_from' => ['nullable', 'date'],
            'available_to' => ['nullable', 'date', 'after_or_equal:available_from'],
            'image' => ['nullable', 'image', 'max:2048'],
            'status' => ['nullable', 'in:active,inactive,rented'], // Make status optional
        ]);

        if ($request->hasFile('image')) {
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }
            $product->image_url = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'condition' => $validated['condition'],
            'price_per_day' => $validated['price_per_day'],
            'location' => $validated['location'],
            // 'status' => $validated['status'], // Update status
            'available_from' => $validated['available_from'] ?? null,
            'available_to' => $validated['available_to'] ?? null,
        ]);

        return redirect()->route('users.my-listings')->with('success', 'Listing updated successfully.');
    }

    /**
     * Toggle product status (active/inactive)
     */
    public function toggleStatus(Product $product)
    {
        $user = Auth::user();
        if (!$user || ($product->owner_id !== $user->id && !$user->is_admin)) {
            abort(403);
        }

        // Toggle between 'active' and 'inactive' only
        $newStatus = $product->status === 'active' ? 'inactive' : 'active';
        
        $product->update(['status' => $newStatus]);

        return back()->with('success', "Listing status updated to {$newStatus}.");
    }

    /**
     * Mark product as rented (sets rental_status)
     */
    public function markAsRented(Product $product)
    {
        $user = Auth::user();
        if (!$user || ($product->owner_id !== $user->id && !$user->is_admin)) {
            abort(403);
        }

        $product->update([
            'status' => 'active', // Keep status as active
            'rental_status' => 'rented' // Set rental_status to rented
        ]);

        return back()->with('success', 'Product marked as rented.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('owner');
        return view('products.show', compact('product'));
    }

    /**
     * Remove the specified product from storage.
     */

    public function destroy(Product $product)
    {
        $user = Auth::user();
        if (!$user || ($product->owner_id !== $user->id && !$user->is_admin)) {
            abort(403); // Ensure only the owner or admin can delete the product
        }

        // Delete the product image from storage if it exists
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }

        // Delete the product
        $product->delete();

        // Redirect based on user role
        if ($user->is_admin) {
            return redirect()->route('dashboard')->with('success', 'Product deleted successfully.');
        }

        return redirect()->route('users.my-listings')->with('success', 'Product deleted successfully.');
    }

    public function edit(\App\Models\Product $product)
    {
        return view('products.edit', compact('product'));
    }
}
