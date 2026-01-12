@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Rentals</h1>
    @if($rentals->isEmpty())
        <p>No rentals found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Renter</th>
                    <th>Owner</th>
                    <th>Product</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rentals as $rental)
                    <tr>
                        <td>{{ $rental->renter->name }}</td>
                        <td>{{ $rental->product->owner->name }}</td>
                        <td>{{ $rental->product->title }}</td>
                        <td>{{ $rental->start_date->format('M d, Y') }}</td>
                        <td>{{ $rental->end_date->format('M d, Y') }}</td>
                        <td>${{ number_format($rental->total_price, 2) }}</td>
                        <td>{{ ucfirst($rental->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $rentals->links() }}
    @endif
</div>
@endsection