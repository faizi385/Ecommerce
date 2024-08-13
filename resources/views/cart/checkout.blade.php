@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Checkout</h1>

    <!-- Checkout Form -->
    <form action="{{ route('cart.checkout') }}" method="POST">
        @csrf

        <!-- Add any other necessary checkout details here -->

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
        </div>

        <div class="form-group mt-3">
            <label for="payment">Payment Method</label>
            <select class="form-control" id="payment" name="payment" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="notes">Additional Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter any additional notes here (optional)"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Place Order</button>
    </form>
</div>
@endsection
