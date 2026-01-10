@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
  <header class="mb-6">
    <h1 class="text-2xl font-semibold">Admin Control Panel</h1>
    <p class="text-sm text-gray-500">Overview of platform health and moderation tools</p>
  </header>

  <!-- Tabs -->
  <nav class="mb-6 border-b">
    <ul class="flex -mb-px space-x-4">
      <li>
        <a href="#" class="inline-block py-2 px-4 text-sm text-gray-600 hover:text-gray-900">Stats</a>
      </li>
      <li>
        <a href="#" class="inline-block py-2 px-4 text-sm text-gray-600 hover:text-gray-900">Users</a>
      </li>
      <li>
        <a href="#" class="inline-block py-2 px-4 text-sm font-medium text-gray-900 border-b-2 border-indigo-500">Products</a>
      </li>
      <li>
        <a href="#" class="inline-block py-2 px-4 text-sm text-gray-600 hover:text-gray-900">Bookings</a>
      </li>
    </ul>
  </nav>

  <!-- Listing Moderation Card -->
  <div class="bg-white rounded-lg shadow-sm p-6">
    <div class="mb-4 flex items-center justify-between">
      <h2 class="text-lg font-medium">Listing Moderation</h2>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead>
          <tr class="text-left text-xs font-semibold text-gray-500 uppercase">
            <th class="px-4 py-3">Item</th>
            <th class="px-4 py-3">Owner</th>
            <th class="px-4 py-3">Price</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
          @forelse($products as $product)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-4">
              <div class="flex items-center space-x-3">
                <div class="w-14 h-14 rounded-md overflow-hidden bg-gray-100 flex-shrink-0">
                  @php
                    $img = $product->image_url ? asset('storage/' . $product->image_url) : asset('images/placeholder.png');
                  @endphp
                  <img src="{{ $img }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                </div>
                <div>
                  <div class="text-sm font-medium text-gray-900">{{ $product->title }}</div>
                  <div class="text-xs text-gray-500">{{ $product->category }}</div>
                </div>
              </div>
            </td>

            <td class="px-4 py-4 text-sm text-gray-700">{{ optional($product->owner)->name ?? '—' }}</td>

            <td class="px-4 py-4 text-sm text-gray-700">${{ number_format($product->price_per_day, 2) }} / day</td>

            <td class="px-4 py-4">
              @if(strtoupper($product->status) === 'ACTIVE')
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">ACTIVE</span>
              @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">INACTIVE</span>
              @endif
            </td>

            <td class="px-4 py-4 text-sm">
              <div class="flex items-center space-x-2">
                <form method="POST" action="{{ route('admin.products.flag', $product) }}">
                  @csrf
                  <button type="submit" class="text-sm px-3 py-1 rounded-full bg-yellow-50 text-yellow-800 hover:bg-yellow-100">Flag</button>
                </form>

                <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-sm px-3 py-1 rounded-full bg-red-50 text-red-700 hover:bg-red-100">Remove</button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td class="px-4 py-6 text-sm text-gray-500" colspan="5">No products found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
