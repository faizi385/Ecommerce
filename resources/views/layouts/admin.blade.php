<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet"> <!-- Optional custom admin styles -->
</head>
<body>
    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script> <!-- Optional custom admin scripts -->
</body>
</html>
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
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: transparent;
            box-shadow: none;
        }

        .navbar-nav {
            flex-direction: row;
            margin: auto;
        }

        .navbar-nav.center {
            flex-grow: 1;
            justify-content: center;
        }

        .navbar-nav.right {
            margin-left: auto;
        }

        .navbar-nav .nav-link {
            margin-left: 1rem;
            margin-right: 1rem;
            padding: 0.5rem 1rem;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {
            background-image: none;
        }

        .navbar-collapse {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #000;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #007bff;
        }

        .navbar-light .navbar-brand {
            color: #000;
        }

        .navbar-light .navbar-brand:hover {
            color: #007bff;
        }

        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 300px;
            height: 100%;
            background-color: #f8f9fa;
            box-shadow: -2px 0 5px rgba(0,0,0,0.1);
            overflow-y: auto;
            z-index: 1000;
            display: none; /* Initially hidden */
            transition: transform 0.3s ease; /* Smooth transition */
            transform: translateX(100%); /* Initially off-screen */
        }

        .sidebar.active {
            display: block;
            transform: translateX(0); /* Slide in when active */
        }

        #cart-toggle {
            cursor: pointer;
        }

        /* Custom CSS for Admin Panel */
.container {
    padding: 20px;
}

.btn {
    font-size: 16px;
    font-weight: bold;
}

.btn i {
    margin-right: 8px;
}

.card {
    border: 1px solid #ddd;
    border-radius: 0.25rem;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #ddd;
}

.card-title {
    margin-bottom: 0;
}

.card-body {
    padding: 1.25rem;
    background-color: #fff;
}

.mt-4 {
    margin-top: 1.5rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

.me-2 {
    margin-right: 0.5rem !important;
}

h3 {
    font-weight: 500;
}

.bi {
    font-size: 1.2rem;
}
/* admin.css */

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

#admin-panel {
    min-height: 100vh;
}

#sidebar {
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    background-color: #343a40;
}

.sidebar-header {
    padding: 20px;
    background: #212529;
}

.sidebar-header h3 {
    margin: 0;
}

#sidebar ul.components {
    padding: 20px 0;
    list-style: none;
}

#sidebar ul.components li {
    padding: 10px;
}

#sidebar ul.components li a {
    color: #fff;
    text-decoration: none;
}

#sidebar ul.components li a:hover {
    background: #495057;
    color: #fff;
}

#content {
    margin-left: 250px;
    padding: 20px;
}
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

body {
    line-height: 1.5;
    font-family: 'Poppins', sans-serif;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container {
    max-width: 1170px;
    margin: auto;
}

.row {
    display: flex;
    flex-wrap: wrap;
}

ul {
    list-style: none;
}

.footer {
    background-color: #24262b;
    padding: 70px 0;
}

.footer-col {
    width: 25%;
    padding: 0 15px;
}

.footer-col h4 {
    font-size: 18px;
    color: #ffffff;
    text-transform: capitalize;
    margin-bottom: 35px;
    font-weight: 500;
    position: relative;
}

.footer-col h4::before {
    content: '';
    position: absolute;
    left: 0;
    bottom: -10px;
    background-color: #e91e63;
    height: 2px;
    box-sizing: border-box;
    width: 50px;
}

.footer-col ul li:not(:last-child) {
    margin-bottom: 10px;
}

.footer-col ul li a {
    font-size: 16px;
    text-transform: capitalize;
    color: #ffffff;
    text-decoration: none;
    font-weight: 300;
    color: #bbbbbb;
    display: block;
    transition: all 0.3s ease;
}

.footer-col ul li a:hover {
    color: #ffffff;
    padding-left: 8px;
}

.footer-col .social-links a {
    display: inline-block;
    height: 40px;
    width: 40px;
    background-color: rgba(255, 255, 255, 0.2);
    margin: 0 10px 10px 0;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    color: #ffffff;
    transition: all 0.5s ease;
}

.footer-col .social-links a:hover {
    color: #24262b;
    background-color: #ffffff;
}

/* Responsive */
@media (max-width: 767px) {
    .footer-col {
        width: 50%;
        margin-bottom: 30px;
    }
}

@media (max-width: 574px) {
    .footer-col {
        width: 100%;
    }
}

.card {
    height: 100%; /* Ensures card takes full height of the column */
    display: flex;
    flex-direction: column;
}

.card-img-top {
    object-fit: cover; /* Ensures the image covers the container while maintaining aspect ratio */
    width: 100%; /* Ensures the image takes the full width of the card */
    height: 200px; /* Adjust this height based on your card design */
}

.card-body {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Ensures content is spaced out evenly */
}

.card-title {
    font-size: 1.25rem; /* Adjust title size */
    margin-bottom: 0.5rem;
}

.card-text {
    flex: 1; /* Allows text to grow and fill available space */
}

.card-footer {
    text-align: center; /* Center footer content */
    padding: 1rem;
}

.card .btn {
    margin-top: 0.5rem; /* Space between buttons */
}
/* Custom CSS for Admin Dashboard Cards */
.card {
    border-radius: 0.5rem;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.card-title {
    font-size: 1.25rem;
    font-weight: bold;
}

.card-number {
    font-size: 2rem;
    font-weight: bold;
}

.card-body {
    padding: 1.5rem;
}

.card .text-dark {
    color: #333;
}

.card .text-primary {
    color: #007bff;
}

.card .text-success {
    color: #28a745;
}

.card .text-warning {
    color: #ffc107;
}

.card .text-danger {
    color: #dc3545;
}

    </style>
</head>
<body>
    {{-- <nav class="navbar navbar-expand-lg navbar-light">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img  src="{{ asset('storage/images/logo.png') }}" alt="E-Commerce Store" style="height: 200px;"> <!-- Adjust the height as needed -->
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
     --}}
    {{-- <main role="main">
        @yield('content')
    </main> --}}

    <div class="sidebar" id="cart-sidebar">
        <h5 class="p-3">Cart</h5>
        <div id="cart-contents">
            <!-- Cart items will be loaded here -->
        </div>
        <a href="{{ route('cart.index') }}" class="btn btn-primary btn-block">View Cart</a>
    </div>
    {{-- <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Our Services</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Affiliate Program</a></li>
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
                        <li><a href="#">Watch</a></li>
                        <li><a href="#">Bag</a></li>
                        <li><a href="#">Shoes</a></li>
                        <li><a href="#">Dress</a></li>
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
    </footer> --}}

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIqO52wYlOhpjsjOpn5WdbHgH7UrG6ibjlEEM5jcAbkF9aD0Xkd" crossorigin="anonymous"></script>

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
