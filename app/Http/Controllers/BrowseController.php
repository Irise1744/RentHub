<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BrowseController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'active')
            ->with('owner')
            ->latest()
            ->get();

        return view('browse', compact('products'));
    }

    public function history()
    {
        $borrowedProducts = auth()->user()->borrowedProducts()
            ->with(['owner:id,name,phone']) // Fetch only owner name and phone
            ->get(['product_id', 'title', 'owner_id']); // Fetch only necessary product fields

        return view('browse', [
            'products' => $borrowedProducts,
            'isHistory' => true
        ]);
    }
}
