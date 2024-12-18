@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Product Details Section -->
        <h1 class="text-center mb-4">{{ $product->name }}</h1>
        <div class="row">
            <div class="col-lg-6 mb-4">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/600x400" class="img-fluid" alt="{{ $product->name }}">
                @endif
            </div>
            <div class="col-lg-6">
                <h2 class="mb-3">Details</h2>
                <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
                <p><strong>Description:</strong> Elevate your wardrobe with our Classic Cotton Shirt, designed for both comfort and style. Crafted from 100% premium cotton, this shirt offers a soft, breathable feel perfect for everyday wear. The timeless design features a tailored fit, a crisp collar, and button-down closure for a polished look. Available in a variety of colors, this versatile shirt is ideal for both casual and semi-formal occasions. Whether paired with jeans for a relaxed vibe or with chinos for a more refined appearance, the Classic Cotton Shirt is a staple piece that combines elegance with practicality.</p>
                
                <!-- Add Color Selection -->
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                    @csrf

                    <div class="form-group">
                        <label for="size">Size:</label>
                        <select name="size" id="size" class="form-control">
                            <option value="S">S</option>
                            <option value="M" selected>M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>

                    <!-- Color Selection -->
                    <div class="form-group">
                        <label>Color:</label>
                        <div class="d-flex">
                            <!-- Black Color -->
                            <label class="color-option mr-3">
                                <input type="radio" name="color" value="Black" class="d-none">
                                <span class="color-circle" style="background-color: black;"></span>
                            </label>

                            <!-- White Color -->
                            <label class="color-option">
                                <input type="radio" name="color" value="White" class="d-none">
                                <span class="color-circle" style="background-color: rgb(198, 209, 37);"> </span>
                            </label>
                        </div>
                    </div>

                    <!-- Add to Cart Button -->
                    <button type="submit" class="btn btn-custom mt-3">
                        Add to Cart
                        <i class="fas fa-arrow-right ml-2"></i> <!-- Arrow icon -->
                    </button>
                </form>

                <!-- Add to Wishlist Button -->
                <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">
                        Add to Wishlist
                        <i style="color:red " class="fas fa-heart ml-2"></i> <!-- Heart icon -->
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

<!-- Styles for color selection -->
<style>
    .color-option {
        cursor: pointer;
    }

    .color-circle {
        display: inline-block;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 2px solid transparent;
    }

    .color-option input:checked + .color-circle {
        border: 2px solid #007bff;
    }
</style>
