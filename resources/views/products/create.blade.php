<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-cyan-50 px-4 py-8">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Premium header -->
            <div class="px-8 pt-8 pb-6 border-b border-gray-100">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-2 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">Create New Listing</h2>
                                <p class="text-sm text-gray-600 mt-1">Share your item with the community</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('users.my-listings') }}" 
                       class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-1.5 bg-red-100 rounded-lg">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="font-semibold text-red-700 text-sm">Please fix the following:</div>
                        </div>
                        <ul class="text-sm text-red-600 space-y-1 pl-8">
                            @foreach ($errors->all() as $error)
                                <li class="relative before:absolute before:left-[-1rem] before:content-['•']">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Basic Info -->
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Basic Information</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">TITLE</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:bg-blue-50/50 transition-all"
                                   placeholder="What are you renting?"
                                   required>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">CATEGORY</label>
                            <select name="category"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:bg-blue-50/50 transition-all appearance-none"
                                    required>
                                <option value="" disabled selected>Select category</option>
                                <option value="electronics" {{ old('category') == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                <option value="sports" {{ old('category') == 'sports' ? 'selected' : '' }}>Sports & Outdoors</option>
                                <option value="home" {{ old('category') == 'home' ? 'selected' : '' }}>Home & Garden</option>
                                <option value="tools" {{ old('category') == 'tools' ? 'selected' : '' }}>Tools</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-2">DESCRIPTION</label>
                        <textarea name="description" rows="4"
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:bg-blue-50/50 transition-all resize-none"
                                  placeholder="Describe your item, features, and condition..."
                                  required>{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Details -->
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Details</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">CONDITION</label>
                            <select name="condition"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:bg-blue-50/50 transition-all appearance-none"
                                    required>
                                <option value="" disabled selected>Select condition</option>
                                <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>Brand New</option>
                                <option value="like new" {{ old('condition') == 'like new' ? 'selected' : '' }}>Like New</option>
                                <option value="excellent" {{ old('condition') == 'excellent' ? 'selected' : '' }}>Excellent</option>
                                <option value="good" {{ old('condition') == 'good' ? 'selected' : '' }}>Good</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-2">PRICE PER DAY ($)</label>
                            <input type="number" step="0.01" name="price_per_day" value="{{ old('price_per_day') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:bg-blue-50/50 transition-all"
                                   placeholder="0.00"
                                   min="0"
                                   required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-2">LOCATION</label>
                        <input type="text" name="location" value="{{ old('location') }}"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 focus:bg-blue-50/50 transition-all"
                               placeholder="City, State or Neighborhood"
                               required>
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Image</h3>
                    
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-2">PRODUCT PHOTO</label>
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-blue-300 transition-colors cursor-pointer bg-gray-50/50">
                            <svg class="w-10 h-10 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <label for="image-upload" class="cursor-pointer">
                                <span class="text-gray-700 font-medium text-sm">Click to upload</span>
                                <span class="text-gray-500 text-sm block mt-1">or drag and drop</span>
                                <span class="text-gray-400 text-xs block mt-2">PNG, JPG, WebP up to 2MB</span>
                            </label>
                            <input id="image-upload" type="file" name="image" accept="image/*" class="hidden">
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-between gap-4 pt-8 border-t border-gray-100">
                    <a href="{{ route('users.my-listings') }}"
                       class="w-1/2 px-6 py-3.5 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-colors text-center font-medium">
                        Cancel
                    </a>
                    
                    <button type="submit"
                            class="w-1/2 px-6 py-3.5 rounded-xl font-semibold text-white bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 shadow-md hover:shadow-lg transition-all">
                        Publish Listing
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>