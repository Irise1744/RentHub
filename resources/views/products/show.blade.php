<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Listing Details</h2>
            <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('products.index') }}" 
               class="text-sm font-medium text-blue-600 hover:text-blue-700">
                Back to {{ auth()->user()->role === 'admin' ? 'Product List' : 'Discover' }}
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 text-rose-800 px-4 py-3">
                {{ session('error') }}
            </div>
            @endif

            <div class="bg-white shadow-sm border border-gray-200 rounded-2xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="bg-gray-50 p-6 flex items-center justify-center">
                        <div class="w-full max-w-md aspect-square rounded-2xl overflow-hidden bg-white border border-gray-200">
                            <img src="{{ $product->image_url ? \Illuminate\Support\Facades\Storage::url($product->image_url) : asset('storage/products/default.jpg') }}"
                                alt="{{ $product->title }}"
                                class="w-full h-full object-cover">
                        </div>
                    </div>

                    <div class="p-8 space-y-6">
                        <div>
                            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                {{ $product->category ?? 'General' }}
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900 mt-1">{{ $product->title }}</h1>
                            <div class="mt-3 flex items-center space-x-3 text-gray-600">
                                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ ucfirst($product->condition ?? 'Unknown') }} condition
                                </span>
                                @php
                                $listingStatus = strtolower($product->status ?? 'inactive');
                                $rentalStatus = strtolower($product->rental_status ?? 'available');

                                if ($listingStatus !== 'active') {
                                $badge = ['label' => 'Inactive', 'class' => 'bg-gray-100 text-gray-800 border-gray-200'];
                                } elseif ($rentalStatus === 'rented') {
                                $badge = ['label' => 'Rented', 'class' => 'bg-red-100 text-red-800 border-red-200'];
                                } else {
                                $badge = ['label' => 'Available', 'class' => 'bg-green-100 text-green-800 border-green-200'];
                                }

                                $isListingActive = $listingStatus === 'active';
                                $isRented = $rentalStatus === 'rented';
                                $isAvailable = $isListingActive && ! $isRented;
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full border {{ $badge['class'] }}">
                                    {{ $badge['label'] }}
                                </span>
                            </div>
                        </div>

                        <p class="text-gray-700 leading-relaxed">{{ $product->description ?? 'No description provided.' }}</p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-4 rounded-xl border border-gray-200">
                                <div class="text-xs font-semibold text-gray-500 uppercase">Price</div>
                                <div class="mt-1 text-2xl font-bold text-gray-900">${{ number_format($product->price_per_day, 0) }} <span class="text-sm font-medium text-gray-500">/day</span></div>
                            </div>
                            <div class="p-4 rounded-xl border border-gray-200">
                                <div class="text-xs font-semibold text-gray-500 uppercase">Location</div>
                                <div class="mt-1 text-base font-medium text-gray-900">{{ $product->location ?? 'Location not set' }}</div>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            @if(!empty($product->owner->avatar))
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($product->owner->avatar) }}" alt="{{ $product->owner->name ?? 'Owner' }}" class="w-10 h-10 rounded-full object-cover">
                            @else
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-semibold">
                                {{ substr($product->owner->name ?? 'U', 0, 1) }}
                            </div>
                            @endif

                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ $product->owner->name ?? 'Unknown' }}</div>
                                <div class="text-xs text-gray-500">Owner</div>
                                @if(!empty($product->owner->phone))
                                <div class="text-sm mt-1">
                                    <a href="tel:{{ $product->owner->phone }}" class="text-sm text-gray-600 hover:underline">{{ $product->owner->phone }}</a>
                                </div>
                                @else
                                <div class="text-sm mt-1 text-gray-400">Phone not provided</div>
                                @endif
                            </div>
                        </div>

                        <div class="pt-4">
                            @if(auth()->check() && auth()->id() === $product->owner_id)
                            <div class="rounded-lg border border-blue-100 bg-blue-50 text-blue-800 px-4 py-3">
                                You are the owner of this listing. Share it with others to get rentals.
                            </div>
                            @else
                            <div class="rounded-xl border border-gray-200 p-5" id="rental-calculator" data-price="{{ $product->price_per_day }}">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <div class="text-xs uppercase font-semibold text-gray-500">Rental Details</div>
                                        <div class="text-sm text-gray-600">Select your dates to request this item.</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-bold text-gray-900">${{ number_format($product->price_per_day, 2) }}</div>
                                        <div class="text-xs text-gray-500">per day</div>
                                    </div>
                                </div>

                                @auth
                                @if($isAvailable)
                                <form method="POST" action="{{ route('products.bookings.store', $product) }}" class="space-y-4" id="rental-form">
                                    @csrf
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1" for="start_date">Start date</label>
                                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" min="{{ now()->toDateString() }}" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                            @error('start_date')
                                            <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1" for="end_date">End date</label>
                                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" min="{{ now()->toDateString() }}" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                                            @error('end_date')
                                            <p class="text-xs text-rose-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between rounded-lg bg-gray-50 border border-gray-200 px-4 py-3">
                                        <div>
                                            <div class="text-sm font-semibold text-gray-800">Estimated total</div>
                                            <div class="text-xs text-gray-500">Calculated with selected dates</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-lg font-bold text-gray-900" id="estimated-total">$0.00</div>
                                            <div class="text-xs text-gray-500" id="rental-days">0 days</div>
                                        </div>
                                    </div>

                                    <button type="submit" class="w-full inline-flex justify-center items-center px-5 py-3 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition">
                                        Rent Now
                                    </button>
                                </form>
                                @else
                                <div class="rounded-lg border border-gray-100 bg-gray-50 text-gray-700 px-4 py-3">
                                    This listing is not available for rental right now.
                                </div>
                                @endif
                                @else
                                <div class="rounded-lg border border-blue-100 bg-blue-50 text-blue-800 px-4 py-3">
                                    Please <a class="font-semibold underline" href="{{ route('login') }}">log in</a> to request a rental.
                                </div>
                                @endauth
                            </div>
                            {{-- Admin controls --}}
                            @auth
                            @if(auth()->user()->role === 'admin')
                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this listing?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 font-semibold">Delete</button>
                            </form>
                            @endif
                            @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const wrapper = document.getElementById('rental-calculator');
        if (!wrapper) return;

        const pricePerDay = Number(wrapper.dataset.price || 0);
        const startInput = document.getElementById('start_date');
        const endInput = document.getElementById('end_date');
        const totalEl = document.getElementById('estimated-total');
        const daysEl = document.getElementById('rental-days');

        const formatMoney = (value) => `$${value.toFixed(2)}`;

        const updateTotals = () => {
            const start = startInput?.value ? new Date(startInput.value) : null;
            const end = endInput?.value ? new Date(endInput.value) : null;

            if (!start || !end || isNaN(start.getTime()) || isNaN(end.getTime())) {
                totalEl.textContent = formatMoney(0);
                daysEl.textContent = '0 days';
                return;
            }

            const msPerDay = 1000 * 60 * 60 * 24;
            const diff = Math.floor((end - start) / msPerDay) + 1; // inclusive of end date

            if (diff <= 0) {
                totalEl.textContent = formatMoney(0);
                daysEl.textContent = '0 days';
                return;
            }

            const total = diff * pricePerDay;
            totalEl.textContent = formatMoney(total);
            daysEl.textContent = `${diff} ${diff === 1 ? 'day' : 'days'}`;
        };

        startInput?.addEventListener('change', updateTotals);
        endInput?.addEventListener('change', updateTotals);
        updateTotals();
    });
</script>