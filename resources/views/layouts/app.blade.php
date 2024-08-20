<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My E-commerce Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img class="ml-5" src="{{ asset('storage/images/Screenshot_2024-08-17_165401-removebg-preview.png') }}" alt="E-Commerce Store" style="height: 80px;">
        </a>
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                </li>
                @if (isset($categories) && $categories->count())
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index', ['category' => $category->name]) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <ul class="navbar-nav right">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    @if (auth()->user()->hasRole('Admin'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        <!-- Your Orders Button for Regular Users Only -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">Your Orders</a>
                        </li>
                    @endif
    
                    <!-- Profile Icon and Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> <!-- Profile Icon -->
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile Settings</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="cart-toggle">
                            <i class="fas fa-shopping-cart"></i>
                            Cart
                            <span class="badge badge-secondary">
                                @if (session()->has('cart'))
                                    {{ count(session('cart')) }}
                                @else
                                    0
                                @endif
                            </span>
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    

<main role="main">
    @yield('content')
</main>

<div class="sidebar" id="cart-sidebar">
    <div class="d-flex justify-content-between align-items-center p-3">
        <h5>Cart</h5>
        <button type="button" class="btn-close" aria-label="Close" id="close-cart-sidebar"></button>
    </div>
    <div id="cart-contents">
        <!-- Cart items will be loaded here -->
    </div>
    <a style="background-color: #03346E" href="{{ route('cart.index') }}" class="btn  text-white btn-block">View Cart</a>
    <a style="background-color: #021526" href="{{ route('welcome') }}" class="btn text-white  btn-block">Shop More</a>
</div>

<footer class="footer ">
    <div class="container ">
        <div class="row ">
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Get Help</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Order Status</a></li>
                    <li><a href="#">Payment Options</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Online Shop</h4>
                <ul>
                    <li><a href="{{ route('products.index') }}">Products</a></li>
                    @if (isset($categories) && $categories->count())
                        @foreach ($categories as $category)
                            <li class="">
                                <a class="" href="{{ route('products.index', ['category' => $category->name]) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="footer-col">
                <h4>Follow Us</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIqO52wYlOhpjsjOpn5WdbHgH7UrG6ibjlEEM5jcAbkF9aD0Xkd" crossorigin="anonymous"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>

    
    
    $(document).ready(function() {
        // Initialize DataTables
        $('.table').DataTable({
            "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "pageLength": 10,
        "dom": '<"top"f>rt<"bottom"p><"clear">',
        "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search..."
        }
        });

        // Toggle cart sidebar
        $('#cart-toggle').on('click', function() {
            $('#cart-sidebar').toggleClass('active');
        });

        // Update cart contents
        function updateCart() {
            $.get('{{ route('cart.contents') }}', function(data) {
                $('#cart-contents').html(data.html);
            });
        }

        updateCart();

        // Handle Increase/Decrease Quantity
        $(document).on('click', '.adjust-quantity', function() {
            var productId = $(this).data('id');
            var action = $(this).data('action');
            var quantityInput = $(this).siblings('input');
            var currentQuantity = parseInt(quantityInput.val());
            var newQuantity = action === 'increase' ? currentQuantity + 1 : (currentQuantity > 1 ? currentQuantity - 1 : 1);

            $.ajax({
                url: `/cart/update/${productId}`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: newQuantity
                },
                success: function(response) {
                    if (response.success) {
                        quantityInput.val(newQuantity);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    console.error('AJAX Error:', xhr.responseText);
                }
            });
        });
    });
</script>
</body>
</html>
