@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Shopping Cart</h1>

        @if ($cart && count($cart) > 0)
            <div class="row">
                <!-- Order Details Column -->
                <div class="col-md-8">
                    @foreach ($cart as $id => $item)
                        <div class="card mb-4">
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
                                            <button type="submit" class="btn btn-danger">Remove from Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Total Price Column -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center mb-4">Cart Summary</h3>
                            <p class="card-text">Total Items: <span id="cart-total-items">{{ count($cart) }}</span></p>
                            <h4 class="text-center mb-4">Total: $<span id="cart-total-summary">{{ number_format(array_sum(array_map(function($item) {
                                return $item['price'] * $item['quantity'];
                            }, $cart)), 2) }}</span></h4>
                            <a href="{{ route('checkout') }}" class="btn btn-primary btn-block">Checkout</a>
                            <a href="{{ route('welcome') }}" class="btn btn-secondary btn-block mt-2">Shop More</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center">Your cart is empty.</p>
        @endif
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const updateCartTotal = () => {
                    let total = 0;
                    let totalItems = 0;
                    document.querySelectorAll('.card').forEach(card => {
                        const price = parseFloat(card.querySelector('.price').getAttribute('data-price'));
                        const quantity = parseInt(card.querySelector('.quantity').value);
                        const totalPriceElement = card.querySelector('.total-price');
                        const itemTotal = price * quantity;
                        totalPriceElement.innerText = itemTotal.toFixed(2);
                        total += itemTotal;
                        totalItems += quantity;
                    });
                    document.getElementById('cart-total-summary').innerText = total.toFixed(2);
                    document.getElementById('cart-total-items').innerText = totalItems;
                };

                const updateQuantity = (id, quantity) => {
                    fetch(`/cart/update/${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ quantity })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateCartTotal();
                        } else {
                            console.error('Failed to update cart.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                };

                document.querySelectorAll('.adjust-quantity').forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        const action = this.getAttribute('data-action');
                        const quantityInput = this.closest('.card').querySelector('.quantity');
                        let quantity = parseInt(quantityInput.value);

                        if (action === 'increase') {
                            quantity++;
                        } else if (action === 'decrease' && quantity > 1) {
                            quantity--;
                        }

                        quantityInput.value = quantity;

                        updateCartTotal();
                        updateQuantity(id, quantity);
                    });
                });

                updateCartTotal();
            });
        </script>
    @endpush

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
