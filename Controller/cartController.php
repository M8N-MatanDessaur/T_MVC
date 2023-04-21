<?php
require_once "../autoloader.php";
session_start();
$cart = new Cart(); // Initialise Cart object
//handling the removal of a product from a user's shopping cart
if (isset($_POST['remove-from-cart'])) {
    $product_id = $_POST['product_id'];
    $cart->removeFromCart($product_id);
}
header('Location: ../View/cart.php');
?>