<main class="main-shop">

    <?php

    // Check if a Cart object exists in the session, otherwise create a new one
    if (!isset($_SESSION['cart_obj']) || !($_SESSION['cart_obj'] instanceof Cart)) {
        $_SESSION['cart_obj'] = new Cart();
    }
    $cart = $_SESSION['cart_obj'];

    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-to-cart'])) {
    // Get the product ID and quantity from the form
    $productId = $_POST['product-id'];
    $quantity = $_POST['quantity'];

    // Add the product to the cart
    $cart->addToCart($productId, $quantity);
    // Redirect back to the index page
    header('Location: shop.php');
    exit;
    }

    // Get all products from the database
    $database = new Database();
    $database->getAllProducts();

    ?>
</main>