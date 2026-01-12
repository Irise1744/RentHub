<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/20 to-amber-50/20 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">My Product List</h1>
                    <p class="text-gray-600">Review your listings and explore featured gear.</p>
                </div>
                <a href="{{ route('products.create') }}" class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                    </svg>
                    New Listing
                </a>
            </div>

            {{-- My Listings (compact) --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Your Listings</h2>
                        <p class="text-gray-600 text-sm">A quick view of items you are offering.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <nav class="inline-flex rounded-lg bg-gray-50 p-1 border border-gray-100">
                            <a href="?filter=all" class="px-3 py-2 text-sm font-medium rounded-lg {{ $filter === 'all' ? 'bg-white text-gray-900' : 'text-gray-600 hover:bg-gray-100' }}">
                                All ({{ $totalCount ?? 0 }})
                            </a>
                            <a href="?filter=active" class="px-3 py-2 text-sm font-medium rounded-lg {{ $filter === 'active' ? 'bg-white text-gray-900' : 'text-gray-600 hover:bg-gray-100' }}">
                                Active ({{ $activeCount ?? 0 }})
                            </a>
                            <a href="?filter=inactive" class="px-3 py-2 text-sm font-medium rounded-lg {{ $filter === 'inactive' ? 'bg-white text-gray-900' : 'text-gray-600 hover:bg-gray-100' }}">
                                Inactive ({{ $inactiveCount ?? 0 }})
                            </a>
                        </nav>
                        <a href="{{ route('users.my-listings') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Manage all</a>
                    </div>
                </div>

                @if($myProducts->count())
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($myProducts as $product)
                            <div class="border border-gray-100 rounded-2xl p-4 bg-gray-50/50">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-semibold uppercase tracking-wide text-indigo-600">{{ $product->category ?? 'General' }}</span>
                                    @php
                                        $listingStatus = strtolower($product->status ?? 'inactive');
                                        $rentalStatus = strtolower($product->rental_status ?? 'available');
                                        if ($listingStatus !== 'active') {
                                            $mpBadge = ['label' => ucfirst('inactive'), 'class' => 'bg-gray-100 text-gray-600'];
                                        } elseif ($rentalStatus === 'rented') {
                                            $mpBadge = ['label' => 'Rented', 'class' => 'bg-red-100 text-red-800'];
                                        } else {
                                            $mpBadge = ['label' => 'Available', 'class' => 'bg-emerald-50 text-emerald-700'];
                                        }
                                    @endphp
                                    <span class="text-xs px-2 py-1 rounded-full {{ $mpBadge['class'] }}">{{ $mpBadge['label'] }}</span>
                                </div>
                                <div class="text-base font-semibold text-gray-900 line-clamp-1">{{ $product->title }}</div>
                                <p class="text-sm text-gray-600 line-clamp-2 mb-3">{{ $product->description }}</p>
                                <div class="flex items-center justify-between text-sm text-gray-700">
                                    <span class="font-semibold text-gray-900">${{ number_format($product->price_per_day, 2) }} / day</span>
                                    <span class="text-xs text-gray-500">{{ $product->location ?? 'Location not set' }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $myProducts->links() }}
                    </div>
                @else
                    <div class="text-center text-gray-600 py-8">
                        <p class="text-lg font-semibold text-gray-900 mb-1">No listings yet</p>
                        <p class="text-sm mb-3">Create your first listing to start renting to others.</p>
                        <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition">
                            Add a listing
                        </a>
                    </div>
                @endif
            </div>

            {{-- Featured Gear moved from Home --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Featured Gear</h2>
                        <p class="text-gray-600 mt-1">Top-rated equipment available for rent</p>
                    </div>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                        View all
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

                @if($featuredProducts->count())
                    <div class="divide-y divide-gray-100">
                        @foreach($featuredProducts as $product)
                            <div class="p-6 hover:bg-gray-50/50 transition-colors duration-200">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0 relative">
                                        <div class="h-20 w-20 rounded-xl bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center overflow-hidden">
                                            @if($product->image_url)
                                                <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image_url) }}" alt="{{ $product->title }}" class="h-full w-full object-cover">
                                            @else
                                                <svg class="h-10 w-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="absolute -top-2 -right-2">
                                                @php
                                                    $listingStatus = strtolower($product->status ?? 'inactive');
                                                    $rentalStatus = strtolower($product->rental_status ?? 'available');
                                                    if ($listingStatus !== 'active') {
                                                        $featBadge = ['label' => ucfirst('inactive'), 'class' => 'bg-gray-100 text-gray-800'];
                                                    } elseif ($rentalStatus === 'rented') {
                                                        $featBadge = ['label' => 'Rented', 'class' => 'bg-red-100 text-red-800'];
                                                    } else {
                                                        $featBadge = ['label' => 'Available', 'class' => 'bg-emerald-100 text-emerald-800'];
                                                    }
                                                @endphp
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold {{ $featBadge['class'] }}">{{ $featBadge['label'] }}</span>
                                        </div>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $product->title }}</h3>
                                                <div class="flex items-center space-x-2 mb-2">
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                                        {{ $product->category ?? 'General' }}
                                                    </span>
                                                    <span class="text-sm text-gray-500">
                                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                        {{ $product->location ?? 'Remote' }}
                                                    </span>
                                                </div>
                                                <p class="text-gray-600 line-clamp-2">{{ Str::limit($product->description, 120) }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between mt-4">
                                            <div class="flex items-center space-x-4">
                                                <div class="text-2xl font-bold text-gray-900">
                                                    ${{ number_format($product->price_per_day, 2) }}
                                                    <span class="text-sm font-normal text-gray-500">/day</span>
                                                </div>
                                                <div class="flex items-center text-sm text-gray-500">
                                                    <svg class="w-4 h-4 mr-1 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                    <span>4.8</span>
                                                    <span class="mx-2">•</span>
                                                    <span>12 reviews</span>
                                                </div>
                                            </div>
                                            <a href="{{ route('products.show', $product->product_id ?? $product->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center">
                        <div class="mx-auto w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No gear available yet</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">Start listing your items or check back soon for new arrivals.</p>
                        <a href="{{ route('products.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            List Your First Item
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
