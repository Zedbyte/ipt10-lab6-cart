<?php
session_start();
require 'products.php';
require_once './helpers/get_product_by_id.php';


// TODO: Display items in the cart

$items = $_SESSION['cart'];

//Set (Remove Duplicates)
$unique_items = array_combine($items, $items);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>

    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
    >
</head>
<body>
<h1>Your Cart</h1>
    <?php if (empty($items)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($unique_items as $unique_item): ?>
                    <?php 
                    $product = getProductById($unique_item, $products); 
                    $quantity = array_count_values($items);
                    ?>
                    <?php if ($product): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['id']); ?></td>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td><?php echo htmlspecialchars($product['price']); ?></td>
                            <td><?php echo htmlspecialchars($quantity[$product]); ?></td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Unknown Product</td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>


    <a href="reset-cart.php">Clear my cart</a>
    <a href="place_order.php">Place the order</a>
</body>
</html>
