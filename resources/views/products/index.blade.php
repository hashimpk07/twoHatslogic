@extends('layout')

@section('content')
<h1  style="margin-left:50px;" >Products</h1>

@if(session('success'))
    <div style="margin-left:50px;" >{{ session('success') }}</div>
@endif

@foreach($products as $product)
    <div style="margin-left:50px;">
        <h3>{{ $product->name }}</h3>
        <p>Price: ₹{{ number_format($product->price, 2) }}</p>
        <p>Available Stock: {{ $product->stock_quantity }}</p>

        <form method="POST" action="{{ route('carts.add') }}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}">
            <button type="submit" @if($product->stock_quantity <= 0) disabled @endif>Add to Carts</button>
        </form>
    </div>
@endforeach
@endsection
