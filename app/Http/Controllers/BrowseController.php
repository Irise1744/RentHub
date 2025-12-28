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
}
