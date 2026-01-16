<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
        <!-- Header with Gradient -->
        <div class="relative bg-gradient-to-r from-blue-400 via-orange-500 to-yellow-500">
            <div class="absolute inset-0 bg-black/5"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col lg:flex-row items-start justify-between gap-8">
                    <div class="flex-1">
                        <!-- Status Badges -->


                        <!-- Main Heading with Glow Effect -->
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight">
                            Discover Amazing<br>
                            <span class="bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent drop-shadow-lg">Items for Rent</span>
                        </h1>


                        

                        <!-- Description -->
                        <p class="text-lg text-blue-100 max-w-2xl leading-relaxed">
                            Find quality items from your community and start renting today.
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row lg:flex-col gap-3 min-w-[200px]">
                        <a href="{{ route('products.create') }}"
                            class="group relative overflow-hidden px-6 py-3.5 bg-white text-blue-600 font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center shadow-lg">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                List an Item
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-blue-100 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                        @if(auth()->check() && auth()->user()->products->count() > 0)
                        <a href="{{ route('users.my-listings') }}"
                            class="group relative overflow-hidden px-6 py-3.5 bg-white/10 backdrop-blur-sm border border-white/20 text-white font-semibold rounded-xl hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                My Listings
                            </span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Wave Divider -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg class="w-full h-12 text-white" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="currentColor"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35,6.36,119.13-4.36V0Z" opacity=".5" fill="currentColor"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>
        

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-8">
            <!-- Search and Filters -->
            <div class="mb-10">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200/50 mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Find exactly what you need</h2>

                    <!-- Put everything in ONE form -->
                    <form action="{{ route('products.index') }}" method="GET" class="flex flex-col lg:flex-row gap-6">
                        <!-- Search Input -->
                        <div class="flex-1">
                            <div class="relative group">
                                <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <input type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search items by name, description..."
                                    class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-blue-400 transition-all duration-300">
                            </div>
                        </div>

                        <!-- Filters -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <!-- Category Filter -->
                            <div class="relative group">
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-teal-400 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity blur"></div>
                                <select name="category"
                                    class="relative px-4 py-3.5 bg-white rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 w-full sm:w-48"
                                    onchange="this.form.submit()">
                                    <option value="">All Categories</option>
                                    <option value="electronics" {{ request('category') == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                    <option value="sports" {{ request('category') == 'sports' ? 'selected' : '' }}>Sports & Outdoors</option>
                                    <option value="home" {{ request('category') == 'home' ? 'selected' : '' }}>Home & Garden</option>
                                    <option value="tools" {{ request('category') == 'tools' ? 'selected' : '' }}>Tools</option>
                                </select>
                            </div>

                            <!-- Sort Filter -->
                            <div class="relative group">
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-teal-400 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity blur"></div>
                                <select name="sort"
                                    class="relative px-4 py-3.5 bg-white rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-blue-400 transition-all duration-300 w-full sm:w-48"
                                    onchange="this.form.submit()">
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                </select>
                            </div>
                        </div>

                        <!-- Hidden submit button (optional) -->
                        <button type="submit" class="hidden">Apply Filters</button>
                    </form>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gradient-to-r from-blue-50 to-teal-50 rounded-2xl p-5 border border-blue-200/50">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-teal-400 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Available Items</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $products->where('status', 'active')->where('rental_status', '!=', 'rented')->count() }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-orange-50 to-amber-50 rounded-2xl p-5 border border-orange-200/50">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-amber-400 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Total Listings</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $products->total() }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-5 border border-green-200/50">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-400 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Active Owners</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $products->pluck('owner_id')->unique()->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Borrowed Products History -->
            @if($borrowedProducts && $borrowedProducts->count() > 0)
            <div class="mb-10">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
                    <!-- Section Header -->
                    <div class="bg-gradient-to-r from-blue-50 to-teal-50 p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-teal-400 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">Your Rental History</h2>
                                    <p class="text-sm text-gray-600 mt-1">Items you've borrowed from the community</p>
                                </div>
                            </div>
                            <span class="text-sm font-semibold text-blue-600">
                                {{ $borrowedProducts->count() }} items
                            </span>
                        </div>
                    </div>

                    <!-- History Table -->
                    @php
                    $showAll = request()->has('show_all_history');
                    $visibleProducts = $showAll ? $borrowedProducts : $borrowedProducts->take(2);
                    @endphp

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price/Day</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($visibleProducts as $product)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if($product->image_url)
                                            <div class="h-10 w-10 rounded-lg overflow-hidden mr-3">
                                                <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image_url) }}"
                                                    alt="{{ $product->title }}"
                                                    class="h-full w-full object-cover">
                                            </div>
                                            @endif
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $product->title }}</div>
                                                <div class="text-sm text-gray-500">{{ $product->category ?? 'General' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $product->owner->name ?? 'Unknown' }}</div>
                                        <div class="text-sm text-gray-500">{{ $product->owner->phone ?? 'No phone' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">${{ number_format($product->price_per_day, 2) }}/day</div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                        No borrowed products history
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Show More Button -->
                    @if($borrowedProducts->count() > 2)
                    <div class="p-4 border-t border-gray-200">
                        @if($showAll)
                        <a href="{{ request()->fullUrlWithoutQuery('show_all_history') }}"
                            class="group inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                            <span>Show Less</span>
                            <svg class="ml-2 w-4 h-4 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            </svg>
                        </a>
                        @else
                        <a href="{{ request()->fullUrlWithQuery(['show_all_history' => true]) }}"
                            class="group inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
                            <span>Show All ({{ $borrowedProducts->count() }})</span>
                            <svg class="ml-2 w-4 h-4 group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @forelse($products as $product)
                <div x-data="{ open: false }" class="group relative bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Image with Gradient Overlay -->
                    <div class="relative h-56 bg-gradient-to-br from-blue-50 to-teal-50 overflow-hidden">
                        <img src="{{ $product->image_url ? \Illuminate\Support\Facades\Storage::url($product->image_url) : asset('storage/products/default.jpg') }}"
                            alt="{{ $product->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1.5 text-xs font-semibold text-white bg-gradient-to-r from-blue-500/90 to-teal-400/90 backdrop-blur-sm rounded-full">
                                {{ $product->category ?? 'General' }}
                            </span>
                        </div>

                        <!-- Price Badge -->
                        <div class="absolute bottom-4 right-4">
                            <div class="px-4 py-3 bg-gradient-to-r from-white/95 to-white/90 backdrop-blur-sm rounded-xl shadow-lg">
                                <div class="text-xl font-bold text-gray-900">${{ number_format($product->price_per_day, 0) }}</div>
                                <div class="text-xs text-gray-500">per day</div>
                            </div>
                        </div>

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <!-- Title and Owner -->
                        <div class="mb-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">{{ $product->title }}</h3>

                            <!-- Status Badge -->
                            @php
                            $listingStatus = strtolower($product->status ?? 'inactive');
                            $rentalStatus = strtolower($product->rental_status ?? 'available');

                            if ($listingStatus !== 'active') {
                            $badge = ['label' => 'Inactive', 'class' => 'bg-gradient-to-r from-gray-500 to-gray-400 text-white'];
                            } elseif ($rentalStatus === 'rented') {
                            $badge = ['label' => 'Rented', 'class' => 'bg-gradient-to-r from-red-500 to-pink-500 text-white'];
                            } else {
                            $badge = ['label' => 'Available', 'class' => 'bg-gradient-to-r from-green-500 to-teal-400 text-white'];
                            }
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full {{ $badge['class'] }} shadow-sm mb-3">
                                {{ $badge['label'] }}
                            </span>

                            <!-- Owner Info -->
                            <div class="flex items-center space-x-3">
                                @if(!empty($product->owner->avatar))
                                <div class="relative">
                                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-teal-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity blur"></div>
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($product->owner->avatar) }}"
                                        alt="{{ $product->owner->name ?? 'Owner' }}"
                                        class="relative w-10 h-10 rounded-full object-cover border-2 border-white">
                                </div>
                                @else
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-teal-400 flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">
                                        {{ substr($product->owner->name ?? 'U', 0, 1) }}
                                    </span>
                                </div>
                                @endif
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $product->owner->name ?? 'Anonymous' }}</div>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $product->location ?? 'Location not set' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                            {{ $product->description ?? 'No description available.' }}
                        </p>

                        <!-- Condition -->
                        <div class="flex items-center justify-between mb-6">
                            <div class="text-sm">
                                <span class="text-gray-500">Condition:</span>
                                <span class="font-medium ml-1 px-2 py-1 rounded-lg border border-gray-200 text-gray-700 {{ 
                                    $product->condition === 'excellent' ? 'bg-gradient-to-r from-green-50 to-emerald-50' : 
                                    ($product->condition === 'good' ? 'bg-gradient-to-r from-blue-50 to-teal-50' : 
                                    ($product->condition === 'like new' ? 'bg-gradient-to-r from-purple-50 to-pink-50' : 'bg-gray-50')) 
                                }}">
                                    {{ ucfirst($product->condition ?? 'Unknown') }}
                                </span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Verified
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3">
                            @if($product->status === 'active')
                            <button @click="open = true" type="button"
                                class="group relative px-4 py-3 text-sm font-semibold text-blue-600 bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                                <span class="relative z-10 flex items-center">
                                    <svg class="w-4 h-4 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Preview
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-100 to-blue-200 opacity-0 group-hover:opacity-100 rounded-xl transition-opacity"></div>
                            </button>
                            <a href="{{ route('products.show', $product) }}"
                                class="group relative flex-1 bg-gradient-to-r from-blue-500 to-teal-400 text-white font-semibold py-3 px-4 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 text-center">
                                <span class="relative z-10">Rent Now</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-teal-500 opacity-0 group-hover:opacity-100 rounded-xl transition-opacity"></div>
                            </a>
                            @elseif($product->status === 'inactive')
                            <button @click="open = true" type="button"
                                class="px-4 py-3 text-sm font-semibold text-gray-600 bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 rounded-xl hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                                Preview
                            </button>
                            <span class="flex-1 bg-gradient-to-r from-gray-300 to-gray-400 text-gray-600 font-semibold py-3 px-4 rounded-xl text-center cursor-not-allowed">
                                Not Available
                            </span>
                            @elseif($product->status === 'rented')
                            <button @click="open = true" type="button"
                                class="px-4 py-3 text-sm font-semibold text-red-600 bg-gradient-to-r from-red-50 to-red-100 border border-red-200 rounded-xl hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                                Preview
                            </button>
                            <span class="flex-1 bg-gradient-to-r from-red-100 to-red-200 text-red-700 font-semibold py-3 px-4 rounded-xl text-center cursor-not-allowed">
                                Currently Rented
                            </span>
                            @endif

                            <!-- Admin actions -->
                            @if(auth()->user() && auth()->user()->is_admin)
                            <div class="flex gap-2">
                                <form action="{{ route('admin.products.flag', $product) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="p-3 text-orange-600 hover:text-orange-700 hover:bg-orange-50 rounded-xl transition"
                                        title="Flag listing">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>

                        <!-- Owner Actions -->
                        @if(auth()->id() === $product->owner_id)
                        <div class="flex gap-2 mt-3">
                            @if($product->status === 'active')
                            <form action="{{ route('products.toggle-status', $product) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-xs px-3 py-1.5 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-lg hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                                    Mark Inactive
                                </button>
                            </form>
                            
                            @elseif($product->status === 'inactive')
                            <form action="{{ route('products.toggle-status', $product) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-xs px-3 py-1.5 bg-gradient-to-r from-green-100 to-emerald-200 text-green-700 rounded-lg hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                                    Activate
                                </button>
                            </form>
                            @elseif($product->status === 'rented')
                            <form action="{{ route('products.toggle-status', $product) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-xs px-3 py-1.5 bg-gradient-to-r from-green-100 to-emerald-200 text-green-700 rounded-lg hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                                    Mark Available
                                </button>
                            </form>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Preview Modal -->
                <div x-show="open" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" style="display: none;">
                    <div @click.away="open = false" class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full overflow-hidden">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/2 bg-gradient-to-br from-blue-50 to-teal-50">
                                <img src="{{ $product->image_url ? \Illuminate\Support\Facades\Storage::url($product->image_url) : asset('storage/products/default.jpg') }}"
                                    alt="{{ $product->title }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="md:w-1/2 p-6 space-y-4">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900">{{ $product->title }}</h3>
                                        <p class="text-sm text-gray-500">{{ $product->category ?? 'General' }}</p>

                                        @php
                                        $listingStatus = strtolower($product->status ?? 'inactive');
                                        $rentalStatus = strtolower($product->rental_status ?? 'available');

                                        if ($listingStatus !== 'active') {
                                        $modalBadge = ['label' => 'Inactive', 'class' => 'bg-gradient-to-r from-gray-500 to-gray-400 text-white'];
                                        } elseif ($rentalStatus === 'rented') {
                                        $modalBadge = ['label' => 'Rented', 'class' => 'bg-gradient-to-r from-red-500 to-pink-500 text-white'];
                                        } else {
                                        $modalBadge = ['label' => 'Available', 'class' => 'bg-gradient-to-r from-green-500 to-teal-400 text-white'];
                                        }
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full mt-2 {{ $modalBadge['class'] }}">
                                            {{ $modalBadge['label'] }}
                                        </span>
                                    </div>
                                    <button @click="open = false" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-1 rounded-lg transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-gray-700 leading-relaxed">{{ $product->description ?? 'No description available.' }}</p>
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="px-3 py-1.5 rounded-full bg-gradient-to-r from-blue-50 to-teal-50 text-blue-700 border border-blue-200">
                                        {{ ucfirst($product->condition ?? 'Unknown') }} condition
                                    </span>
                                    <span class="px-3 py-1.5 rounded-full bg-gradient-to-r from-amber-50 to-orange-50 text-amber-700 border border-amber-200">
                                        ${{ number_format($product->price_per_day, 0) }}/day
                                    </span>
                                </div>
                                <div class="flex items-center gap-3 text-sm p-3 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-teal-400 flex items-center justify-center text-white font-semibold">
                                        {{ substr($product->owner->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $product->owner->name ?? 'Anonymous' }}</div>
                                        <div class="text-xs text-gray-500">{{ $product->location ?? 'Location not set' }}</div>
                                    </div>
                                </div>
                                <div class="flex gap-3 pt-2">
                                    @if($product->status === 'active')
                                    <a href="{{ route('products.show', $product) }}"
                                        class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-teal-400 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                        View details & Rent
                                    </a>
                                    @elseif($product->status === 'inactive')
                                    <span class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-gray-300 to-gray-400 text-gray-600 font-semibold rounded-xl cursor-not-allowed">
                                        Not Available
                                    </span>
                                    @elseif($product->status === 'rented')
                                    <span class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-100 to-red-200 text-red-700 font-semibold rounded-xl cursor-not-allowed">
                                        Currently Rented
                                    </span>
                                    @endif
                                    <button @click="open = false"
                                        type="button"
                                        class="px-4 py-3 text-sm font-semibold text-gray-600 bg-gradient-to-r from-gray-100 to-gray-200 rounded-xl hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Empty State -->
                <div class="col-span-full">
                    <div class="text-center py-16">
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gradient-to-br from-blue-100 to-teal-100 border border-blue-200 mb-6">
                            <svg class="w-12 h-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">No items available</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">Be the first to list an item for rent in your community!</p>
                        @if(auth()->check())
                        <a href="{{ route('products.create') }}"
                            class="inline-flex items-center px-6 py-3.5 bg-gradient-to-r from-blue-500 to-teal-400 text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            List an Item
                        </a>
                        @endif
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="flex justify-center mb-12">
                <div class="flex items-center space-x-2">
                    @if($products->onFirstPage())
                    <span class="px-4 py-2.5 text-gray-400 rounded-xl border border-gray-200">
                        Previous
                    </span>
                    @else
                    <a href="{{ $products->previousPageUrl() }}"
                        class="group px-4 py-2.5 text-gray-700 hover:text-blue-600 rounded-xl border border-gray-200 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-0.5">
                        <span class="relative z-10">Previous</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-blue-100 opacity-0 group-hover:opacity-100 rounded-xl transition-opacity"></div>
                    </a>
                    @endif

                    @foreach(range(1, min(5, $products->lastPage())) as $page)
                    @if($page == $products->currentPage())
                    <span class="px-4 py-2.5 bg-gradient-to-r from-blue-500 to-teal-400 text-white font-semibold rounded-xl shadow-md">
                        {{ $page }}
                    </span>
                    @else
                    <a href="{{ $products->url($page) }}"
                        class="group px-4 py-2.5 text-gray-700 hover:text-blue-600 rounded-xl border border-gray-200 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-0.5">
                        <span class="relative z-10">{{ $page }}</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-blue-100 opacity-0 group-hover:opacity-100 rounded-xl transition-opacity"></div>
                    </a>
                    @endif
                    @endforeach

                    @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}"
                        class="group px-4 py-2.5 text-gray-700 hover:text-blue-600 rounded-xl border border-gray-200 hover:border-blue-200 transition-all duration-300 transform hover:-translate-y-0.5">
                        <span class="relative z-10">Next</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-blue-100 opacity-0 group-hover:opacity-100 rounded-xl transition-opacity"></div>
                    </a>
                    @else
                    <span class="px-4 py-2.5 text-gray-400 rounded-xl border border-gray-200">
                        Next
                    </span>
                    @endif
                </div>
            </div>
            @endif

            <!-- Product History Table -->
                        <div class="mb-10">
                            <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
                                <!-- Section Header -->
                                <div class="bg-gradient-to-r from-blue-50 to-teal-50 p-6 border-b border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-teal-400 rounded-lg flex items-center justify-center mr-4">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h2 class="text-xl font-bold text-gray-900">Product History Table</h2>
                                                <p class="text-sm text-gray-600 mt-1">A summary of product history</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- History Table -->
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price/Day</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200">
                                            @forelse($products as $product)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-6 py-4">
                                                    <div class="flex items-center">
                                                        @if($product->image_url)
                                                        <div class="h-10 w-10 rounded-lg overflow-hidden mr-3">
                                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image_url) }}"
                                                                alt="{{ $product->title }}"
                                                                class="h-full w-full object-cover">
                                                        </div>
                                                        @endif
                                                        <div>
                                                            <div class="font-medium text-gray-900">{{ $product->title }}</div>
                                                            <div class="text-sm text-gray-500">{{ $product->category ?? 'General' }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-900">{{ $product->owner->name ?? 'Unknown' }}</div>
                                                    <div class="text-sm text-gray-500">{{ $product->owner->phone ?? 'No phone' }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="font-medium text-gray-900">${{ number_format($product->price_per_day, 2) }}/day</div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                                    No product history available
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

            <!-- Footer -->
            <div class="pt-8 border-t border-gray-200">
                <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                    <div class="mb-4 md:mb-0">
                        © 2024 RentIt Inc. All rights reserved.
                    </div>
                    <div class="flex items-center space-x-6">
                        <a href="#" class="hover:text-blue-600 transition">Privacy Policy</a>
                        <a href="#" class="hover:text-blue-600 transition">Terms of Service</a>
                        <a href="#" class="hover:text-blue-600 transition">Help Center</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Custom Styles -->
        <style>
            .line-clamp-2 {
                overflow: hidden;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 2;
            }

            /* Smooth transitions */
            * {
                transition-property: all;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 300ms;
            }

            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f5f9;
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb {
                background: linear-gradient(to bottom, #3b82f6, #06b6d4);
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(to bottom, #2563eb, #0891b2);
            }
        </style>
    </div>
</x-app-layout>