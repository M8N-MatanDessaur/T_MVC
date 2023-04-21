<main class="main-shop">
    <?php
    // if client is connected, create a cart object in session
    if (isset($_SESSION['user'])) {
        $cart = $_SESSION['cart'];
    }
    // else bring user to login page
    else {
        header('Location: ./login.php');
    }

    // Gets the instance of cart
    function getCart()
    {
        if (!isset($_SESSION['cart_obj']) || !($_SESSION['cart_obj'] instanceof Cart)) {
            $_SESSION['cart_obj'] = new Cart();
        }
        return $_SESSION['cart_obj'];
    }

    // Handles add to cart method
    function handleFormSubmission(Cart $cart)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-to-cart'])) {
            $productId = filter_input(INPUT_POST, 'product-id', FILTER_SANITIZE_NUMBER_INT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);

            $cart->addToCart($productId, $quantity);
            header('Location: shop.php');
            exit;
        }
    }

    $db = new Database();
    $db->showProductsCards(); // Gets all the intianciated cart items

    $cart = getCart(); // Gets the current user's cart
    handleFormSubmission($cart); // Handles the delete product from cart form submission
    ?>
</main>