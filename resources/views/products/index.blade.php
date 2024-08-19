@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Products</h1>
        
        <!-- Button to Create a New Product -->
        @if (auth()->user() && auth()->user()->hasRole('Admin'))
            <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Create New Product</a>
        @endif

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                        <div class="card border-light shadow-sm">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="object-fit: cover; height: 200px;">
                            @else
                                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Placeholder Image" style="object-fit: cover; height: 200px;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title" style="color: black;">{{ $product->name }}</h5>
                                <p class="card-text" style="color: black;">
                                    <strong>Price:</strong> ${{ number_format($product->price, 2) }}<br>
                                    {{-- <strong>Stock:</strong> {{ $product->stock }}<br> --}}
                                    <strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}<br>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        {{-- <button type="submit" class="btn btn-secondary add-to-cart">
                                            Add to Cart
                                            <i class="fas fa-shopping-cart ml-2"></i>
                                        </button> --}}
                                    </form>
                                    @if (auth()->user() && auth()->user()->hasRole('Admin'))
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection
