@extends('layout')

@section('content')
<div class="container"  style="margin-left:50px;" >
    <h2>Your Cart</h2>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @foreach($items as $item)
        <div style="margin-bottom: 10px;">
            <strong>{{ $item->product->name }}</strong><br>
            Price: ₹{{ $item->product->price }} <br>
            Stock: {{ $item->product->stock_quantity }}<br>

            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                @csrf
                @method('PATCH')
                Quantity:
                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock_quantity }}">
                <button type="submit">Update</button>
            </form>

            Line Total: ₹{{ number_format($item->quantity * $item->product->price, 2) }}
        </div>
        <hr>
    @endforeach

    <h3>Total: ₹{{ number_format($total, 2) }}</h3>
</div>
@endsection
