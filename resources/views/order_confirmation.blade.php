<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Dear {{ $order->billingAddress->first_name }} {{ $order->billingAddress->last_name }},</p>
    
    <p>Your order with order ID #{{ $order->id }} has been confirmed. Here are the order details:</p>

    <ul>
        @foreach($order->orderDetails as $orderDetail)
            <li>
                {{ $orderDetail->name }} - Quantity: {{ $orderDetail->qty }} - Total Price: ${{ $orderDetail->total_price }}
            </li>
        @endforeach
    </ul>

    <p>Total Amount: ${{ $order->paymentMethod->total_price }}</p>
    
    <p>Thank you for shopping with us!</p>
</body>
</html>
