<?php 
$cart = new Cart(); // Initialise Cart object 
if(!isset($_SESSION["user"])){
    header('Location: ../View/login.php');
}
?>
<div class="cart-container">
    <h1 style="margin-bottom:35px;">Cart 🛒</h1>
    <div class="cart">
        <?php if (is_array($cart->getItems()) && count($cart->getItems()) == 0) : ?>
            <p>Your cart is empty.</p>
        <?php else : ?>
            <?php include('./PartialViews/carttable.php') ?>
        <?php endif; ?>
        <a href="./shop.php">Continue Shopping</a>
        <a href="checkout.php">Checkout</a>
    </div>
</div>