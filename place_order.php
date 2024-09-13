<?php
session_start();
require 'products.php';
require_once './helpers/get_product_by_id.php';


// TODO: Save order data to orders-[ORDER_CODE].txt
$order_code =  uniqid('orders-');
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;


// Get the order from the cart (Session variable)
// Map the order Ids from the $products variable
// Compute the total
// Write the orders in a file
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Order</title>

    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
    >
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order!</p>
    <!-- TODO: Display order summary -->
</body>
</html>
