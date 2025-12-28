@extends('layout.app')

@section('content')
    <h1>My Listings</h1>

    @if(isset($products) && $products->count())
        <ul>
            @foreach($products as $product)
                <li>
                    <a href="{{ route('products.show', $product->product_id) }}">{{ $product->title }}</a>
                    — ${{ number_format($product->price_per_day, 2) }} / day
                </li>
            @endforeach
        </ul>
    @else
        <p>You have no listings.</p>
    @endif
@endsection
