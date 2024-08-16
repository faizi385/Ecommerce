@extends('layouts.admin')

@section('content')
    @if (auth()->user()->hasRole('Admin'))
        <div id="admin-panel" class="d-flex">
            <!-- Sidebar -->
            <nav id="sidebar" class="bg-dark text-white">
                <div class="sidebar-header">
                    <h3>Admin Panel</h3>
                </div>
                <ul class="list-unstyled components">
                    <li>
                        <a href="{{ route('dashboard') }}" class="text-white">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" class="text-white">Manage Products</a>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}" class="text-white">Manage Orders</a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="text-white">Manage Users</a>
                    </li>
                    <li>
                        <a href="{{ route('welcome') }}" class="text-white">View Store</a>
                    </li>
                    <li style="margin-top: 280px" class="">
                        <a href="{{ route('logout') }}" class="text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- Page Content -->
            <div id="content" class="p-4">
                <h1 class="mb-4">Welcome to Your Admin Dashboard</h1>
                
                <div class="row">
                    <!-- Card 1: Total Orders -->
                    <div class="col-md-3 mb-3">
                        <div class="card bg-light border-primary">
                            <div class="card-header bg-primary text-white">Total Orders</div>
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $totalOrders }}</h5>
                                <p class="card-text text-dark">Total number of orders placed.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 2: Total Products -->
                    <div class="col-md-3 mb-3">
                        <div class="card bg-light border-success">
                            <div class="card-header bg-success text-white">Total Products</div>
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $totalProducts }}</h5>
                                <p class="card-text text-dark">Total number of products available.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 3: Pending Orders -->
                    <div class="col-md-3 mb-3">
                        <div class="card bg-light border-warning">
                            <div class="card-header bg-warning text-dark">Pending Orders</div>
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $pendingOrders }}</h5>
                                <p class="card-text text-dark">Orders that are pending approval.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card 4: Revenue -->
                    <div class="col-md-3 mb-3">
                        <div class="card bg-light border-danger">
                            <div class="card-header bg-danger text-white">Total Revenue</div>
                            <div class="card-body">
                                <h5 class="card-title text-dark">${{ $totalRevenue }}</h5>
                                <p class="card-text text-dark">Total revenue generated from orders.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a style="background-color: #021526" href="{{ route('products.index') }}" class="btn text-white">Manage Products</a>
                    <a style="background-color: #03346E" href="{{ route('orders.index') }}" class="btn text-white">Manage Orders</a>
                    <a style="background-color: #240A34" href="{{ route('products.create') }}" class="btn text-white">Create Product</a>
                    <a style="background-color: #1B2A49" href="{{ route('users.index') }}" class="btn text-white">Manage Users</a>
                </div>
            </div>
        </div>
    @else
        <!-- Previous User View -->
        <div class="container">
            <h1>Welcome to Your Dashboard</h1>
            <a href="{{ route('cart.index') }}" class="btn btn-primary">View Cart</a>
            <a href="{{ route('checkout') }}" class="btn btn-secondary">Checkout</a>
        </div>
    @endif
@endsection
