<!-- resources/views/emails/order_confirmed.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Dear {{ $order->user->name }},</p>
    <p>Your order #{{ $order->id }} has been confirmed.</p>
    <p><strong>Order Details:</strong></p>
    <p>
        <strong>Total:</strong> ${{ number_format($order->total, 2) }}<br>
        <strong>Status:</strong> {{ $order->status }}<br>
        <strong>Placed On:</strong> {{ $order->created_at->format('d-m-Y H:i:s') }}<br>
    </p>
    <p>Thank you for shopping with us!</p>
    <p>Best regards,<br>Your E-Commerce Team</p>
</body>
</html>
