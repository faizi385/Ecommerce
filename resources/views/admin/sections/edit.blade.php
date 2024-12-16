@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg mt-4">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <i class="fas fa-edit fa-2x mr-3"></i>
                        <h3 class="mb-0">Edit Section</h3>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{ route('admin.sections.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="font-weight-bold">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $welcomeSection->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description" class="font-weight-bold">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="5" required>{{ $welcomeSection->description }}</textarea>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-save"></i> Update Section
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .card-header {
        background-image: linear-gradient(120deg, #3498db, #8e44ad);
        border-bottom: 3px solid #2980b9;
    }

    .card-body {
        background-color: #f7f9fa;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .form-control {
        border-radius: 0.25rem;
    }

    label.font-weight-bold {
        font-weight: 600;
        color: #555;
    }

    .alert {
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.alert').delay(3000).slideUp(300);
    });
</script>
@endsection
