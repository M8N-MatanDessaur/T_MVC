<?php
 function showProductCard($image, $name, $description, $price, $id)
 {
    echo '<div class="product">';
        echo '<img src="../../assets/images/' . $image . '" alt="' . $name . '" height="150">';
        echo '<h3>' . $name . '</h3>';
        echo '<p class="desc">' . $description . '</p>';
        echo '<p class="price">$' . number_format($price, 4) . '/g</p>';
        echo '<form method="post">';
        echo '<input type="hidden" name="product-id" value="' . $id . '">';
        echo '<div class="inputGroup">';
        echo '<select class="qte" name="quantity" ><option value="100">100g</option><option value="500">500g</option><option value="1000">1000g</option></select>';
        echo '</div>';
        echo '<button type="submit" name="add-to-cart"><svg width="45" height="45" fill="#3a732f" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2.25c-5.376 0-9.75 4.374-9.75 9.75s4.374 9.75 9.75 9.75 9.75-4.374 9.75-9.75S17.376 2.25 12 2.25Zm4.5 10.5h-3.75v3.75h-1.5v-3.75H7.5v-1.5h3.75V7.5h1.5v3.75h3.75v1.5Z"></path></svg></button>';
        echo '</form>';
    echo '</div>';
}
?>