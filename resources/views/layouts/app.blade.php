<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My E-commerce Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <style>
      

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light ">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img class="ml-5" src="{{ asset('storage/images/logo-removebg-preview.png') }}" alt="E-Commerce Store" style="height: 150px;"> <!-- Adjust the height as needed -->
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
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
    <a href="{{ route('cart.index') }}" class="btn btn-primary btn-block">View Cart</a>
</div>

    
    <footer class="footer">
        <div class="container">
            <div class="row">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartSidebar = document.getElementById('cart-sidebar');
            const closeButton = document.getElementById('close-cart-sidebar');
    
            // Function to toggle sidebar visibility
            function toggleSidebar() {
                cartSidebar.classList.toggle('show');
            }
    
            // Close button click event
            closeButton.addEventListener('click', function() {
                toggleSidebar();
            });
    
            // Optionally, add a function or event listener to open the sidebar if needed
            // For example, you might use a button with ID 'open-cart-sidebar'
            const openButton = document.getElementById('open-cart-sidebar');
            if (openButton) {
                openButton.addEventListener('click', function() {
                    toggleSidebar();
                });
            }
        });
    </script>
    
    


    <script>
        // Toggle the sidebar
        document.getElementById('cart-toggle').addEventListener('click', function() {
            document.getElementById('cart-sidebar').classList.toggle('active');
        });

        // Function to update the cart contents
        function updateCart() {
            let cartContents = document.getElementById('cart-contents');

            $.get('{{ route('cart.contents') }}', function(data) {
                cartContents.innerHTML = data.html;
            });
        }

        // Call updateCart on page load to ensure cart is updated
        $(document).ready(function() {
            updateCart();
        });

        // Optionally, update cart on AJAX success (if adding items via AJAX)
        $(document).on('ajaxComplete', function() {
            updateCart();
        });

        // Handle Increase/Decrease Quantity
        $(document).on('click', '.adjust-quantity', function() {
            var productId = $(this).data('id');
            var action = $(this).data('action');
            var quantityInput = $(this).siblings('input');
            var currentQuantity = parseInt(quantityInput.val());

            // Calculate new quantity
            var newQuantity = action === 'increase' ? currentQuantity + 1 : (currentQuantity > 1 ? currentQuantity - 1 : 1);

            // Send AJAX request to update quantity
            $.ajax({
                url: `/cart/update/${productId}`, // Use a template literal for URL
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: newQuantity
                },
                success: function(response) {
                    if (response.success) {
                        // Update quantity in the input field
                        quantityInput.val(newQuantity);
                        // Optionally update total price or other elements
                    } else {
                        alert(response.message); // Optional: handle errors or messages
                    }
                },
                error: function(xhr) {
                    console.error('AJAX Error:', xhr.responseText);
                }
            });
        });
    </script>
</body>
</html>
