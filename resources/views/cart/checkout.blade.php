@extends('layouts.app')

@section('content')
<div class="container ">
    <h1 class="mb-4 text-center">Checkout</h1>

    <!-- Checkout Form -->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card-m shadow-sm border-0 rounded p-4">
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf

                    <!-- Address Details Section -->
                    <div class="mb-4">
                        <h5 class="mb-3">Address Details</h5>
                        
                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control form-control-lg" id="address" name="address" placeholder="Enter your address" required>
                        </div>

                        <!-- First Name, Last Name, City, and Country in One Line -->
                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control form-control-lg" id="first_name" name="first_name" placeholder="Enter your first name" required>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control form-control-lg" id="last_name" name="last_name" placeholder="Enter your last name" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="city">City</label>
                                <input type="text" class="form-control form-control-lg" id="city" name="city" placeholder="Enter your city" required>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="country">Country</label>
                                <input type="text" class="form-control form-control-lg" id="country" name="country" placeholder="Enter your country" required>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="form-group mb-3">
                        <label for="cash_on_delivery" class="d-block">Payment Method</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="cash_on_delivery" name="payment" value="cash_on_delivery" required>
                            <label class="form-check-label" for="cash_on_delivery">I agree to pay with Cash on Delivery</label>
                        </div>
                    </div>

                    <!-- Additional Notes -->
                    <div class="form-group mb-4">
                        <label for="notes">Additional Notes</label>
                        <textarea class="form-control form-control-lg" id="notes" name="notes" rows="3" placeholder="Enter any additional notes here (optional)"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button style="background-color: #021526" type="submit" class="btn btn-lg w-100 text-white">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
