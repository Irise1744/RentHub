<x-app-layout>
    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Notifications</h1>
                    <p class="text-sm text-gray-600">Rental requests and updates for your listings.</p>
                </div>
            </div>

            <div class="mb-4">
                <a href="{{ route('bookings.requests') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition">
                    Manage rental requests
                </a>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                @if($notifications->count())
                    <ul class="divide-y divide-gray-100">
                        @foreach($notifications as $notification)
                            <li class="p-4 sm:p-5 {{ $notification->is_read ? 'bg-white' : 'bg-blue-50/50' }}">
                                <div class="flex flex-col gap-3">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="flex-1">
                                            <div class="text-sm text-gray-800">{{ $notification->message }}</div>
                                            <div class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</div>
                                            @if($notification->booking)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    Status: <span class="font-semibold text-gray-800">{{ ucfirst($notification->booking->status) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $notification->type === 'booking_request' ? 'bg-amber-50 text-amber-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ str_replace('_', ' ', ucfirst($notification->type)) }}
                                        </span>
                                    </div>

                                    @if($notification->type === 'booking_request' && $notification->booking && $notification->booking->status === 'pending' && optional($notification->booking->product)->owner_id === auth()->id())
                                        <div class="flex flex-wrap gap-2">
                                            <form method="POST" action="{{ route('bookings.accept', $notification->booking) }}">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg shadow-sm transition">
                                                    Accept
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('bookings.reject', $notification->booking) }}">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-rose-600 border border-rose-200 hover:bg-rose-50 rounded-lg transition">
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="px-4 py-3 border-t border-gray-100">
                        {{ $notifications->links() }}
                    </div>
                @else
                    <div class="p-8 text-center text-gray-600">
                        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">You are all caught up</h3>
                        <p class="text-sm">New rental requests and updates will appear here.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
