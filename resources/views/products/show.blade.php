@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>
        <p><strong>Price:</strong> ${{ $product->price }}</p>
        <p><strong>Stock:</strong> {{ $product->stock }}</p>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Category:</strong> {{ $product->category ? $product->category->name : 'None' }}</p>
        <p><strong>Tags:</strong> {{ $product->tags->pluck('name')->join(', ') }}</p>

        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="width: 300px; margin-top: 10px;">
        @endif
    </div>
@endsection
