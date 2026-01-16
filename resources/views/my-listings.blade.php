<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
        <!-- Simplified Header -->
        <div class="relative bg-gradient-to-r from-pink-200 via-blue-200 to-teal-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col sm:flex-row items-start justify-between gap-6">
                    <!-- Left Content -->
                    <div class="flex-1">
                        <!-- Simple Title Section -->
                        <div class="mb-4">
                            <h1 class="text-3xl sm:text-4xl font-bold text-blue-500 mb-2">
                                My Listings
                            </h1>
                            <p class="text-lg text-orange-500">
                                Manage all your rental items in one place
                            </p>
                        </div>
                        
                        <!-- Simple Stats -->
                        <div class="flex flex-wrap items-center gap-3">
                            <div class="flex items-center text-white">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <span class="font-semibold">{{ $products->total() }}</span>
                                <span class="ml-1">items</span>
                            </div>
                            <div class="flex items-center text-white">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ now()->format('M j, Y') }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Button -->
                    <a href="{{ route('products.create') }}" 
                       class="inline-flex items-center justify-center px-6 py-3.5 bg-white text-blue-600 font-semibold rounded-xl hover:shadow-lg transition-all duration-300 hover:-translate-y-1 shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        New Listing
                    </a>
                </div>
            </div>
            
            <!-- Simple Wave Divider -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg class="w-full h-8 text-white" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="currentColor"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35,6.36,119.13-4.36V0Z" opacity=".5" fill="currentColor"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="currentColor"></path>
                </svg>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-4">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-200 rounded-xl shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Quick Stats -->
            @if($products->count())
                @php
                    $activeCount = $products->where('status', 'active')->count();
                    $rentedCount = $products->where('rental_status', 'rented')->count();
                    $inactiveCount = $products->where('status', 'inactive')->count();
                @endphp
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <!-- Active Listings -->
                    <div class="group bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow border border-gray-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-400 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Active</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $activeCount }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Rented Listings -->
                    <div class="group bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow border border-gray-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-400 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Rented</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $activeCount }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Inactive Listings -->
                    <div class="group bg-white rounded-xl shadow-sm p-5 hover:shadow-md transition-shadow border border-gray-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-gray-500 to-gray-400 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 01118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-600">Inactive</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $inactiveCount }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Products Grid -->
            @if($products->count())
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($products as $product)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                            <!-- Image -->
                            <div class="relative h-48 bg-gray-100 overflow-hidden">
                                <img src="{{ $product->image_url ? \Illuminate\Support\Facades\Storage::url($product->image_url) : asset('storage/products/default.jpg') }}" 
                                     alt="{{ $product->title }}" 
                                     class="w-full h-full object-cover">
                                
                                <!-- Status Badge -->
                                @php
                                    $listingStatus = strtolower($product->status ?? 'inactive');
                                    $rentalStatus = strtolower($product->rental_status ?? 'available');
                                    if ($listingStatus !== 'active') {
                                        $statusClass = 'bg-gray-500 text-white';
                                        $statusLabel = 'Inactive';
                                    } elseif ($rentalStatus === 'rented') {
                                        $statusClass = 'bg-red-500 text-white';
                                        $statusLabel = 'Rented';
                                    } else {
                                        $statusClass = 'bg-green-500 text-white';
                                        $statusLabel = 'Available';
                                    }
                                @endphp
                                <div class="absolute top-3 right-3">
                                    <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </div>
                                
                                <!-- Category -->
                                <div class="absolute top-3 left-3">
                                    <span class="px-2 py-1 text-xs font-semibold bg-white/90 text-gray-800 rounded">
                                        {{ $product->category ?? 'General' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="p-5">
                                <!-- Title -->
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-1">
                                    {{ $product->title }}
                                </h3>

                                <!-- Description -->
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                    {{ $product->description ?? 'No description available.' }}
                                </p>

                                <!-- Price -->
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-lg font-bold text-gray-900">
                                        ${{ number_format($product->price_per_day, 0) }}<span class="text-sm font-normal text-gray-600">/day</span>
                                    </span>
                                </div>

                                <!-- Details -->
                                <div class="space-y-2 mb-4">
                                    <!-- Location -->
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="truncate">{{ $product->location ?? 'Location not set' }}</span>
                                    </div>

                                    <!-- Availability -->
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="truncate">
                                            {{ $product->available_from ? 'Available from ' . \Carbon\Carbon::parse($product->available_from)->format('M d') : 'Available now' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <a href="{{ route('products.edit', $product) }}" 
                                       class="text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" 
                                          onsubmit="return confirm('Delete this listing?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-700 font-medium text-sm flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>

                                <!-- Status Actions -->
                                <div class="mt-4 pt-3 border-t border-gray-100">
                                    <div class="flex gap-2">
                                        @if($product->status === 'active')
                                            <form action="{{ route('products.toggle-status', $product) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" 
                                                        class="w-full text-xs px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                                                    Mark Inactive
                                                </button>
                                            </form>
                                            
                                        @elseif($product->status === 'inactive')
                                            <form action="{{ route('products.toggle-status', $product) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" 
                                                        class="w-full text-xs px-3 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                                                    Activate
                                                </button>
                                            </form>
                                        @elseif($product->status === 'rented')
                                            <form action="{{ route('products.toggle-status', $product) }}" method="POST" class="flex-1">
                                                @csrf
                                                <button type="submit" 
                                                        class="w-full text-xs px-3 py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition">
                                                    Mark Available
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="mt-10 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                @endif

            @else
                <!-- Empty State -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-10 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No listings yet</h3>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                        Create your first listing to start renting to others.
                    </p>
                    <a href="{{ route('products.create') }}" 
                       class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Create Your First Listing
                    </a>
                </div>
            @endif

            <!-- Help Section -->
            @if($products->count())
                <div class="mt-10 bg-gradient-to-r from-blue-50 to-teal-50 rounded-xl border border-blue-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Listing Tips</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900 mb-1">Add clear photos</p>
                                <p class="text-xs text-gray-600">Show different angles of your item</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900 mb-1">Set fair prices</p>
                                <p class="text-xs text-gray-600">Research similar listings</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-gray-900 mb-1">Update availability</p>
                                <p class="text-xs text-gray-600">Keep your calendar current</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Custom Styles -->
        <style>
            .line-clamp-1 {
                overflow: hidden;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 1;
            }
            .line-clamp-2 {
                overflow: hidden;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 2;
            }
        </style>
    </div>
</x-app-layout>