<?php
session_start();
// Add to cart logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    // TODO: Add product to cart (Session variable), try array_push()...
    array_push($_SESSION['cart'], $product_id);
}
// Redirect to the products browsing page
header('Location: cart.php');
