@extends('layout')

@section('content')
<h1 style="margin-left:50px;">Your carts</h1>

@if(session('success'))
    <div style="margin-left:50px;" >{{ session('success') }}</div>
@endif

@if($errors->any())
    <div style="margin-left:50px;" >
        <ul>
        @foreach($errors->all() as $error)
            <li style="color:red">{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

@if($carts->items->isEmpty())
    <p style="margin-left:50px;"> Your Carts is empty.</p>
@else
    <table style="margin-left:50px;">
        <thead>
            <tr>
                <th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($carts->items as $item)
                @php
                    $total = $item->quantity * $item->product->price;
                    $grandTotal += $total;
                @endphp
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>₹{{ number_format($item->product->price, 2) }}</td>
                    <td>
                        <form method="POST" action="{{ route('carts.update', $item->id) }}">
                            @csrf
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock_quantity }}">
                            <button type="submit">Update</button>
                        </form>
                    </td>
                    <td>₹{{ number_format($total, 2) }}</td>
                    <td>
                        <form method="POST" action="{{ route('carts.remove', $item->id) }}">
                            @csrf
                            <button type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>Grand Total</strong></td>
                <td><strong>₹{{ number_format($grandTotal, 2) }}</strong></td>
                <td></td>
            </tr>
        </tbody>
    </table>
@endif
@endsection
