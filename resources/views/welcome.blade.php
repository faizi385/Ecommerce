@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Welcome Heading -->
        <h1 class="text-center mb-2 animated-heading" style="font-style: italic">Welcome to Our E-Commerce Store</h1>
     <!-- About Us Section -->
     <p class="text-center mb-5" style="font-style: italic; color: #555;">
        Discover our passion for quality and service as we bring you a curated <br> selection of products to enhance your shopping experience.
    </p>
<!-- Search Form -->
<div class="search-form-container mb-5">
    <form method="GET" action="{{ route('products.index') }}">
        <div class="form-row">
            <div class="form-group mb-2">
                <input type="text" class="form-control search-input" name="search" placeholder="Search" value="{{ request('search') }}">
            </div>
            <div class="form-group mb-2">
                <button type="submit" class="btn btn-custom w-100">Search</button>
            </div>
        </div>
    </form>
</div>




        
        <!-- Bootstrap Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide mb-3" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img style="height: 60vh; width: 100%; object-fit: cover;" src="{{ asset('storage/images/markus-spiske-BTKF6G-O8fU-unsplash.jpg') }}" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="display-4">LIMITLESS</h5>
                        <p class="lead">Beyond Your Way.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img style="height: 60vh; width: 100%; object-fit: cover;" src="{{ asset('storage/images/pexels-khidir-25931061.jpg') }}" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="display-4">Explore More</h5>
                        <p class="lead">Discover new trends and collections.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img style="height: 60vh; width: 100%; object-fit: cover;" src="{{ asset('storage/images/hannah-morgan-ycVFts5Ma4s-unsplash.jpg') }}" class="d-block w-100" alt="Slide 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="display-4">Quality & Style</h5>
                        <p class="lead">Exceptional products for you.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
<!-- Trust Bar Section -->
<div style="background-color: #24262b;" class="trust-bar py-4  text-center mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5 class="font-weight-bold text-white">50 Million+</h5>
                <p class="mb-0 text-white">Products Sold</p>
            </div>
            <div class="col-md-3">
                <h5 class="font-weight-bold text-white">★★★★☆</h5>
                <p class="mb-0 text-white">Trustpilot +100k Reviews</p>
            </div>
            <div class="col-md-3">
                <h5 class="font-weight-bold text-white">Award-Winning</h5>
                <p class="mb-0 text-white">Customer Service</p>
            </div>
            <div class="col-md-3">
                <h5 class="font-weight-bold text-white">30-Day</h5>
                <p class="mb-0 text-white">Peace of Mind Returns</p>
            </div>
        </div>
    </div>
</div>


        <!-- Categories Section -->
        <h2 style="font-style: italic" class="text-center mb-4 animated-heading-slide">Shop by Category</h2>
        <div class="row mb-5">
            <div class="col-md-4 mb-4 d-flex justify-content-center">
                <a href="{{ route('products.index', ['category' => 'men']) }}" class="text-decoration-none">
                    <div class="card text-center shadow border-light" style="width: 18rem;">
                        <img src="{{ asset('storage/images/F0112101711M_3.jpg') }}" class="card-img-top" alt="Men's Category">
                        <div class="card-body">
                            <h5 style="color: black;" class="card-title">Men's</h5>
                            <p style="color: black;" class="card-text">Explore our collection of men's fashion and accessories.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4 d-flex justify-content-center">
                <a href="{{ route('products.index', ['category' => 'women']) }}" class="text-decoration-none">
                    <div class="card text-center shadow border-light" style="width: 18rem;">
                        <img src="{{ asset('storage/images/F0109202507M_2.jpg') }}" class="card-img-top" alt="Women's Category">
                        <div class="card-body">
                            <h5 style="color: black;" class="card-title">Women's</h5>
                            <p style="color: black;"  class="card-text">Discover the latest trends in women's fashion and more.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4 d-flex justify-content-center">
                <a href="{{ route('products.index', ['category' => 'kids']) }}" class="text-decoration-none">
                    <div class="card text-center shadow border-light" style="width: 18rem;">
                        <img src="{{ asset('storage/images/F0202308128.jpg') }}" class="card-img-top" alt="Kids' Category">
                        <div class="card-body">
                            <h5 style="color: black;" class="card-title">Kids'</h5>
                            <p style="color: black;" class="card-text">Find charming clothes and accessories for kids.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        
<!-- Our Services Section -->
<h2 class="text-center mb-5 animated-heading" style="font-style: italic; color: #333;">Our Services</h2>
<div class="container">
    <div class="row">
        <!-- Fast Delivery Service -->
        <div class="col-md-4 mb-4">
            <div class="service-card text-center shadow border-light p-4">
                <div class="service-icon mb-3">
                    <i style="color: #24262b" class="fas fa-truck fa-3x"></i>
                </div>
                <h4  class="service-title mb-3">Fast Delivery</h4>
                <p class="service-description">We offer speedy delivery to ensure you get your products on time.</p>
            </div>
        </div>
        <!-- Quality Products Service -->
        <div class="col-md-4 mb-4">
            <div class="service-card text-center shadow border-light p-4">
                <div class="service-icon mb-3">
                    <i style="color: #24262b" class="fas fa-certificate fa-3x"></i>
                </div>
                <h4 class="service-title mb-3">Quality Products</h4>
                <p class="service-description">Our products are sourced from top-quality manufacturers to ensure you get the best.</p>
            </div>
        </div>
        <!-- Customer Support Service -->
        <div class="col-md-4 mb-4">
            <div class="service-card text-center shadow border-light p-4">
                <div class="service-icon mb-3">
                    <i style="color: #24262b" class="fas fa-headset fa-3x"></i>
                </div>
                <h4 class="service-title mb-3">Customer Support</h4>
                <p class="service-description">Our support team is here to help you with any inquiries or issues you might have.</p>
            </div>
        </div>
    </div>
</div>
        <!-- Featured Products Section -->
        <h2 style="font-style: italic animated-heading" class="text-center mb-4">Featured Products</h2>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-4 mb-4">
                    <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                        <div class="card shadow border-light">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="{{ $product->name }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">
                                    Price: <span class="font-weight-bold">${{ number_format($product->price, 2) }}</span><br>
                                    {{-- Stock: {{ $product->stock }}<br> --}}
                                    Category: {{ $product->category->name ?? 'N/A' }}<br>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
<!-- Testimonials Section -->
<h2 class="text-center mb-5 mt-5 animated-heading" style="font-style: italic; color: #333;">What Our Customers Say</h2>
<div class="container">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="testimonial-card shadow border-light">
                <div class="testimonial-header">
                    <img src="{{ asset('storage/images/testimonial-edward.png') }}" class="testimonial-img" alt="Jane Doe">
                </div>
                <div class="testimonial-body">
                    <p class="testimonial-text">"This is the best online store I've ever used. The quality of the products is outstanding and the customer service is top-notch!"</p>
                    <footer class="testimonial-footer">
                        <p class="customer-name">Jane Doe</p>
                        <p class="customer-role">Regular Customer</p>
                    </footer>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="testimonial-card shadow border-light">
                <div class="testimonial-header">
                    <img src="{{ asset('storage/images/Matt-T-Testimonial-pic.jpg') }}" class="testimonial-img" alt="John Smith">
                </div>
                <div class="testimonial-body">
                    <p class="testimonial-text">"I am very impressed with the fast shipping and the wide variety of products available. Highly recommend!"</p>
                    <footer class="testimonial-footer">
                        <p class="customer-name">John Smith</p>
                        <p class="customer-role">Frequent Buyer</p>
                    </footer>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="testimonial-card shadow border-light">
                <div class="testimonial-header">
                    <img src="{{ asset('storage/images/depositphotos_420021494-stock-photo-portrait-female-owner-gift-store.jpg') }}" class="testimonial-img" alt="Emily Davis">
                </div>
                <div class="testimonial-body">
                    <p class="testimonial-text">"Exceptional service and great <br> prices! I always find what I need and the wide variety of products available. Highly recommend!"</p>
                    <footer class="testimonial-footer">
                        <p class="customer-name">Emily Davis</p>
                        <p class="customer-role">Happy Shopper</p>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</div>



        <!-- Pagination -->
        {{-- <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-4') }}
        </div> --}}
        
    </div>
@endsection
{{-- 
  <!-- Categories Section -->
  <h2 style="font-style: italic" class="text-center mb-4 animated-heading-slide">Shop by Category</h2>

  <div class="category-tabs text-center mb-4">
      <ul class="nav nav-tabs justify-content-center">
          <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#everyday">Men</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#travel">Women</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#lounging">Kids</a>
          </li>
      </ul>
  </div>

  <div class="tab-content">
      <div id="everyday" class="container tab-pane active">
          <div class="row">
              <div class="col-md-4 mb-4 d-flex justify-content-center">
                  <a href="{{ route('products.index', ['category' => 'men']) }}" class="text-decoration-none">
                      <div class="card text-center shadow border-light">
                          <img src="{{ asset('storage/images/F0112101711M_3.jpg') }}" class="card-img-top" alt="Men's Category">
                          <div class="card-body">
                              <h5 style="color: black;" class="card-title">Men's</h5>
                              <p style="color: black;" class="card-text">Explore our collection of men's fashion and accessories.</p>
                          </div>
                      </div>
                  </a>
              </div>
          </div>
      </div>

      <div id="travel" class="container tab-pane fade">
          <div class="row">
              <div class="col-md-4 mb-4 d-flex justify-content-center">
                  <a href="{{ route('products.index', ['category' => 'women']) }}" class="text-decoration-none">
                      <div class="card text-center shadow border-light">
                          <img src="{{ asset('storage/images/F0109202507M_2.jpg') }}" class="card-img-top" alt="Women's Category">
                          <div class="card-body">
                              <h5 style="color: black;" class="card-title">Women's</h5>
                              <p style="color: black;" class="card-text">Discover the latest trends in women's fashion and more.</p>
                          </div>
                      </div>
                  </a>
              </div>
          </div>
      </div>

      <div id="lounging" class="container tab-pane fade">
          <div class="row">
              <div class="col-md-4 mb-4 d-flex justify-content-center">
                  <a href="{{ route('products.index', ['category' => 'kids']) }}" class="text-decoration-none">
                      <div class="card text-center shadow border-light">
                          <img src="{{ asset('storage/images/F0202308128.jpg') }}" class="card-img-top" alt="Kids' Category">
                          <div class="card-body">
                              <h5 style="color: black;" class="card-title">Kids'</h5>
                              <p style="color: black;" class="card-text">Find charming clothes and accessories for kids.</p>
                          </div>
                      </div>
                  </a>
              </div>
          </div>
      </div>
  </div> --}}