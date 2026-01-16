<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Notifications</h1>
                        <p class="text-gray-600 mt-1">Stay updated with your rental activity</p>
                    </div>
                    <a href="{{ route('bookings.requests') }}" 
                       class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5 shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Manage Rental Requests
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                        <div class="text-2xl font-bold text-gray-900">{{ $notifications->total() }}</div>
                        <div class="text-sm text-gray-600">Total</div>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                        <div class="text-2xl font-bold text-gray-900">{{ $notifications->where('is_read', false)->count() }}</div>
                        <div class="text-sm text-gray-600">Unread</div>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                        <div class="text-2xl font-bold text-blue-600">{{ $notifications->where('type', 'booking_request')->count() }}</div>
                        <div class="text-sm text-gray-600">Rental Requests</div>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                        <div class="text-2xl font-bold text-emerald-600">{{ $notifications->where('type', 'booking_update')->count() }}</div>
                        <div class="text-sm text-gray-600">Updates</div>
                    </div>
                </div>
            </div>

            <!-- Notifications List -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
                @if($notifications->count())
                    <div class="divide-y divide-gray-100">
                        @foreach($notifications as $notification)
                            <div class="p-6 hover:bg-gray-50/50 transition-colors {{ $notification->is_read ? '' : 'bg-gradient-to-r from-blue-50/30 to-cyan-50/30 border-l-4 border-blue-500' }}">
                                <div class="flex flex-col gap-4">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start gap-4 flex-1">
                                            <!-- Icon -->
                                            <div class="p-2.5 rounded-lg {{ $notification->type === 'booking_request' ? 'bg-amber-100' : 'bg-blue-100' }}">
                                                @if($notification->type === 'booking_request')
                                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @endif
                                            </div>
                                            
                                            <!-- Content -->
                                            <div class="flex-1">
                                                <p class="text-gray-800">{{ $notification->message }}</p>
                                                <div class="flex flex-wrap items-center gap-3 mt-2">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $notification->type === 'booking_request' ? 'bg-amber-100 text-amber-800' : 'bg-blue-100 text-blue-800' }}">
                                                        {{ str_replace('_', ' ', ucfirst($notification->type)) }}
                                                    </span>
                                                    <span class="text-xs text-gray-500">
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </span>
                                                    @if($notification->booking)
                                                        <span class="text-xs px-2.5 py-0.5 rounded-full font-medium {{ 
                                                            $notification->booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                                            ($notification->booking->status === 'accepted' ? 'bg-emerald-100 text-emerald-800' :
                                                            ($notification->booking->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'))
                                                        }}">
                                                            {{ ucfirst($notification->booking->status) }}
                                                        </span>
                                                    @endif
                                                    @if(!$notification->is_read)
                                                        <span class="text-xs px-2.5 py-0.5 rounded-full font-medium bg-blue-100 text-blue-800">
                                                            New
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Read Status -->
                                        @if(!$notification->is_read)
                                            <form method="POST" action="{{ route('notifications.mark-read', $notification) }}" class="ml-2">
                                                @csrf
                                                <button type="submit" class="text-xs text-blue-600 hover:text-blue-700 hover:bg-blue-50 px-2 py-1 rounded">
                                                    Mark as read
                                                </button>
                                            </form>
                                        @endif
                                    </div>

                                    <!-- Actions for booking requests -->
                                    @if($notification->type === 'booking_request' && $notification->booking && $notification->booking->status === 'pending' && optional($notification->booking->product)->owner_id === auth()->id())
                                        <div class="flex flex-wrap gap-3 ml-14">
                                            <form method="POST" action="{{ route('bookings.accept', $notification->booking) }}" class="flex-1 min-w-[120px]">
                                                @csrf
                                                <button type="submit" 
                                                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-green-600 text-white font-semibold rounded-lg hover:shadow-md transition-all duration-300">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Accept Request
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('bookings.reject', $notification->booking) }}" class="flex-1 min-w-[120px]">
                                                @csrf
                                                <button type="submit" 
                                                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 font-semibold rounded-lg hover:shadow-md transition-all duration-300">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Decline
                                                </button>
                                            </form>
                                            <a href="{{ route('bookings.requests') }}" 
                                               class="flex-1 min-w-[120px] flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 font-semibold rounded-lg hover:shadow-md transition-all duration-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View Details
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($notifications->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200">
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-700">
                                    Showing {{ $notifications->firstItem() }} to {{ $notifications->lastItem() }} of {{ $notifications->total() }} notifications
                                </div>
                                <div class="flex items-center gap-2">
                                    {{ $notifications->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-blue-100 to-cyan-100 border border-blue-200 mb-6">
                            <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">You're all caught up!</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            No new notifications. New rental requests and updates will appear here.
                        </p>
                        <a href="{{ route('products.index') }}" 
                           class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Browse Listings
                        </a>
                    </div>
                @endif
            </div>

            <!-- Quick Actions -->
            @if($notifications->count())
                <div class="mt-8 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl border border-blue-200/50 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('bookings.requests') }}" 
                           class="flex items-center gap-3 p-4 bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all duration-300">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">Manage Requests</div>
                                <div class="text-sm text-gray-600">View all booking requests</div>
                            </div>
                        </a>
                        
                        <a href="{{ route('users.my-listings') }}" 
                           class="flex items-center gap-3 p-4 bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all duration-300">
                            <div class="p-2 bg-emerald-100 rounded-lg">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">My Listings</div>
                                <div class="text-sm text-gray-600">Check your rental items</div>
                            </div>
                        </a>
                        
                        <a href="{{ route('profile.edit') }}" 
                           class="flex items-center gap-3 p-4 bg-white rounded-xl border border-gray-200 hover:shadow-md transition-all duration-300">
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">Profile</div>
                                <div class="text-sm text-gray-600">Update your information</div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
