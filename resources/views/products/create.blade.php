<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/20 to-amber-50/20 py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-3xl p-8 border border-gray-100">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Create a Listing</h1>
                <p class="text-sm text-gray-600 mb-6">Share what you want to rent out and set when it is available.</p>

                @if ($errors->any())
                    <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <div class="font-semibold mb-1">Please fix the following:</div>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">TITLE</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">DESCRIPTION</label>
                        <textarea name="description" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">CATEGORY</label>
                            <input type="text" name="category" value="{{ old('category') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">CONDITION</label>
                            <input type="text" name="condition" value="{{ old('condition') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">PRICE PER DAY (USD)</label>
                            <input type="number" step="0.01" name="price_per_day" value="{{ old('price_per_day') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">LOCATION</label>
                            <input type="text" name="location" value="{{ old('location') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">AVAILABLE FROM</label>
                            <input type="date" name="available_from" value="{{ old('available_from') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1">AVAILABLE TO</label>
                            <input type="date" name="available_to" value="{{ old('available_to') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">IMAGE (OPTIONAL)</label>
                        <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-gray-500 mt-1">Max 2MB. JPG, PNG, or WebP.</p>
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <a href="{{ route('users.my-listings') }}" class="px-4 py-3 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="px-5 py-3 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 shadow-lg shadow-blue-500/30">Publish Listing</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
