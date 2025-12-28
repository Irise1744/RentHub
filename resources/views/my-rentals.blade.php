@extends('layout.app')

@section('content')
    <h1>My Rentals</h1>

    @if(isset($bookings) && $bookings->count())
        <ul>
            @foreach($bookings as $booking)
                <li>
                    <strong>{{ $booking->product->title ?? 'Product' }}</strong>
                    — {{ $booking->start_date->format('Y-m-d') }} to {{ $booking->end_date->format('Y-m-d') }}
                    — ${{ number_format($booking->total_price, 2) }}
                </li>
            @endforeach
        </ul>
    @else
        <p>You have no rentals.</p>
    @endif
@endsection
