@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-primary font-weight-bold">Edit Carousel Image</h1>
        <a href="{{ route('admin.carousel.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Carousel Management
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.carousel.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="current_image" class="font-weight-bold">Current Image</label>
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $carousel->image_path) }}" class="img-fluid img-thumbnail" width="300" alt="Current Carousel Image">
                    </div>
                </div>

                <div class="form-group">
                    <label for="image_path" class="font-weight-bold">Replace Image</label>
                    <input type="file" name="image_path" class="form-control-file">
                    <small class="form-text text-muted">Leave blank if you don't want to change the image.</small>
                </div>

                <div class="form-group">
                    <label for="title" class="font-weight-bold">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $carousel->title }}" placeholder="Enter title (optional)">
                </div>
                
                <div class="form-group">
                    <label for="description" class="font-weight-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter description (optional)">{{ $carousel->description }}</textarea>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Update Image
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
