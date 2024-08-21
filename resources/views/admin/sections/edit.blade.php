@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Section</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('admin.sections.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $welcomeSection->title }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="5" required>{{ $welcomeSection->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Section</button>
        </form>
    </div>
@endsection
