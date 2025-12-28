@extends('layout.app')

@section('content')
  <h1>Browse Items</h1>

  @foreach($products as $product)
    <div class="card">
      <h3>{{ $product->title }}</h3>
      <p>{{ $product->price_per_day }} $/day</p>
      <p>{{ $product->location }}</p>
      <p>{{ $product->condition }}</p>
    </div>
  @endforeach
@endsection
