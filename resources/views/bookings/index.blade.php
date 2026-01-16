<x-app-layout>
    <div class="min-h-screen bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-3xl font-bold text-gray-900">My Rentals</h1>

            <div class="mt-8">
                <h2 class="text-2xl font-semibold text-gray-800">Renting Out</h2>
                <table class="min-w-full mt-4 border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Item</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Renter</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rentingOut as $rental)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $rental->item->name }}</td>
                                <td class="px-4 py-2">{{ $rental->renter->name }}</td>
                                <td class="px-4 py-2">{{ ucfirst($rental->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-center text-gray-500">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-12">
                <h2 class="text-2xl font-semibold text-gray-800">Renting</h2>
                <table class="min-w-full mt-4 border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Item</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Owner</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($renting as $rental)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $rental->item->name }}</td>
                                <td class="px-4 py-2">{{ $rental->owner->name }}</td>
                                <td class="px-4 py-2">{{ ucfirst($rental->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-2 text-center text-gray-500">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>