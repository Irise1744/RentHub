@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">
        {{ $isHistory ? 'Borrowed Products History' : 'Browse Products' }}
    </h1>

    @if($isHistory)
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Borrowed Products History</h2>
            <ul class="list-disc pl-5">
                @forelse ($products as $product)
                    <li class="mb-2">
                        <strong>{{ $product->title }}</strong> - Owned by {{ $product->owner->name }} ({{ $product->owner->phone }})
                    </li>
                @empty
                    <li>No borrowed products found.</li>
                @endforelse
            </ul>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ $product->image_url ? \Illuminate\Support\Facades\Storage::url($product->image_url) : asset('storage/products/default.jpg') }}" alt="{{ $product->title }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold">{{ $product->title }}</h2>
                        <p class="text-gray-600">{{ $product->description }}</p>
                        <p class="text-gray-800 font-bold mt-2">${{ $product->price_per_day }} / day</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">No products found.</p>
            @endforelse
        </div>
    @endif
</div>
@endsection