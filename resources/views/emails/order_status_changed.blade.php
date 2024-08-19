<!DOCTYPE html>
<html>
<head>
    <title>Order Status Update</title>
</head>
<body>
    <h1>Hello, {{ $order->user->name }}</h1>
    <p>Your order with ID {{ $order->id }} is now {{ $order->status }}.</p>
    <p>Thank you for shopping with us!</p>
</body>
</html>
