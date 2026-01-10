<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">Listing Details</h2>
            <a href="{{ route('products.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">Back to Discover</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
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
                                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ ucfirst($product->status ?? 'active') }}
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
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-semibold">
                                {{ substr($product->owner->name ?? 'U', 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ $product->owner->name ?? 'Unknown' }}</div>
                                <div class="text-xs text-gray-500">Owner</div>
                            </div>
                        </div>

                        <div class="pt-4 flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-3 sm:space-y-0">
                            <button class="inline-flex justify-center items-center px-5 py-3 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition" type="button" disabled>
                                Request to Borrow
                            </button>
                            <button class="inline-flex justify-center items-center px-4 py-3 text-sm font-semibold text-blue-600 hover:text-blue-700 border border-blue-200 hover:border-blue-300 rounded-lg transition" type="button" disabled>
                                Save for Later
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
