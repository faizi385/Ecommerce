<!DOCTYPE html>
<html>
<head>
    <title>Order Status Update</title>
</head>
<body>
    <h1>Hello, {{ $order->user->name }}</h1>
    <p>Your order with ID {{ $order->id }} and product name {{ $order->name }}  is now {{ $order->status }}.</p>
    <p>Thank you for shopping with us!</p>
</body>
</html>
