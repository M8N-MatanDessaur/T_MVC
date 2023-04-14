<main class="main-shop">
    <?php
    // Gets the instance of cart
    function getCart() {
        if (!isset($_SESSION['cart_obj']) || !($_SESSION['cart_obj'] instanceof Cart)) {
            $_SESSION['cart_obj'] = new Cart();
        }
        return $_SESSION['cart_obj'];
    }

    // Handles add to cart method
    function handleFormSubmission(Cart $cart) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-to-cart'])) {
            $productId = filter_input(INPUT_POST, 'product-id', FILTER_SANITIZE_NUMBER_INT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);

            $cart->addToCart($productId, $quantity);
            header('Location: shop.php');
            exit;
        }
    }

    $cart = getCart();
    handleFormSubmission($cart);

    $database = new Database();
    $database->getAllProducts(); // Gets all the intianciated cart items
    ?>
</main>
