@extends('layouts.admin')

@section('content')
    @if (auth()->user()->hasRole('Admin'))
        <div id="admin-panel" class="d-flex">
            <!-- Sidebar -->
            <nav id="sidebar" class=" text-white">
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
                    <li>
                        <a href="#sections" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-white">Sections</a>
                        <ul class="collapse list-unstyled" id="sections">
                            <li>
                                <a href="{{ route('admin.sections.edit') }}" class="text-white">Edit Homepage Section</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.carousel.index') }}" class="text-white">Manage Carousel Images</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="mt-auto">
                        <a href="{{ route('logout') }}" class="text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- Page Content -->
            <div id="content" class="p-4 flex-grow-1">
                <!-- Dark/Light Mode Toggle -->
                <div class="d-flex justify-content-end mb-4">
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" id="theme-toggle" onclick="toggleTheme()">
                        <label class="form-check-label" for="theme-toggle">
                            <i id="theme-icon" class="fas fa-sun"></i>
                        </label>
                    </div>
                </div>

                <h1 class="mb-4">Welcome to Your Admin Dashboard</h1>

                <div class="row mb-4">
                    <!-- Card 1: Total Orders -->
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('orders.index') }}" class="text-decoration-none">
                            <div class="card bg-light border-primary d-flex align-items-center">
                                <div class="card-body text-center">
                                    <h4 class="card-title text-primary">Total Orders</h4>
                                    <i class="fas fa-box-open fa-2x mb-2 text-primary"></i>
                                    <h5 class="card-number text-dark">{{ $totalOrders }}</h5>
                                    <p class="card-text text-dark">Total number of orders placed.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Card 2: Total Products -->
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('products.index') }}" class="text-decoration-none">
                            <div class="card bg-light border-success d-flex align-items-center">
                                <div class="card-body text-center">
                                    <h4 class="card-title text-success">Total Products</h4>
                                    <i class="fas fa-cube fa-2x mb-2 text-success"></i>
                                    <h5 class="card-number text-dark">{{ $totalProducts }}</h5>
                                    <p class="card-text text-dark">Total number of products available.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Card 3: Pending Orders -->
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('orders.index') }}" class="text-decoration-none">
                            <div class="card bg-light border-warning d-flex align-items-center">
                                <div class="card-body text-center">
                                    <h4 class="card-title text-warning">Pending Orders</h4>
                                    <i class="fas fa-clock fa-2x mb-2 text-warning"></i>
                                    <h5 class="card-number text-dark">{{ $pendingOrders }}</h5>
                                    <p class="card-text text-dark">Orders that are pending approval.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Card 4: Revenue -->
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('orders.index') }}" class="text-decoration-none">
                            <div class="card bg-light border-danger d-flex align-items-center">
                                <div class="card-body text-center">
                                    <h4 class="card-title text-danger">Total Revenue</h4>
                                    <i class="fas fa-dollar-sign fa-2x mb-2 text-danger"></i>
                                    <h5 class="card-number text-dark">${{ $totalRevenue }}</h5>
                                    <p class="card-text text-dark">Total revenue generated from orders.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

               <!-- Chart and Notifications Container -->
               <div class="container-fluid">
                <div class="row">
                    <!-- Chart Container -->
                    <div class="col-md-8 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 style="color: #021526" class="m-0 font-weight-bold ">Sales Overview</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="salesChart" width="300" height="150"></canvas> <!-- Adjusted canvas size -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Notifications Container -->
                    <div class="col-md-4 mb-4">
                        <div class="card shadow mb-4">
                            <div style="background-color: #021526"  class="card-header py-3  text-white">
                                <h6 class="m-0 font-weight-bold">Notifications</h6>
                            </div>
                            <div class="card-body p-3 bg-light">
                                <div class="notification">
                                    <div class="d-flex align-items-center mb-3">
                                        <div  style="background-color: #021526" class="icon text-white rounded-circle p-2 mr-3">
                                            <i class="fas fa-tshirt"></i>
                                        </div>
                                        <div class="text">
                                            <span class="font-weight-bold">Faizan</span> purchased a <span class="text-primary">shirt</span>.
                                        </div>
                                    </div>
                                </div>
                                <div class="notification">
                                    <div class="d-flex align-items-center mb-3">
                                        <div style="background-color: #021526"  class="icon text-white rounded-circle p-2 mr-3">
                                            <i class="fas fa-tshirt"></i>
                                        </div>
                                        <div class="text">
                                            <span class="font-weight-bold">Umar</span> added a <span class="text-primary">shirt</span> to wishlist.
                                        </div>
                                    </div>
                                </div>
                                <div class="notification">
                                    <div class="d-flex align-items-center mb-3">
                                        <div style="background-color: #021526" class="icon  text-white rounded-circle p-2 mr-3">
                                            <i class="fas fa-tshirt"></i>
                                        </div>
                                        <div class="text">
                                            <span class="font-weight-bold">Sara</span> added a <span class="text-primary">jacket</span> to cart.
                                        </div>
                                    </div>
                                </div>
                                <div class="notification">
                                    <div class="d-flex align-items-center mb-3">
                                        <div style="background-color: #021526" class="icon text-white rounded-circle p-2 mr-3">
                                            <i class="fas fa-tshirt"></i>
                                        </div>
                                        <div class="text">
                                            <span class="font-weight-bold">Ali</span> completed the purchase of a <span class="text-primary">hat</span>.
                                        </div>
                                    </div>
                                </div>
                                <!-- Add more notifications as needed -->
                            </div>
                        </div>
                    </div>
                </div>
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
<style>

    /* Admin Panel Styles */
    #sidebar {
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        z-index: 100;
    }

    #content {
        margin-left: 250px;
        padding: 20px;
        flex-grow: 1;
    }

    .card {
        border-radius: 10px;
    }

    .card-body {
        padding: 20px;
    }

    /* Dark Mode Styles */
    .dark-mode {
        background-color: black;
        color: #ffffff;
    }

    .dark-mode .card {
        background-color: #495057;
        border-color: #6c757d;
    }

    .dark-mode .card-title {
        color: #ffffff;
    }

    .dark-mode .card-text {
        color: #e9ecef;
    }

    .chart-container {
        position: relative;
        height: 400px; /* Adjust height as needed */
        width: 80%; /* Adjust width as needed */
    }

    /* Optional: Adjust the chart itself */
    #salesChart {
        max-height: 400px; /* Ensure the chart does not exceed this height */
    }

    .notification {
        border-bottom: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }
    
    .notification:last-child {
        border-bottom: none;
    }
    
    .icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .text {
        flex: 1;
    }


</style>
@section('styles')
<style>
    .notification {
        border-bottom: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }
    
    .notification:last-child {
        border-bottom: none;
    }
    
    .icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .text {
        flex: 1;
    }
    
    .text-primary {
        color: #007bff;
    }
    
    .bg-success {
        background-color: #28a745 !important;
    }
    
    .bg-warning {
        background-color: #ffc107 !important;
    }
    
    .bg-primary {
        background-color: #007bff !important;
    }
    
    .card-header.bg-info {
        background-color: #17a2b8 !important;
    }
</style>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('salesChart').getContext('2d');

    // Create gradient
    var gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(75, 192, 192, 0.2)');
    gradient.addColorStop(1, 'rgba(75, 192, 192, 1)');

    var salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($salesData['labels']),
            datasets: [{
                label: 'Sales',
                data: @json($salesData['values']),
                backgroundColor: gradient,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            // Chart options
        }
    });
});
</script>

    
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($salesData['labels']),
            datasets: [{
                label: 'Sales',
                data: @json($salesData['values']),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += context.parsed.y;
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
});
    function toggleTheme() {
        document.body.classList.toggle('dark-mode');
        var themeIcon = document.getElementById('theme-icon');
        if (document.body.classList.contains('dark-mode')) {
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
        } else {
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        }
    }
</script>