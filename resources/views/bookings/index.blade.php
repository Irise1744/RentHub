<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Main Container -->
        <div class="mb-10">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
                <!-- Section Header -->
                <div class="bg-gradient-to-r from-blue-50 to-teal-50 p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-teal-400 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">My Bookings</h2>
                                <p class="text-sm text-gray-600 mt-1">Overview of all your rental bookings</p>
                            </div>
                        </div>
                        <div class="text-sm text-gray-600">
                            Total: {{ $bookings->total() }} bookings
                        </div>
                    </div>
                </div>

                @if($bookings->count() > 0)
                    <!-- Bookings Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($bookings as $booking)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <!-- Product Column -->
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @if($booking->product->image_url ?? false)
                                                <div class="h-10 w-10 rounded-lg overflow-hidden mr-3">
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($booking->product->image_url) }}"
                                                        alt="{{ $booking->product->title ?? 'N/A' }}"
                                                        class="h-full w-full object-cover">
                                                </div>
                                                @endif
                                                <div>
                                                    <div class="font-medium text-gray-900">{{ $booking->product->title ?? 'N/A' }}</div>
                                                    <div class="text-sm text-gray-500">{{ $booking->product->category ?? 'General' }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Owner Column -->
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">{{ $booking->owner->name ?? 'N/A' }}</div>
                                            <div class="text-sm text-gray-500">{{ $booking->owner->email ?? 'N/A' }}</div>
                                        </td>

                                        <!-- Dates Column -->
                                        <td class="px-6 py-4">
                                            <div class="space-y-1">
                                                <div class="flex items-center text-sm text-gray-900">
                                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ $booking->start_date->format('M d, Y') }}
                                                </div>
                                                <div class="flex items-center text-sm text-gray-900">
                                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ $booking->end_date->format('M d, Y') }}
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Total Price Column -->
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-gray-900">${{ number_format($booking->total_price, 2) }}</div>
                                            <div class="text-sm text-gray-500">
                                                @php
                                                    $days = $booking->start_date->diffInDays($booking->end_date);
                                                    $pricePerDay = $days > 0 ? $booking->total_price / $days : $booking->total_price;
                                                @endphp
                                                ${{ number_format($pricePerDay, 2) }}/day
                                            </div>
                                        </td>

                                        <!-- Status Column -->
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold 
                                                    {{ $booking->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                                       ($booking->status === 'cancelled' ? 'bg-red-100 text-red-800' : 
                                                       ($booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                       'bg-blue-100 text-blue-800')) }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                                <div class="text-xs text-gray-500 mt-1">
                                                    @if($booking->start_date->isFuture())
                                                        Starts in {{ $booking->start_date->diffForHumans(null, false, false, 2) }}
                                                    @elseif($booking->end_date->isPast())
                                                        Ended {{ $booking->end_date->diffForHumans() }}
                                                    @else
                                                        Ongoing
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($bookings->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of {{ $bookings->total() }} results
                            </div>
                            <div class="flex space-x-2">
                                {{ $bookings->links() }}
                            </div>
                        </div>
                    </div>
                    @endif

                @else
                    <!-- Empty State -->
                    <div class="px-6 py-16 text-center">
                        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No bookings yet</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-6">
                            You haven't made any bookings yet. Start exploring products to make your first booking!
                        </p>
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-teal-400 text-white font-medium rounded-lg hover:from-blue-600 hover:to-teal-500 transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Explore Products
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>