<?php
session_start();
require 'products.php';
require_once './helpers/get_product_by_id.php';

// TODO: Display items in the cart

$items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
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
    <div class="container" style="margin-top: 70px;">
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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <?php $product = getProductById($item, $products); ?>
                        <?php if ($product): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($product['id']); ?></td>
                                <td><?php echo htmlspecialchars($product['name']); ?></td>
                                <td><?php echo htmlspecialchars($product['price']); ?></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">Unknown Product</td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <div>
            <a href="index.php"><button>Go Back</button></a>
            <a href="reset-cart.php"><button>Clear my cart</button></a>
            <a href="place_order.php"><button>Place the order</button></a>
        </div>
    </div>
</body>
</html>
