@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Order Details Header -->
    <div class="text-center mb-4">
        <h1 class="display-4">Order Details</h1>
    </div>
    
    <!-- Order Info -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-light mb-3">
                <div class="card-body">
                    <h5 class="card-title">Order ID</h5>
                    <p class="card-text">{{ $order->id }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-light mb-3">
                <div class="card-body">
                    <h5 class="card-title">Status</h5>
                    @if ($order->status === 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif ($order->status === 'approved')
                        <span class="badge bg-success">Approved</span>
                    @elseif ($order->status === 'canceled')
                        <span class="badge bg-danger">Canceled</span>
                    @else
                        <span class="badge bg-secondary">Unknown</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-light mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total</h5>
                    <p class="card-text">${{ number_format($order->total, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-light mb-3">
                <div class="card-body">
                    <h5 class="card-title">Product Name</h5>
                    <p class="card-text">Character Graphic T-Shirt</p>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row mb-4">
        <div class="col-md-6">
            <div class="card-k shadow-sm border-light mb-3">
                <div class="card-body">
                    <h5 class="card-title">Price</h5>
                    <p class="card-text">${{ number_format($order->price, 2) }}</p>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Back Button -->
    <div class="text-center">
        <a style="background-color: #021526" href="{{ route('orders.index') }}" class="btn text-white  btn-lg">Back to Orders</a>
    </div>
</div>
@endsection
