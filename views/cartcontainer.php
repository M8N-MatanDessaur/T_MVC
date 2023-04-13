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