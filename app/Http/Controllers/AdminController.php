<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('dashboard', compact('products'));
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function updateUser(Request $request, User $user)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'role' => 'required|in:user,admin'
        ]);

        // Update the user
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'is_admin' => $validated['role'] === 'admin'
        ]);

        // Return JSON response for AJAX or redirect for normal form submission
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully!',
                'user' => $user
            ]);
        }

        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully!');
    }

    // Add this method to show user edit form
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Rest of your existing methods...
}