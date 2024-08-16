@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Your Orders</h1>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($orders->isEmpty())
            <div class="alert alert-info">
                You have no orders.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Status</th>
                            <th>Total</th>
                            {{-- <th>Products</th> --}}
                            @if (auth()->user()->hasRole('Admin'))
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>
                                    @if ($order->status === 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif ($order->status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif ($order->status === 'canceled')
                                        <span class="badge bg-danger">Canceled</span>
                                    @else
                                        <span class="badge bg-secondary">Unknown</span>
                                    @endif
                                </td>
                                <td>${{ $order->total }}</td>
                                {{-- <td>
                                    @foreach ($order->items as $item)
                                        <div>{{ $item->product->name }} ({{ $item->quantity }})</div>
                                    @endforeach
                                </td> --}}
                                @if (auth()->user()->hasRole('Admin'))
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">View Details</a>
                                        @if ($order->status === 'pending')
                                            <form action="{{ route('orders.update', $order->id) }}" method="POST" class="form-inline d-inline">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="approved" {{ $order->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                                        <option value="canceled" {{ $order->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                                                    </select>
                                                </div>
                                            </form>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
