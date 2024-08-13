@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Shopping Cart</h1>

        @if ($cart && count($cart) > 0)
            <div class="row">
                @foreach ($cart as $id => $item)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if (isset($item['image']))
                                <img src="{{ asset('storage/' . $item['image']) }}" class="card-img-top" alt="{{ $item['name'] }}">
                            @else
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="{{ $item['name'] }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $item['name'] }}</h5>
                                <p class="card-text">Price: ${{ number_format($item['price'], 2) }}</p>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-outline-secondary btn-sm adjust-quantity" data-id="{{ $id }}" data-action="decrease">-</button>
                                    <input type="text" class="form-control form-control-sm mx-2 text-center" value="{{ $item['quantity'] }}" style="width: 60px;" readonly>
                                    <button class="btn btn-outline-secondary btn-sm adjust-quantity" data-id="{{ $id }}" data-action="increase">+</button>
                                </div>
                                <p class="card-text mt-2">Total: ${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove from Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <h3>Total: ${{ number_format(array_sum(array_map(function($item) {
                    return $item['price'] * $item['quantity'];
                }, $cart)), 2) }}</h3>
                <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
            </div>
        @else
            <p class="text-center">Your cart is empty.</p>
        @endif
    </div>
@endsection
