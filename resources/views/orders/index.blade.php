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
                                <td>${{ $order->total }}</td>
                                {{-- <td>
                                    @foreach ($order->items as $item)
                                        <div>{{ $item->product->name }} ({{ $item->quantity }})</div>
                                    @endforeach
                                </td> --}}
                                @if (auth()->user()->hasRole('Admin'))
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">View Details</a>
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
@endsection
