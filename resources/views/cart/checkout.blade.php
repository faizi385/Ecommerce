@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Checkout</h1>

    <div class="row">
        <!-- Checkout Form (Left Column) -->
        <div class="col-md-6">
            <form action="{{ route('cart.checkout') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
                @csrf

                <!-- Address Details -->
                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control form-control-sm" id="address" name="address" placeholder="Enter your address" required>
                </div>

                <div class="form-group mb-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control form-control-sm" id="city" name="city" placeholder="Enter your city" required>
                </div>

                <div class="form-group mb-3">
                    <label for="country">Country</label>
                    <input type="text" class="form-control form-control-sm" id="country" name="country" placeholder="Enter your country" required>
                </div>

                <!-- Payment Method -->
                <div class="form-group mb-3">
                    <label for="cash_on_delivery">Cash on Delivery</label>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="cash_on_delivery" name="payment" value="cash_on_delivery" required>
                        <label class="form-check-label" for="cash_on_delivery">I agree to pay with Cash on Delivery</label>
                    </div>
                </div>

                <!-- Additional Notes -->
                <div class="form-group mb-3">
                    <label for="notes">Additional Notes</label>
                    <textarea class="form-control form-control-sm" id="notes" name="notes" rows="3" placeholder="Enter any additional notes here (optional)"></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Place Order</button>
            </form>
        </div>

        <!-- Product Details (Right Column) -->
        <div class="col-md-6">
            <h4 class="mb-4">Your Order Details</h4>
            @if (isset($cart) && count($cart) > 0)
                @foreach ($cart as $id => $item)
                    <div class="card mb-3">
                        @if (isset($item['image']))
                            <img src="{{ asset('storage/' . $item['image']) }}" class="card-img-top" alt="{{ $item['name'] }}">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="{{ $item['name'] }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['name'] }}</h5>
                            <p class="card-text">Price: ${{ number_format($item['price'], 2) }}</p>
                            <p class="card-text">Quantity: {{ $item['quantity'] }}</p>
                            <p class="card-text">Total: ${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        </div>
                    </div>
                @endforeach

                <h5 class="text-right">Grand Total: ${{ number_format(array_sum(array_map(function($item) {
                    return $item['price'] * $item['quantity'];
                }, $cart)), 2) }}</h5>
            @else
                <p class="text-center">No products in your cart.</p>
            @endif
        </div>
    </div>
</div>
@endsection
