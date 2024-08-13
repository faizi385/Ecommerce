<form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="payment_receipt">
    <button type="submit">Place Order</button>
</form>
