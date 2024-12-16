@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="color: #021526" class="h3  font-weight-bold">Manage Carousel</h1>
        <a style="background-color: #021526" href="{{ route('admin.carousel.create') }}" class="btn text-white ">
            <i class="fas fa-plus"></i> Add New Image
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carousels as $carousel)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $carousel->image_path) }}" class="img-thumbnail" width="100" alt="Carousel Image">
                        </td>
                        <td>{{ $carousel->title }}</td>
                        <td>{{ $carousel->description }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.carousel.edit', $carousel->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.carousel.delete', $carousel->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
