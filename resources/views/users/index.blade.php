<!-- resources/views/users/index.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">Manage Users</h1>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->roles as $role)
                                {{ $role->name }}
                            @endforeach
                        </td>
                        <td>
                            <!-- Actions like Edit or Delete can be added here -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
