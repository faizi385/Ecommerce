@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create New Product') }}</div>

                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" id="price" name="price" class="form-control" step="0.01" value="{{ old('price') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <div class="form-group">
                                <label for="tags">Tags</label>
                                <select name="tags[]" id="tags" class="form-control" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <div class="form-group">
                                <label for="image">Product Image</label>
                                <input type="file" id="image" name="image" class="form-control">
                            </div>

                            <button style="background-color: #021526" type="submit" class="btn text-white">Create Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
