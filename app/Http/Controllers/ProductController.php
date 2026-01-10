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

        $products = Product::with('owner')
            ->when($userId, fn($q) => $q->where('owner_id', '!=', $userId))
            ->latest()
            ->paginate(20);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
            'status' => 'active',
            'available_from' => $validated['available_from'] ?? null,
            'available_to' => $validated['available_to'] ?? null,
            'image_url' => $imagePath,
        ]);

        return redirect()->route('users.my-listings')->with('success', 'Listing created successfully.');
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
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $user = Auth::user();
        if (! $user || ($product->owner_id !== $user->id && ! $user->is_admin)) {
            abort(403);
        }

        return view('products.edit', compact('product'));
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
            'available_from' => $validated['available_from'] ?? null,
            'available_to' => $validated['available_to'] ?? null,
        ]);

        return redirect()->route('users.my-listings')->with('success', 'Listing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $user = Auth::user();
        if (! $user || ($product->owner_id !== $user->id && ! $user->is_admin)) {
            abort(403);
        }

        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }

        $product->delete();

        return redirect()->route('users.my-listings')->with('success', 'Listing removed successfully.');
    }
}
