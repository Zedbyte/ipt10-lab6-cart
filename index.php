<?php
session_start();
require 'products.php';
// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>

    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
    >
</head>
<body>
    <h1>Products</h1>
    <ul class="container">
        <?php foreach ($products as $product): ?>
            <li>
                <?php echo $product['name']; ?> - <?php echo $product['price']; ?> PHP
                <form method="post" action="add-to-cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit">Add to Cart</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="cart.php">View Cart</a>
</body>
</html>
