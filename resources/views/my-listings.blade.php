<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/20 to-amber-50/20 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">My Listings</h1>
                    <p class="text-gray-600">Share what you want to rent out and track your posts.</p>
                </div>
                <a href="{{ route('products.create') }}" class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                    </svg>
                    New Listing
                </a>
            </div>

            @if(session('success'))
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($products->count())
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($products as $product)
                        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">
                            <div class="h-40 bg-gray-100 relative">
                                <img src="{{ $product->image_url ? \Illuminate\Support\Facades\Storage::url($product->image_url) : asset('storage/products/default.jpg') }}" alt="{{ $product->title }}" class="w-full h-full object-cover">
                                <span class="absolute top-3 left-3 px-2 py-1 text-xs font-semibold rounded-full bg-white/90 text-gray-800">{{ $product->category ?? 'General' }}</span>
                            </div>
                            <div class="p-5 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold uppercase tracking-wide text-indigo-600">{{ $product->category ?? 'General' }}</span>
                                @php
                                    $listingStatus = strtolower($product->status ?? 'inactive');
                                    $rentalStatus = strtolower($product->rental_status ?? 'available');
                                    if ($listingStatus !== 'active') {
                                        $myBadge = ['label' => ucfirst('inactive'), 'class' => 'bg-gray-100 text-gray-600'];
                                    } elseif ($rentalStatus === 'rented') {
                                        $myBadge = ['label' => 'Rented', 'class' => 'bg-red-100 text-red-800'];
                                    } else {
                                        $myBadge = ['label' => 'Available', 'class' => 'bg-emerald-50 text-emerald-700'];
                                    }
                                @endphp
                                <span class="text-xs px-2 py-1 rounded-full {{ $myBadge['class'] }}">{{ $myBadge['label'] }}</span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 line-clamp-1">{{ $product->title }}</h3>
                            <p class="text-sm text-gray-600 line-clamp-2">{{ $product->description }}</p>
                            <div class="text-sm text-gray-500 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 12.414a4 4 0 10-1.414 1.414l4.243 4.243a1 1 0 001.414-1.414z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 14a4 4 0 100-8 4 4 0 000 8z"/></svg>
                                {{ $product->location ?? 'Location not set' }}
                            </div>
                            <div class="flex items-center justify-between text-sm text-gray-700">
                                <span class="font-semibold text-gray-900">${{ number_format($product->price_per_day, 2) }} / day</span>
                                <span class="text-xs text-gray-500">{{ $product->available_from ? 'Available ' . \Carbon\Carbon::parse($product->available_from)->format('M d') : 'Availability not set' }}</span>
                            </div>
                            <div class="flex items-center justify-between pt-2 text-sm">
                                <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-700 font-semibold">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this listing?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700 font-semibold">Delete</button>
                                </form>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pt-4">{{ $products->links() }}</div>
            @else
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-10 text-center text-gray-600">
                    <p class="text-lg font-semibold text-gray-900 mb-2">No listings yet</p>
                    <p class="mb-4">Create your first listing to start renting to others.</p>
                    <a href="{{ route('products.create') }}" class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                        </svg>
                        New Listing
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
