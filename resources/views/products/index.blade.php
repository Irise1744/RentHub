<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Hero Section --}}
            <div class="mb-10">
                <h1 class="text-4xl font-bold text-gray-900 mb-3">What do you need today?</h1>
                <p class="text-lg text-gray-600">Find amazing items from your community</p>
                
                {{-- Search and Filters --}}
                <div class="mt-8 flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <form action="{{ route('products.index') }}" method="GET">
                            <div class="relative">
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <input type="text" 
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Search items (camera, bike, projector...)" 
                                       class="w-full pl-12 pr-4 py-3 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </form>
                    </div>
                    <div class="flex gap-3">
                        <select class="px-4 py-3 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>All Categories</option>
                            <option>Electronics</option>
                            <option>Sports & Outdoors</option>
                            <option>Home & Garden</option>
                            <option>Tools</option>
                        </select>
                        <select class="px-4 py-3 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>Sort by: Newest</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Best Rated</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Products Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @forelse($products as $product)
                <div x-data="{ open: false }" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                    {{-- Image --}}
                    <div class="relative h-56 bg-gray-100">
                        <img src="{{ $product->image_url ? \Illuminate\Support\Facades\Storage::url($product->image_url) : asset('storage/products/default.jpg') }}"
                             alt="{{ $product->title }}"
                             class="w-full h-full object-cover">
                        {{-- Category Badge --}}
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 text-xs font-semibold text-gray-700 bg-white/90 backdrop-blur-sm rounded-full">
                                {{ $product->category ?? 'General' }}
                            </span>
                        </div>
                        {{-- Price Badge --}}
                        <div class="absolute bottom-4 right-4">
                            <div class="px-3 py-2 bg-white/90 backdrop-blur-sm rounded-xl">
                                <div class="text-xl font-bold text-gray-900">${{ number_format($product->price_per_day, 0) }}</div>
                                <div class="text-xs text-gray-500">per day</div>
                            </div>
                        </div>
                    </div>

                    {{-- Product Info --}}
                    <div class="p-6">
                        {{-- Title and Owner --}}
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $product->title }}</h3>
                            
                            {{-- Status Badge --}}
                            @php
                                // Determine display status using listing `status` and `rental_status`.
                                // Priority: listing inactive -> show Inactive; else if rental_status == rented -> Rented; otherwise Available.
                                $listingStatus = strtolower($product->status ?? 'inactive');
                                $rentalStatus = strtolower($product->rental_status ?? 'available');

                                if ($listingStatus !== 'active') {
                                    $badge = ['label' => 'Inactive', 'class' => 'bg-gray-100 text-gray-800 border-gray-200'];
                                } elseif ($rentalStatus === 'rented') {
                                    $badge = ['label' => 'Rented', 'class' => 'bg-red-100 text-red-800 border-red-200'];
                                } else {
                                    $badge = ['label' => 'Available', 'class' => 'bg-green-100 text-green-800 border-green-200'];
                                }
                            @endphp
                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded border {{ $badge['class'] }}">
                                {{ $badge['label'] }}
                            </span>
                            
                            <div class="flex items-center space-x-2 mt-2">
                                @if(!empty($product->owner->avatar))
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($product->owner->avatar) }}" alt="{{ $product->owner->name ?? 'Owner' }}" class="w-8 h-8 rounded-full object-cover">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-blue-600 font-semibold text-sm">
                                            {{ substr($product->owner->name ?? 'U', 0, 1) }}
                                        </span>
                                    </div>
                                @endif
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $product->owner->name ?? 'Anonymous' }}</div>
                                    <div class="text-xs text-gray-500">{{ $product->location ?? 'Location not set' }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                            {{ $product->description ?? 'No description available.' }}
                        </p>

                        {{-- Condition --}}
                        <div class="flex items-center justify-between mb-6">
                            <div class="text-sm">
                                <span class="text-gray-500">Condition:</span>
                                <span class="font-medium ml-1 {{ 
                                    $product->condition === 'excellent' ? 'text-green-600' : 
                                    ($product->condition === 'good' ? 'text-blue-600' : 
                                    ($product->condition === 'like new' ? 'text-purple-600' : 'text-gray-600')) 
                                }}">
                                    {{ ucfirst($product->condition ?? 'Unknown') }}
                                </span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Verified
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex gap-3">
                            @if($product->status === 'active')
                                <button @click="open = true" type="button" 
                                        class="px-4 py-3 text-sm font-semibold text-blue-600 bg-blue-50 border border-blue-100 rounded-xl hover:bg-blue-100 transition">
                                    Quick Preview
                                </button>
                                <a href="{{ route('products.show', $product) }}" 
                                   class="flex-1 bg-blue-600 text-white font-semibold py-3 px-4 rounded-xl hover:bg-blue-700 transition text-center">
                                    Rent Now
                                </a>
                            @elseif($product->status === 'inactive')
                                <button @click="open = true" type="button" 
                                        class="px-4 py-3 text-sm font-semibold text-gray-600 bg-gray-50 border border-gray-100 rounded-xl hover:bg-gray-100 transition">
                                    Quick Preview
                                </button>
                                <span class="flex-1 bg-gray-300 text-gray-600 font-semibold py-3 px-4 rounded-xl text-center cursor-not-allowed">
                                    Not Available
                                </span>
                            @elseif($product->status === 'rented')
                                <button @click="open = true" type="button" 
                                        class="px-4 py-3 text-sm font-semibold text-red-600 bg-red-50 border border-red-100 rounded-xl hover:bg-red-100 transition">
                                    Quick Preview
                                </button>
                                <span class="flex-1 bg-red-100 text-red-700 font-semibold py-3 px-4 rounded-xl text-center cursor-not-allowed">
                                    Currently Rented
                                </span>
                            @endif
                            
                            {{-- Admin actions (hidden for regular users) --}}
                            @if(auth()->user() && auth()->user()->is_admin)
                            <div class="flex gap-2">
                                <form action="{{ route('admin.products.flag', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="p-3 text-orange-600 hover:text-orange-700 hover:bg-orange-50 rounded-xl transition"
                                            title="Flag listing">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                                        </svg>
                                    </button>
                                </form>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('Remove this listing?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="p-3 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-xl transition"
                                            title="Remove listing">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>

                        {{-- Owner Actions --}}
                        @if(auth()->id() === $product->owner_id)
                        <div class="flex gap-2 mt-3">
                            @if($product->status === 'active')
                                <form action="{{ route('products.toggle-status', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-xs px-3 py-1 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                                        Mark Inactive
                                    </button>
                                </form>
                                <form action="{{ route('products.mark-rented', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-xs px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                        Mark as Rented
                                    </button>
                                </form>
                            @elseif($product->status === 'inactive')
                                <form action="{{ route('products.toggle-status', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-xs px-3 py-1 bg-green-100 text-green-700 rounded-lg hover:bg-green-200">
                                        Activate
                                    </button>
                                </form>
                            @elseif($product->status === 'rented')
                                <form action="{{ route('products.toggle-status', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-xs px-3 py-1 bg-green-100 text-green-700 rounded-lg hover:bg-green-200">
                                        Mark Available
                                    </button>
                                </form>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Quick Preview Modal --}}
                <div x-show="open" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" style="display: none;">
                    <div @click.away="open = false" class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full overflow-hidden">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/2 bg-gray-100">
                                <img src="{{ $product->image_url ? \Illuminate\Support\Facades\Storage::url($product->image_url) : asset('storage/products/default.jpg') }}"
                                     alt="{{ $product->title }}"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="md:w-1/2 p-6 space-y-3">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900">{{ $product->title }}</h3>
                                        <p class="text-sm text-gray-500">{{ $product->category ?? 'General' }}</p>
                                        
                                        {{-- Status in Modal --}}
                                        @php
                                            $listingStatus = strtolower($product->status ?? 'inactive');
                                            $rentalStatus = strtolower($product->rental_status ?? 'available');

                                            if ($listingStatus !== 'active') {
                                                $modalBadge = ['label' => 'Inactive', 'class' => 'bg-gray-100 text-gray-800 border-gray-200'];
                                            } elseif ($rentalStatus === 'rented') {
                                                $modalBadge = ['label' => 'Rented', 'class' => 'bg-red-100 text-red-800 border-red-200'];
                                            } else {
                                                $modalBadge = ['label' => 'Available', 'class' => 'bg-green-100 text-green-800 border-green-200'];
                                            }
                                        @endphp
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded border mt-2 {{ $modalBadge['class'] }}">
                                            {{ $modalBadge['label'] }}
                                        </span>
                                    </div>
                                    <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-gray-700 leading-relaxed">{{ $product->description ?? 'No description available.' }}</p>
                                <div class="flex items-center gap-3 text-sm text-gray-600">
                                    <span class="px-2 py-1 rounded-full bg-gray-100 text-gray-800">{{ ucfirst($product->condition ?? 'Unknown') }} condition</span>
                                    <span class="px-2 py-1 rounded-full bg-blue-50 text-blue-700">${{ number_format($product->price_per_day, 0) }}/day</span>
                                </div>
                                <div class="flex items-center gap-3 text-sm text-gray-600">
                                    <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-semibold">
                                        {{ substr($product->owner->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $product->owner->name ?? 'Anonymous' }}</div>
                                        <div class="text-xs text-gray-500">{{ $product->location ?? 'Location not set' }}</div>
                                    </div>
                                </div>
                                <div class="flex gap-3 pt-2">
                                    @if($product->status === 'active')
                                        <a href="{{ route('products.show', $product) }}" class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition">
                                            View details & Rent
                                        </a>
                                    @elseif($product->status === 'inactive')
                                        <span class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gray-300 text-gray-600 font-semibold rounded-xl cursor-not-allowed">
                                            Not Available
                                        </span>
                                    @elseif($product->status === 'rented')
                                        <span class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-red-100 text-red-700 font-semibold rounded-xl cursor-not-allowed">
                                            Currently Rented
                                        </span>
                                    @endif
                                    <button @click="open = false" type="button" class="px-4 py-3 text-sm font-semibold text-gray-600 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                {{-- Empty State --}}
                <div class="col-span-full">
                    <div class="text-center py-16">
                        <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">No items available</h3>
                        <p class="text-gray-600">Be the first to list an item for rent!</p>
                        @if(auth()->check())
                        <a href="{{ route('products.create') }}" 
                           class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-6 rounded-xl hover:bg-blue-700 transition">
                            List an Item
                        </a>
                        @endif
                    </div>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($products->hasPages())
            <div class="flex justify-center mb-12">
                <div class="flex items-center space-x-2">
                    @if($products->onFirstPage())
                    <span class="px-4 py-2 text-gray-400 rounded-xl border border-gray-200">
                        Previous
                    </span>
                    @else
                    <a href="{{ $products->previousPageUrl() }}" 
                       class="px-4 py-2 text-gray-700 hover:text-blue-600 rounded-xl border border-gray-200 hover:border-blue-200 transition">
                        Previous
                    </a>
                    @endif

                    @foreach(range(1, min(5, $products->lastPage())) as $page)
                    @if($page == $products->currentPage())
                    <span class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-xl">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $products->url($page) }}" 
                       class="px-4 py-2 text-gray-700 hover:text-blue-600 rounded-xl border border-gray-200 hover:border-blue-200 transition">
                        {{ $page }}
                    </a>
                    @endif
                    @endforeach

                    @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" 
                       class="px-4 py-2 text-gray-700 hover:text-blue-600 rounded-xl border border-gray-200 hover:border-blue-200 transition">
                        Next
                    </a>
                    @else
                    <span class="px-4 py-2 text-gray-400 rounded-xl border border-gray-200">
                        Next
                    </span>
                    @endif
                </div>
            </div>
            @endif

            {{-- Footer --}}
            <div class="pt-8 border-t border-gray-200">
                <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                    <div class="mb-4 md:mb-0">
                        © 2024 RentIt Inc. All rights reserved.
                    </div>
                    <div class="flex items-center space-x-6">
                        <a href="#" class="hover:text-gray-700 transition">Privacy Policy</a>
                        <a href="#" class="hover:text-gray-700 transition">Terms of Service</a>
                        <a href="#" class="hover:text-gray-700 transition">Help Center</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>