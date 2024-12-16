@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="color: #021526" class="h3  font-weight-bold">Add New Carousel Image</h1>
        <a style="background-color: #021526" href="{{ route('admin.carousel.index') }}" class="btn text-white">
            <i class="fas fa-arrow-left"></i> Back to Carousel Management
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image_path" class="font-weight-bold">Upload Image</label>
                    <input type="file" name="image_path" class="form-control-file" required>
                    <small class="form-text text-muted">Accepted formats: jpeg, png, jpg, gif, svg. Max size: 2MB.</small>
                </div>
                
                <div class="form-group">
                    <label for="title" class="font-weight-bold">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter title (optional)">
                </div>
                
                <div class="form-group">
                    <label for="description" class="font-weight-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter description (optional)"></textarea>
                </div>
                
                <div class="text-right">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Add Image
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
