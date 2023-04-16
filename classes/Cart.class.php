<?php
class Cart
{
    private $items;
    private $total;

    // if ['cart'] exists in Session,  items array = the cart products, else create items array
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
            // Get product & details from database
            $db = new Database();
            $result = $db->getProductById($product_id);
            
            // Add this product to items array
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $this->items[$product_id] = [
                    'Name' => $row['Name'],
                    'Price' => $row['Price'],
                    'Quantity' => $quantity,
                ];
            }
        }

        // Save updated items array to ['cart'] on Session
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
