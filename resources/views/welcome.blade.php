@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Welcome to Our E-Commerce Store</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('products.index') }}" class="mb-4">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="Search by name" value="{{ request('search') }}">
                </div>
                <div class="form-group col-md-3">
                    <input type="number" class="form-control" name="min_price" placeholder="Min Price" value="{{ request('min_price') }}">
                </div>
                <div class="form-group col-md-3">
                    <input type="number" class="form-control" name="max_price" placeholder="Max Price" value="{{ request('max_price') }}">
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        
        

        <!-- Bootstrap Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide mb-5" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img style="height: 87vh; width: 100%; object-fit: cover;" src="{{ asset('storage/images/markus-spiske-BTKF6G-O8fU-unsplash.jpg') }}" class="d-block" alt="Slide 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>LIMITLESS</h5>
                        <p>Beyond Your Way.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img style="height: 87vh; width: 100%; object-fit: cover;" src="{{ asset('storage/images/pexels-khidir-25931061.jpg') }}" class="d-block" alt="Slide 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Explore More</h5>
                        <p>Discover new trends and collections.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img style="height: 87vh; width: 100%; object-fit: cover;" src="{{ asset('storage/images/hannah-morgan-ycVFts5Ma4s-unsplash.jpg') }}" class="d-block" alt="Slide 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Quality & Style</h5>
                        <p>Exceptional products for you.</p>
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
        
        <!-- Products Section -->
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm border-light">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="{{ $product->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">
                                Price: ${{ number_format($product->price, 2) }}<br>
                                Stock: {{ $product->stock }}<br>
                                Category: {{ $product->category->name ?? 'N/A' }}<br>
                            </p>
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-secondary add-to-cart">
                                    Add to Cart
                                    <i class="fas fa-arrow-right ml-2"></i> <!-- Arrow icon -->
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        {{-- <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div> --}}
@endsection
