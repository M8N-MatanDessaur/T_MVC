<?php
// Calculates subtotal
function getProductSubtotal($price, $quantity) {
    return $price * $quantity;
}

// Formats the price to 0.00
function formatPrice($price, $decimals = 2) {
    return number_format($price, $decimals);
}

?>

<table class="table-style">
    <tbody>
        <?php foreach ($cart->getItems() as $product_id => $item) : ?>
            <?php
            $product = new Tea($product_id, $item['Name'], "", $item['Price'], $item['Quantity'], "");
            $subtotal = getProductSubtotal($product->getPrice(), $item['Quantity']);
            ?>
            <tr>
                <td><?php echo $product->getName() ?></td>
                <td><?php echo $item['Quantity'] ?>g</td>
                <td><?php echo formatPrice($product->getPrice(), 4) ?>$/g</td>
                <td><?php echo formatPrice($subtotal) ?>$</td>
                <td>
                    <form method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                        <button class="del" type="submit" name="remove-from-cart">✕</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h2 class="align-end">Total: <?php echo formatPrice($cart->getTotal()) ?></h2>
