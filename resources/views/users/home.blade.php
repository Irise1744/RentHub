<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
        <!-- Header with Gradient -->
        <div class="relative bg-gradient-to-r from-blue-600 via-blue-500 to-teal-500">
            <div class="absolute inset-0 bg-black/5"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col lg:flex-row items-start justify-between gap-8">
                    <div class="flex-1">
                        <!-- Status Badges -->
                        <div class="flex flex-wrap items-center gap-3 mb-6">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white backdrop-blur-sm">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Dashboard
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white backdrop-blur-sm">
                                {{ $user->is_admin ? '👑 Admin' : '⭐ Member' }}
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white backdrop-blur-sm">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ now()->format('F j, Y') }}
                            </span>
                        </div>
                        
                        <!-- Main Heading with Glow Effect -->
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight">
                            Welcome back,<br>
                            <span class="bg-gradient-to-r from-orange-400 to-yellow-400 bg-clip-text text-transparent drop-shadow-lg">{{ $user->name }}</span>
                        </h1>
                        
                        <!-- Description -->
                        <p class="text-lg text-blue-100 max-w-2xl leading-relaxed">
                            Your marketplace dashboard. Manage listings, track bookings, and discover items.
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
                                New Listing
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-blue-100 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                        <a href="{{ route('products.index') }}" 
                           class="group relative overflow-hidden px-6 py-3.5 bg-white/10 backdrop-blur-sm border border-white/20 text-white font-semibold rounded-xl hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Browse Marketplace
                            </span>
                        </a>
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
            <!-- Key Metrics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <!-- Listings Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-200/50">
                    <div class="absolute -top-3 -right-3 w-12 h-12 bg-gradient-to-br from-blue-500 to-teal-400 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="mb-4">
                        <div class="text-sm font-medium text-gray-500 mb-1">Active Listings</div>
                        <div class="text-3xl font-bold text-gray-900">{{ $myListingsCount }}</div>
                    </div>
                    <div class="h-2 bg-gradient-to-r from-blue-100 to-teal-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-500 to-teal-400 rounded-full transition-all duration-500" style="width: {{ min(($myListingsCount/10)*100, 100) }}%"></div>
                    </div>
                    <div class="mt-4 text-sm text-gray-600">Manage your rental items</div>
                </div>

                <!-- Bookings Card -->
                <div class="group relative bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-200/50">
                    <div class="absolute -top-3 -right-3 w-12 h-12 bg-gradient-to-br from-orange-500 to-yellow-400 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="mb-4">
                        <div class="text-sm font-medium text-gray-500 mb-1">Scheduled Bookings</div>
                        <div class="text-3xl font-bold text-gray-900">{{ $myBookingsCount }}</div>
                    </div>
                    <div class="h-2 bg-gradient-to-r from-orange-100 to-yellow-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-orange-500 to-yellow-400 rounded-full transition-all duration-500" style="width: {{ min(($myBookingsCount/10)*100, 100) }}%"></div>
                    </div>
                    <div class="mt-4 text-sm text-gray-600">View upcoming reservations</div>
                </div>

                <!-- Add more metric cards here if needed -->
            </div>

            <!-- Main Dashboard Content -->
            <div class="grid lg:grid-cols-3 gap-8 mb-10">
                <!-- Featured Items (Wider) -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
                        <!-- Section Header with Gradient -->
                        <div class="bg-gradient-to-r from-blue-50 to-teal-50 p-6 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-teal-400 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold text-gray-900">Featured Items</h2>
                                        <p class="text-sm text-gray-600 mt-1">Available for rent in the marketplace</p>
                                    </div>
                                </div>
                                <a href="{{ route('products.index') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-teal-400 text-white font-medium rounded-lg hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                    View All
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Items List -->
                        <div class="divide-y divide-gray-100">
                            @forelse($discoverPreview as $product)
                                <a href="{{ route('products.show', $product) }}" 
                                   class="block p-6 hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-teal-50/50 transition-all duration-300 group">
                                    <div class="flex items-center gap-4">
                                        <!-- Image with Gradient Border -->
                                        <div class="relative h-20 w-20 rounded-xl overflow-hidden flex-shrink-0">
                                            <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-teal-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                            <div class="relative h-full w-full rounded-xl overflow-hidden">
                                                @if(!empty($product->image_url))
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image_url) }}" alt="{{ $product->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                                @else
                                                    <img src="{{ $product->owner->avatar ? \Illuminate\Support\Facades\Storage::url($product->owner->avatar) : asset('storage/products/default.jpg') }}" 
                                                         alt="{{ $product->owner->name ?? 'Owner' }}" 
                                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- Details -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between gap-2 mb-2">
                                                <div>
                                                    <span class="text-xs font-semibold text-blue-600 uppercase tracking-wider">{{ $product->category ?? 'General' }}</span>
                                                    <h3 class="text-base font-bold text-gray-900 mt-1 group-hover:text-blue-600 transition-colors">{{ $product->title }}</h3>
                                                    <p class="text-sm text-gray-600">{{ $product->owner->name ?? 'Anonymous' }}</p>
                                                    @php
                                                        $pstatus = strtolower($product->rental_status ?? 'available');
                                                        $statusLabel = $pstatus === 'rented' ? 'Rent Out' : ($pstatus === 'unavailable' ? 'Unavailable' : 'Available');
                                                        $statusClass = match($pstatus) {
                                                            'rented' => 'bg-gradient-to-r from-red-500 to-pink-500 text-white',
                                                            'unavailable' => 'bg-gradient-to-r from-yellow-500 to-orange-400 text-white',
                                                            default => 'bg-gradient-to-r from-green-500 to-teal-400 text-white',
                                                        };
                                                    @endphp
                                                    <div class="mt-2">
                                                        <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full {{ $statusClass }} shadow-sm">
                                                            {{ $statusLabel }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-lg font-bold text-gray-900">${{ number_format($product->price_per_day, 0) }}</div>
                                                    <div class="text-xs text-gray-500">per day</div>
                                                </div>
                                            </div>
                                            
                                            <p class="text-sm text-gray-600 line-clamp-2 mb-3">{{ $product->description ?? 'No description available.' }}</p>
                                            
                                            <!-- Meta Info -->
                                            <div class="flex items-center gap-3">
                                                <span class="text-xs font-medium px-2 py-1 rounded-lg border border-gray-300 text-gray-700 bg-gray-50">
                                                    {{ ucfirst($product->condition ?? 'Unknown') }}
                                                </span>
                                                <span class="text-xs text-gray-400">•</span>
                                                <span class="text-xs text-gray-500">{{ $product->location ?? 'Location not set' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="p-12 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-blue-100 to-teal-100 border border-blue-200 mb-4">
                                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">No Items Available</h3>
                                    <p class="text-gray-600 mb-4">Be the first to list an item</p>
                                    <a href="{{ route('products.create') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-teal-400 text-white font-medium rounded-lg hover:shadow-lg transition-all">
                                        Create Listing
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar: Actions & Activity -->
                <div class="space-y-8">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Quick Actions
                        </h3>
                        <div class="space-y-4">
                            <a href="{{ route('products.create') }}" 
                               class="group flex items-center p-4 border border-gray-200 rounded-xl hover:border-blue-300 hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                                <div class="p-3 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 mr-4 group-hover:from-blue-100 group-hover:to-blue-200 transition-all">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors">Create Listing</div>
                                    <div class="text-sm text-gray-600">Start earning today</div>
                                </div>
                                <svg class="w-5 h-5 ml-auto text-gray-400 group-hover:text-blue-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                            
                            <a href="{{ route('profile.edit') }}" 
                               class="group flex items-center p-4 border border-gray-200 rounded-xl hover:border-teal-300 hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                                <div class="p-3 rounded-lg bg-gradient-to-br from-teal-50 to-teal-100 border border-teal-200 mr-4 group-hover:from-teal-100 group-hover:to-teal-200 transition-all">
                                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900 group-hover:text-teal-600 transition-colors">Update Profile</div>
                                    <div class="text-sm text-gray-600">Increase visibility</div>
                                </div>
                                <svg class="w-5 h-5 ml-auto text-gray-400 group-hover:text-teal-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                            
                            <a href="{{ route('products.index') }}" 
                               class="group flex items-center p-4 border border-gray-200 rounded-xl hover:border-orange-300 hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                                <div class="p-3 rounded-lg bg-gradient-to-br from-orange-50 to-orange-100 border border-orange-200 mr-4 group-hover:from-orange-100 group-hover:to-orange-200 transition-all">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900 group-hover:text-orange-600 transition-colors">View Bookings</div>
                                    <div class="text-sm text-gray-600">Manage reservations</div>
                                </div>
                                <svg class="w-5 h-5 ml-auto text-gray-400 group-hover:text-orange-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Section -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 p-6">
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">Browse Categories</h2>
                    <p class="text-sm text-gray-600">Find items by category</p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @php
                        $categories = [
                            ['name' => 'Electronics', 'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z', 'color' => 'from-blue-500 to-blue-600'],
                            ['name' => 'Tools', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z', 'color' => 'from-orange-500 to-orange-600'],
                            ['name' => 'Sports', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'color' => 'from-green-500 to-teal-500'],
                            ['name' => 'Party', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 'color' => 'from-purple-500 to-pink-500'],
                            ['name' => 'Outdoor', 'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z', 'color' => 'from-yellow-500 to-orange-400'],
                            ['name' => 'Fashion', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'color' => 'from-pink-500 to-rose-500']
                        ];
                    @endphp
                    
                    @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => strtolower($category['name'])]) }}" class="group">
                            <div class="p-4 bg-gradient-to-br from-gray-50 to-white border border-gray-200 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 text-center group-hover:border-transparent">
                                <div class="h-12 w-12 mx-auto mb-3 rounded-xl bg-gradient-to-br {{ $category['color'] }} flex items-center justify-center shadow-md">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $category['icon'] }}" />
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-gray-900 group-hover:text-gray-800">{{ $category['name'] }}</span>
                                <div class="mt-2 text-xs text-gray-500 opacity-0 group-hover:opacity-100 transition-opacity">Browse →</div>
                            </div>
                        </a>
                    @endforeach
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
            
            /* Glow effects */
            .glow {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
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
            
            /* Gradient text */
            .gradient-text {
                background-clip: text;
                -webkit-background-clip: text;
                color: transparent;
            }
        </style>
    </div>
</x-app-layout>