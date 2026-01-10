<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50/50">
        <!-- Hero Welcome Section -->
        <div class="relative bg-gradient-to-r from-blue-600 via-blue-500 to-indigo-600">
            <div class="absolute inset-0 bg-black/5"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col lg:flex-row items-center justify-between">
                    <div class="text-white mb-8 lg:mb-0 lg:mr-8">
                        <div class="inline-flex items-center px-3 py-1 rounded-full bg-white/20 text-sm font-medium mb-4">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                            Welcome back
                        </div>
                        <h1 class="text-4xl md:text-5xl font-bold mb-4">Hello, {{ $user->name }} 👋</h1>
                        <p class="text-xl text-blue-100 max-w-2xl">Your personal dashboard to manage rentals, discover gear, and track your activity.</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('products.index') }}" 
                           class="group inline-flex items-center justify-center px-6 py-3 bg-white text-blue-600 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Browse Gear
                        </a>
                        <a href="{{ route('products.create') }}" 
                           class="group inline-flex items-center justify-center px-6 py-3 border-2 border-white text-white font-semibold rounded-xl hover:bg-white/10 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            List Item
                        </a>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-8 bg-gradient-to-t from-gray-50 to-transparent"></div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 pb-12">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-blue-50">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-blue-50 text-blue-600">Active</span>
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mb-1">{{ $myListingsCount }}</div>
                    <div class="text-sm text-gray-500">My Listings</div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <span class="text-xs text-gray-500">↗️ 12% from last month</span>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-green-50">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-green-50 text-green-600">Upcoming</span>
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mb-1">{{ $myBookingsCount }}</div>
                    <div class="text-sm text-gray-500">My Bookings</div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <span class="text-xs text-gray-500">📅 3 upcoming this week</span>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-purple-50">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-purple-50 text-purple-600">Total</span>
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mb-1">${{ number_format($totalEarnings ?? 0, 0) }}</div>
                    <div class="text-sm text-gray-500">Total Earnings</div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <span class="text-xs text-gray-500">💰 $245 earned this month</span>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-amber-50">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $user->is_admin ? 'bg-red-50 text-red-600' : 'bg-emerald-50 text-emerald-600' }}">
                            {{ $user->is_admin ? 'Admin' : 'Verified' }}
                        </span>
                    </div>
                    <div class="text-3xl font-bold text-gray-900 mb-1">4.9</div>
                    <div class="text-sm text-gray-500">Rating</div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                            <span class="ml-2 text-xs text-gray-500">(24 reviews)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Discover Preview -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mb-10">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Discover Preview</h2>
                        <p class="text-gray-600 mt-1">A few items you can borrow right now.</p>
                    </div>
                    <a href="{{ route('products.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">See all</a>
                </div>

                @if($discoverPreview->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($discoverPreview as $product)
                            <div class="border border-gray-100 rounded-2xl p-4 flex flex-col bg-gray-50/50">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="h-14 w-14 rounded-xl overflow-hidden bg-gray-100 border border-gray-200">
                                        <img src="{{ $product->image_url ? \Illuminate\Support\Facades\Storage::url($product->image_url) : asset('storage/products/default.jpg') }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-xs font-semibold text-indigo-600 uppercase">{{ $product->category ?? 'General' }}</div>
                                        <h3 class="text-base font-semibold text-gray-900 truncate">{{ $product->title }}</h3>
                                        <p class="text-xs text-gray-500 truncate">{{ $product->owner->name ?? 'Anonymous' }} • {{ $product->location ?? 'Location not set' }}</p>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 line-clamp-2 flex-1">{{ $product->description ?? 'No description available.' }}</p>
                                <div class="flex items-center justify-between mt-4">
                                    <span class="text-lg font-bold text-gray-900">${{ number_format($product->price_per_day, 0) }}<span class="text-sm font-normal text-gray-500">/day</span></span>
                                    <a href="{{ route('products.show', $product) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">View</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-gray-600 py-8">No items available right now.</div>
                @endif
            </div>

            <!-- Main Content -->
            <div class="grid lg:grid-cols-1 gap-8">
                <div class="space-y-8">
                    <!-- Quick Actions -->
                    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl shadow-lg p-6 text-white">
                        <h3 class="text-xl font-bold mb-6">Quick Actions</h3>
                        <div class="space-y-4">
                            <a href="{{ route('products.create') }}" class="flex items-center p-3 bg-white/10 rounded-xl hover:bg-white/20 transition">
                                <div class="p-2 bg-white/20 rounded-lg mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">List New Item</div>
                                    <div class="text-sm text-blue-200">Start earning today</div>
                                </div>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center p-3 bg-white/10 rounded-xl hover:bg-white/20 transition">
                                <div class="p-2 bg-white/20 rounded-lg mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Complete Profile</div>
                                    <div class="text-sm text-blue-200">Get more visibility</div>
                                </div>
                            </a>
                            <a href="#" class="flex items-center p-3 bg-white/10 rounded-xl hover:bg-white/20 transition">
                                <div class="p-2 bg-white/20 rounded-lg mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">View Bookings</div>
                                    <div class="text-sm text-blue-200">Manage reservations</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Recent Activity</h3>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Booking confirmed</p>
                                    <p class="text-sm text-gray-500">Your booking for DSLR Camera was approved</p>
                                    <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">New message</p>
                                    <p class="text-sm text-gray-500">Sarah sent you a message about Camera rental</p>
                                    <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                        <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Payment received</p>
                                    <p class="text-sm text-gray-500">$45.00 received for Camera rental</p>
                                    <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="block mt-6 text-center text-sm text-blue-600 hover:text-blue-700 font-medium">
                            View all activity →
                        </a>
                    </div>

                    <!-- Tips & Updates -->
                    <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-lg p-6 text-white">
                        <h3 class="text-xl font-bold mb-4">Pro Tip</h3>
                        <p class="text-gray-300 mb-4">High-quality photos can increase your rental bookings by up to 300%.</p>
                        <div class="flex items-center text-sm text-gray-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Updated 2 days ago
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Section -->
            <div class="mt-12">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Browse by Category</h2>
                        <p class="text-gray-600 mt-1">Find exactly what you're looking for</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach(['Electronics', 'Tools', 'Sports', 'Party', 'Outdoor', 'Fashion'] as $category)
                        <a href="#" class="group">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center hover:shadow-lg hover:border-blue-200 transition-all">
                                <div class="h-12 w-12 mx-auto mb-3 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-900 group-hover:text-blue-600">{{ $category }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }
        
        /* Smooth animations */
        * {
            transition-property: color, background-color, border-color, transform, box-shadow;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
    </style>
</x-app-layout>
