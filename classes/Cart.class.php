<?php
class Cart
{
    private $items;
    private $total;

    // If not exists, creates a cart in session, else get the added items
    public function __construct()
    {
        if (isset($_SESSION['cart'])) {
            $this->items = $_SESSION['cart'];
        } else {
            $this->items = [];
        }
    }

    // Gets all cart items
    public function getItems()
    {
        return $this->items;
    }

    // Adds product to cart (+ quantity)
    public function addToCart($product_id, $quantity = 1)
    {
        // Check if product already exists in cart
        if (isset($this->items[$product_id])) {
            $this->items[$product_id]['Quantity'] += $quantity;
        } else {
            // Get product details from database
            $db = new Database();
            $connection = $db->getConnection();

            $query = $connection->prepare("SELECT * FROM teas WHERE _id = ?");
            $query->bind_param("i", $product_id);
            $query->execute();
            $result = $query->get_result();

            // Add product to cart
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $this->items[$product_id] = [
                    'Name' => $row['Name'],
                    'Price' => $row['Price'],
                    'Quantity' => $quantity,
                ];
            }
        }

        // Save updated cart to session
        $_SESSION['cart'] = $this->items;
        echo '<script>window.location.href = "./shop.php";</script>';
    }

    // Removes product from cart
    public function removeFromCart($product_id)
    {
        if (isset($this->items[$product_id])) {
            unset($this->items[$product_id]);
            $_SESSION['cart'] = $this->items;
            $_SESSION['cart_obj'] = $this;
        }
        echo '<script>window.location.href = "./cart.php";</script>';
    }

    // Gets the cart total price
    public function getTotal()
    {
        $this->total = 0;
        foreach ($this->items as $item) {
            $this->total += $item['Price'] * $item['Quantity'];
        }
        return $this->total;
    }

    // Calculates the product subtotal (prod*qte)
    function getProductSubtotal($price, $quantity)
    {
        return $price * $quantity;
    }
}
