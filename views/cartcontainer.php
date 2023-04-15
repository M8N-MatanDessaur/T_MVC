<?php
if (isset($_SESSION['user'])) {
    $cart = new Cart(); // Initialise Cart object

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

<div class="cart-container">
    <h1 style="margin-bottom:35px;">Cart 🛒</h1>
    <div class="cart">
        <?php if (count($cart->getItems()) == 0) : ?>
            <p>Your cart is empty.</p>
        <?php else : ?>
            <?php include('./views/carttable.php') ?>
        <?php endif; ?>
        <a href="./shop.php">Continue Shopping</a>
        <a href="checkout.php">Checkout</a>
    </div>
</div>