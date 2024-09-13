<?php
session_start();
// Clear the cart
$_SESSION['cart'] = [];
// Redirect to the products browsing page
header('Location: index.php');
