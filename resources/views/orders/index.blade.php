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

   <!-- Filter Form -->
 
<form method="GET" action="{{ route('orders.index') }}" class="mb-1">
<div class="d-flex justify-content-end mb-2">
    <div class="form-group">
        <select name="status" id="status" class="form-control" onchange="this.form.submit()">
            <option value="">-- Select Status --</option>
            <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="processing" {{ $status === 'processing' ? 'selected' : '' }}>Processing</option>
            <option value="shipped" {{ $status === 'shipped' ? 'selected' : '' }}>Shipped</option>
            <option value="delivered" {{ $status === 'delivered' ? 'selected' : '' }}>Delivered</option>
            <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="canceled" {{ $status === 'canceled' ? 'selected' : '' }}>Canceled</option>
        </select>
    </div>
</div>
</form>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>User ID</th>
                            <th>Products</th>
                            <th>Total</th>
                            <th>Status</th>
                            @if (auth()->user()->hasRole('Admin'))
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->user_id }}</td>
                                <td>{{ $order->name }}</td> <!-- Display concatenated product names -->
                                <td>${{ number_format($order->total, 2) }}</td>
                                <td>
                                    @if ($order->status === 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif ($order->status === 'processing')
                                        <span class="badge bg-primary">Processing</span>
                                    @elseif ($order->status === 'shipped')
                                        <span class="badge bg-info text-dark">Shipped</span>
                                    @elseif ($order->status === 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                    @elseif ($order->status === 'canceled')
                                        <span class="badge bg-danger">Canceled</span>
                                    @else
                                        <span class="badge bg-secondary">Unknown</span>
                                    @endif
                                </td>
                                @if (auth()->user()->hasRole('Admin'))
                                    <td>
                                        @if (in_array($order->status, ['pending', 'processing', 'shipped']))
                                            <form action="{{ route('orders.update', $order->id) }}" method="POST" class="form-inline d-inline">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <select name="status" class="form-control form-control-sm" onchange="handleStatusChange(event, '{{ $order->id }}')">
                                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
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

    <!-- JavaScript to handle SweetAlert -->
    <script>
        function handleStatusChange(event, orderId) {
            event.preventDefault();
            
            const form = event.target.closest('form');
            const newStatus = event.target.value;
            const statusText = event.target.options[event.target.selectedIndex].text;

            Swal.fire({
                title: 'Are you sure?',
                text: `Do you want to change the status to ${statusText}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>

    <style>
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table thead th {
            background-color: #343a40;
            color: #fff;
            font-weight: bold;
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.5em 1em;
        }

        .form-control-sm {
            height: calc(1.5em + .75rem + 2px);
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
@endsection
