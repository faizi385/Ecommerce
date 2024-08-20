@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Your Wishlist</h1>
    @if($wishlistItems->isEmpty())
        <p>Your wishlist is empty.</p>
    @else
        <div class="row">
            @foreach($wishlistItems as $item)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="{{ asset('storage/' . $item->product->image) }}" class="card-img-top" alt="{{ $item->product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->product->name }}</h5>
                            <p class="card-text">${{ number_format($item->product->price, 2) }}</p>
                            <form action="{{ route('wishlist.remove', $item->product_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove from Wishlist</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
