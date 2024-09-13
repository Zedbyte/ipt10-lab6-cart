<?php
session_start();
require 'products.php';
require_once './helpers/get_product_by_id.php';


// TODO: Save order data to orders-[ORDER_CODE].txt
$order_code =  uniqid('orders-');

// Get the order from the cart (Session variable)
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Map the order Ids from the $products variable
// Compute the total
$total = 0;

$order_details = [];
foreach ($cart as $product_id) {
    $product = getProductById($product_id, $products);
    if ($product) {
        $order_details[] = $product;
        $total += $product['price'];
    }
}

date_default_timezone_set('Etc/GMT-8');
$date_and_time = date("F j, Y, g:i a");

// Write the orders in a file
$order_filename = "orders/{$order_code}.txt";
$order_data = "Order Code: {$order_code}\n\n";
$order_data .= "Date and Time: {$date_and_time}\n\n";
$order_data .= "Product ID\tProduct Name\tPrice\n";
$order_data .= str_repeat('-', 40) . "\n";

foreach ($order_details as $product) {
    $order_data .= "{$product['id']}\t{$product['name']}\t{$product['price']}\n";
}

$order_data .= str_repeat('-', 40) . "\n";
$order_data .= "Total: {$total}\n";

// Save order data to a file
file_put_contents($order_filename, $order_data);


// Clear cart
unset($_SESSION['cart']);
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
    <div class="container" style="text-align:center; height: 100vh; display: flex; flex-direction:column; justify-content:center;">
    <h1>Order Confirmation</h1>
        <p>Thank you for your order!</p>
        <!-- TODO: Display order summary -->
        <p>Your order code is: <strong><?php echo htmlspecialchars($order_code); ?></strong></p>
        <p><?php echo $date_and_time ?></p>
        <p>Total amount: <strong><?php echo htmlspecialchars($total); ?></strong></p>

        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_details as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['id']); ?></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['price']); ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <p><a href="cart.php"><button>Return to Cart</button></a></p>
    </div>
</body>
</html>
