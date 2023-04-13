<table style="width: inherit;
    text-align: left;">
    <tbody>
        <?php foreach ($cart->getItems() as $product_id => $item) : ?>
            <?php
            $product = new Tea($product_id, $item['Name'], "", $item['Price'], $item['Quantity'], "");
            $subtotal = $product->getPrice() * $item['Quantity'];
            ?>
            <tr>
                <td><?php echo $product->getName() ?></td>
                <td><?php echo $item['Quantity'] ?>g</td>
                <td><?php echo number_format($product->getPrice(), 4) ?>$/g</td>
                <td><?php echo number_format($subtotal, 2) ?>$</td>
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
<h2 style="align-self:flex-end">Total: <?php echo number_format($cart->getTotal(), 2) ?></h2>