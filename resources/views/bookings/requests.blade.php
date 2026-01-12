<x-app-layout>
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Rental Requests</h1>
                    <p class="text-sm text-gray-600">Pending requests for your listings.</p>
                </div>
                <a href="{{ route('notifications.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Notifications</a>
            </div>

            @if(session('success'))
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="rounded-lg border border-rose-200 bg-rose-50 text-rose-800 px-4 py-3">{{ session('error') }}</div>
            @endif

            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                @if($requests->count())
                    <ul class="divide-y divide-gray-100">
                        @foreach($requests as $booking)
                            <li class="p-4 sm:p-5">
                                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                    <div class="space-y-1">
                                        <div class="text-sm font-semibold text-gray-900">{{ $booking->product->title ?? 'Listing removed' }}</div>
                                        <div class="text-sm text-gray-700">{{ $booking->renter->name ?? 'Unknown renter' }}</div>
                                        <div class="text-xs text-gray-500">{{ $booking->start_date->format('M d, Y') }} → {{ $booking->end_date->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-500">Total: ${{ number_format($booking->total_price, 2) }}</div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <form method="POST" action="{{ route('bookings.accept', $booking) }}">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg shadow-sm transition">
                                                Accept
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('bookings.reject', $booking) }}">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-rose-600 border border-rose-200 hover:bg-rose-50 rounded-lg transition">
                                                Reject
                                            </button>
                                        </form>
                                        @if($booking->status !== 'completed' && (auth()->id() === optional($booking->product)->owner_id || (auth()->user() && auth()->user()->is_admin)))
                                            <form method="POST" action="{{ route('bookings.complete', $booking) }}">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm transition">
                                                    Complete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="px-4 py-3 border-t border-gray-100">{{ $requests->links() }}</div>
                @else
                    <div class="p-8 text-center text-gray-600">
                        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">No pending requests</h3>
                        <p class="text-sm">New rental requests will show up here.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
