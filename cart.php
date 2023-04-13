<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>T&nbsp;&nbsp;|&nbsp;&nbsp;Cart</title>
    <link rel="stylesheet" href="./assets/styles/style.css">
</head>

<?php
ini_set('display_errors', 0);
include('./includes/includes.php');
session_start();

if (isset($_SESSION['user'])) {
    $cart = new Cart();

    //handling the removal of a product from a user's shopping cart
    if (isset($_POST['remove-from-cart'])) {
        $product_id = $_POST['product_id'];
        $cart->removeFromCart($product_id);
    }
}
// if user isn't connected, send user to login
else {
    header('Location: ./login.php');
}

?>

<body>
    <?php include('./views/Identification.php') ?>
    <section class="page-layout">
        <?php include('./views/Sidebar.php') ?>
        <?php include('./views/cartcontainer.php') ?>
    </section>
</body>

</html>