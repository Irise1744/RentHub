<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
                    Admin Overview
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Monitor recent listings and activity across the platform.
                </p>
            </div>
            
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Summary cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Total Products</p>
                    <p class="mt-2 text-2xl font-semibold text-gray-900">
                        {{ $products->count() ?? 0 }}
                    </p>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Active Listings</p>
                    <p class="mt-2 text-2xl font-semibold text-emerald-600">
                        {{ $products->where('status', 'active')->count() ?? 0 }}
                    </p>
                </div>

                <div class="bg-white shadow-sm rounded-lg p-4">
                    <p class="text-xs uppercase tracking-wide text-gray-500">Inactive Listings</p>
                    <p class="mt-2 text-2xl font-semibold text-amber-500">
                        {{ $products->where('status', 'inactive')->count() ?? 0 }}
                    </p>
                </div>
            </div>

            {{-- Latest products --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Latest Products</h3>
                    <a href="{{ route('products.index') }}" class="text-sm text-indigo-600 hover:underline">
                        View all
                    </a>
                </div>

                @if(isset($products) && $products->count())
                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($products as $product)
                            <div class="border border-gray-100 rounded-xl overflow-hidden hover:shadow-md transition">
                                <div class="h-40 bg-gray-100">
                                    <img src="{{ asset('storage/products/camera.jpeg') }}"
                                         alt="{{ $product->title }}"
                                         class="w-full h-full object-cover">
                                </div>

                                <div class="p-4 space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-medium uppercase tracking-wide text-indigo-600">
                                            {{ $product->category ?? 'General' }}
                                        </span>
                                        <span class="text-xs px-2 py-1 rounded-full
                                                     {{ $product->status === 'active'
                                                         ? 'bg-emerald-50 text-emerald-700'
                                                         : 'bg-gray-100 text-gray-600' }}">
                                            {{ ucfirst($product->status ?? 'inactive') }}
                                        </span>
                                    </div>

                                    <h4 class="text-sm font-semibold text-gray-900 truncate">
                                        {{ $product->title }}
                                    </h4>

                                    <p class="text-xs text-gray-500 truncate">
                                        {{ $product->location ?? 'Unknown location' }}
                                    </p>

                                    <div class="flex items-center justify-between pt-2">
                                        <span class="text-sm font-semibold text-gray-900">
                                            ${{ number_format($product->price_per_day, 2) }}
                                            <span class="text-xs text-gray-500">/ day</span>
                                        </span>

                                        <a href="{{ route('products.show', $product->product_id ?? $product->id) }}"
                                           class="text-xs font-medium text-indigo-600 hover:underline">
                                            View details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">No products available yet.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
