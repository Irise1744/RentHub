<x-app-layout>
    <div class="min-h-screen bg-white">
        <!-- Minimalist Header -->
        <div class="relative border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col lg:flex-row items-start justify-between gap-8">
                    <div class="flex-1">
                        <!-- Status -->
                        <div class="inline-flex items-center gap-2 text-sm text-gray-500 mb-6">
                            <span>Dashboard</span>
                            <span>•</span>
                            <span>{{ $user->is_admin ? 'Admin' : 'Member' }}</span>
                            <span>•</span>
                            <span>{{ now()->format('F j, Y') }}</span>
                        </div>
                        
                        <!-- Main Heading -->
                        <h1 class="text-4xl md:text-5xl font-normal tracking-tight text-gray-900 mb-4">
                            Good morning,<br>
                            <span class="font-semibold">{{ $user->name }}</span>
                        </h1>
                        
                        <!-- Description -->
                        <p class="text-lg text-gray-600 max-w-2xl leading-relaxed">
                            Here's an overview of your listings, bookings, and marketplace activity.
                        </p>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row lg:flex-col gap-3">
                        <a href="{{ route('products.create') }}" 
                           class="group relative overflow-hidden px-6 py-3.5 border border-gray-900 text-gray-900 font-medium rounded-lg hover:bg-gray-900 hover:text-white transition-all duration-200 flex items-center justify-center">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                                </svg>
                                New Listing
                            </span>
                        </a>
                        <a href="{{ route('products.index') }}" 
                           class="group relative overflow-hidden px-6 py-3.5 border border-gray-300 text-gray-700 font-medium rounded-lg hover:border-gray-900 hover:text-gray-900 transition-all duration-200 flex items-center justify-center">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Browse
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Key Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <!-- Listings Card -->
                <div class="border border-gray-200 rounded-lg p-6 hover:border-gray-300 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-lg border border-gray-200">
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-500">Active</span>
                    </div>
                    <div class="text-3xl font-semibold text-gray-900 mb-1">{{ $myListingsCount }}</div>
                    <div class="text-sm text-gray-600 mb-3">Listings</div>
                    <div class="h-1 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gray-800 rounded-full" style="width: 75%"></div>
                    </div>
                </div>

                <!-- Bookings Card -->
                <div class="border border-gray-200 rounded-lg p-6 hover:border-gray-300 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-lg border border-gray-200">
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-500">Scheduled</span>
                    </div>
                    <div class="text-3xl font-semibold text-gray-900 mb-1">{{ $myBookingsCount }}</div>
                    <div class="text-sm text-gray-600 mb-3">Bookings</div>
                    <div class="h-1 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gray-800 rounded-full" style="width: 60%"></div>
                    </div>
                </div>

                <!-- Earnings Card -->
                <div class="border border-gray-200 rounded-lg p-6 hover:border-gray-300 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-lg border border-gray-200">
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-500">Revenue</span>
                    </div>
                    <div class="text-3xl font-semibold text-gray-900 mb-1">${{ number_format($totalEarnings ?? 0, 0) }}</div>
                    <div class="text-sm text-gray-600 mb-3">Earnings</div>
                    <div class="h-1 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gray-800 rounded-full" style="width: 85%"></div>
                    </div>
                </div>

                <!-- Rating Card -->
                <div class="border border-gray-200 rounded-lg p-6 hover:border-gray-300 transition-colors">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-lg border border-gray-200">
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-500">{{ $user->is_admin ? 'Admin' : 'Verified' }}</span>
                    </div>
                    <div class="text-3xl font-semibold text-gray-900 mb-1">4.9</div>
                    <div class="text-sm text-gray-600 mb-3">Rating</div>
                    <div class="flex items-center">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                        <span class="ml-2 text-sm text-gray-500">24 reviews</span>
                    </div>
                </div>
            </div>

            <!-- Main Dashboard Content -->
            <div class="grid lg:grid-cols-3 gap-8 mb-10">
                <!-- Featured Items (Wider) -->
                <div class="lg:col-span-2">
                    <div class="border border-gray-200 rounded-lg">
                        <!-- Section Header -->
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900">Featured Items</h2>
                                    <p class="text-sm text-gray-600 mt-1">Available for rent in the marketplace</p>
                                </div>
                                <a href="{{ route('products.index') }}" 
                                   class="text-sm font-medium text-gray-700 hover:text-gray-900 flex items-center">
                                    View All
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Items List -->
                        <div class="divide-y divide-gray-200">
                            @forelse($discoverPreview as $product)
                                <a href="{{ route('products.show', $product) }}" 
                                   class="block p-6 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <!-- Image -->
                                        <div class="h-20 w-20 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                            @if(!empty($product->owner->avatar))
                                                <img src="{{ \Illuminate\Support\Facades\Storage::url($product->owner->avatar) }}" alt="{{ $product->owner->name ?? 'Owner' }}" class="w-full h-full object-cover">
                                            @else
                                                <img src="{{ $product->image_url ? \Illuminate\Support\Facades\Storage::url($product->image_url) : asset('storage/products/default.jpg') }}" 
                                                     alt="{{ $product->title }}" 
                                                     class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        
                                        <!-- Details -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between gap-2 mb-2">
                                                <div>
                                                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $product->category ?? 'General' }}</span>
                                                    <h3 class="text-base font-semibold text-gray-900 mt-1">{{ $product->title }}</h3>
                                                            <p class="text-sm text-gray-600">{{ $product->owner->name ?? 'Anonymous' }}</p>
                                                            @php
                                                                $pstatus = strtolower($product->rental_status ?? 'available');
                                                                $statusLabel = $pstatus === 'rented' ? 'Rent Out' : ($pstatus === 'unavailable' ? 'Unavailable' : 'Available');
                                                                $statusClass = match($pstatus) {
                                                                    'rented' => 'bg-red-100 text-red-800 border-red-200',
                                                                    'unavailable' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                                    default => 'bg-green-100 text-green-800 border-green-200',
                                                                };
                                                            @endphp
                                                            <div class="mt-2">
                                                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded border {{ $statusClass }}">{{ $statusLabel }}</span>
                                                            </div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-lg font-semibold text-gray-900">${{ number_format($product->price_per_day, 0) }}</div>
                                                    <div class="text-xs text-gray-500">per day</div>
                                                </div>
                                            </div>
                                            
                                            <p class="text-sm text-gray-600 line-clamp-2 mb-3">{{ $product->description ?? 'No description available.' }}</p>
                                            
                                            <!-- Meta Info -->
                                            <div class="flex items-center gap-3">
                                                <span class="text-xs font-medium px-2 py-1 rounded border border-gray-300 text-gray-700">
                                                    {{ ucfirst($product->condition ?? 'Unknown') }}
                                                </span>
                                                <span class="text-xs text-gray-500">•</span>
                                                <span class="text-xs text-gray-500">{{ $product->location ?? 'Location not set' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="p-12 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full border border-gray-200 mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No Items Available</h3>
                                    <p class="text-gray-600">Be the first to list an item</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar: Actions & Activity -->
                <div class="space-y-8">
                    <!-- Quick Actions -->
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Quick Actions</h3>
                        <div class="space-y-4">
                            <a href="{{ route('products.create') }}" 
                               class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-gray-900 hover:bg-gray-50 transition-all">
                                <div class="p-2.5 rounded border border-gray-200 mr-4">
                                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">Create Listing</div>
                                    <div class="text-sm text-gray-600">Start earning today</div>
                                </div>
                            </a>
                            
                            <a href="{{ route('profile.edit') }}" 
                               class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-gray-900 hover:bg-gray-50 transition-all">
                                <div class="p-2.5 rounded border border-gray-200 mr-4">
                                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">Update Profile</div>
                                    <div class="text-sm text-gray-600">Increase visibility</div>
                                </div>
                            </a>
                            
                            <a href="#" 
                               class="flex items-center p-4 border border-gray-200 rounded-lg hover:border-gray-900 hover:bg-gray-50 transition-all">
                                <div class="p-2.5 rounded border border-gray-200 mr-4">
                                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">View Bookings</div>
                                    <div class="text-sm text-gray-600">Manage reservations</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6">Recent Activity</h3>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-9 w-9 rounded-full border border-gray-200 flex items-center justify-center">
                                        <svg class="h-4 w-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Booking Confirmed</p>
                                    <p class="text-sm text-gray-600">DSLR Camera rental approved</p>
                                    <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-9 w-9 rounded-full border border-gray-200 flex items-center justify-center">
                                        <svg class="h-4 w-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">New Message</p>
                                    <p class="text-sm text-gray-600">Message about Camera rental</p>
                                    <p class="text-xs text-gray-500 mt-1">5 hours ago</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-9 w-9 rounded-full border border-gray-200 flex items-center justify-center">
                                        <svg class="h-4 w-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Payment Received</p>
                                    <p class="text-sm text-gray-600">$45.00 for Camera rental</p>
                                    <p class="text-xs text-gray-500 mt-1">1 day ago</p>
                                </div>
                            </div>
                        </div>
                        
                        <a href="#" class="inline-flex items-center mt-6 text-sm font-medium text-gray-700 hover:text-gray-900">
                            View All Activity
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Categories Section -->
            <div class="border border-gray-200 rounded-lg p-6">
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900">Browse Categories</h2>
                    <p class="text-sm text-gray-600 mt-1">Find items by category</p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @php
                        $categories = [
                            ['name' => 'Electronics', 'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z'],
                            ['name' => 'Tools', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'],
                            ['name' => 'Sports', 'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                            ['name' => 'Party', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'],
                            ['name' => 'Outdoor', 'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'],
                            ['name' => 'Fashion', 'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z']
                        ];
                    @endphp
                    
                    @foreach($categories as $category)
                        <a href="#" class="block">
                            <div class="p-4 border border-gray-200 rounded-lg hover:border-gray-900 hover:bg-gray-50 transition-all text-center">
                                <div class="h-12 w-12 mx-auto mb-3 rounded-lg border border-gray-200 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $category['icon'] }}" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">{{ $category['name'] }}</span>
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
            
            /* Smooth animations */
            * {
                transition-property: color, background-color, border-color;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 150ms;
            }
            
            /* Focus styles for accessibility */
            a:focus, button:focus {
                outline: 2px solid #000;
                outline-offset: 2px;
            }
            
            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }
            
            ::-webkit-scrollbar-track {
                background: #f8f9fa;
            }
            
            ::-webkit-scrollbar-thumb {
                background: #e5e7eb;
                border-radius: 4px;
            }
            
            ::-webkit-scrollbar-thumb:hover {
                background: #d1d5db;
            }
        </style>
    </div>
</x-app-layout>
