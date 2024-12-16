@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Shopping Cart</h1>

        @if ($cart && count($cart) > 0)
            <div class="row">
                <!-- Order Details Column -->
                <div class="col-md-8">
                    @foreach ($cart as $id => $item)
                        <div class="mb-4 shadow-sm">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    @if (isset($item['image']))
                                        <img src="{{ asset('storage/' . $item['image']) }}" class="card-img" alt="{{ $item['name'] }}">
                                    @else
                                        <img src="https://via.placeholder.com/150" class="card-img" alt="{{ $item['name'] }}">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item['name'] }}</h5>
                                        <p class="card-text">Price: $<span class="price" data-price="{{ $item['price'] }}">{{ number_format($item['price'], 2) }}</span></p>
                                        <p class="card-text">Size: {{ $item['size'] ?? 'N/A' }}</p>
                                        <div class="d-flex align-items-center mb-2">
                                            <button class="btn btn-outline-secondary btn-sm adjust-quantity" data-id="{{ $id }}" data-action="decrease">-</button>
                                            <input type="text" class="form-control form-control-sm mx-2 text-center quantity" value="{{ $item['quantity'] }}" style="width: 60px;" readonly>
                                            <button class="btn btn-outline-secondary btn-sm adjust-quantity" data-id="{{ $id }}" data-action="increase">+</button>
                                        </div>
                                        <p class="card-text mb-2">Total: $<span class="total-price">{{ number_format($item['price'] * $item['quantity'], 2) }}</span></p>
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button style="background-color: #1B2A49" type="submit" class="btn text-white ">Remove from Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Total Price Column -->
                <div class="col-md-4">
                    <div class="border-light shadow-sm">
                        <div class="card-body">
                            <h3 class="text-center mb-4">Cart Summary</h3>
                            <p class="card-text">Total Items: <span id="cart-total-items">{{ count($cart) }}</span></p>

                            <!-- Calculate Previous Total -->
                            @php
                                $previousTotal = array_sum(array_map(function($item) {
                                    return $item['price'] * $item['quantity'];
                                }, $cart));
                            @endphp

                            <!-- Discount Coupon Form -->
                            <form action="{{ route('cart.applyDiscount') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="discount_code">Discount Code</label>
                                    <input type="text" name="discount_code" id="discount_code" class="form-control" placeholder="Enter discount code">
                                </div>
                                <button style="background-color: #03346E" type="submit" class="btn text-white  btn-block mb-4">Apply Discount</button>
                            </form>

                            @if (session('discount'))
                                @php
                                    $discountAmount = session('discount')['amount'];
                                    $newTotal = $previousTotal - $discountAmount;
                                @endphp
                                <p class="card-text">Discount: $<span id="discount-amount">{{ number_format($discountAmount, 2) }}</span></p>
                                <p class="card-text">Previous Total: $<span id="previous-cart-total-summary">{{ number_format($previousTotal, 2) }}</span></p>
                                <h4 class="text-center mb-4">New Total: $<span id="new-cart-total-summary">{{ number_format($newTotal, 2) }}</span></h4>
                            @else
                                <h4 class="text-center mb-4">Total: $<span id="cart-total-summary">{{ number_format($previousTotal, 2) }}</span></h4>
                            @endif

                            <a style="background-color: #021526"  href="{{ route('cart.checkout') }}" class="btn text-white btn-block">Checkout</a>
                            <a href="{{ route('welcome') }}" class="btn btn-secondary btn-block mt-2">Shop More</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center">Your cart is empty.</p>
        @endif
    </div>
    @push('styles')
        <style>
            .card-img {
                object-fit: cover;
                height: 150px;
                width: 100%;
            }
            .btn-outline-secondary {
                border-color: #6c757d;
                color: #6c757d;
            }
            .btn-outline-secondary:hover {
                background-color: #6c757d;
                color: #fff;
            }
            .btn-secondary {
                background-color: #6c757d;
                border-color: #6c757d;
            }
            .btn-secondary:hover {
                background-color: #5a6268;
                border-color: #545b62;
            }
            .card-body {
                padding: 1.25rem;
            }
            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
            }
            .btn-primary:hover {
                background-color: #0056b3;
                border-color: #004085;
            }
        </style>
    @endpush
@endsection
