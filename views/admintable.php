<?php
// Fetch product data from database
$db = new Database();
$products = $db->getAllProducts()
?>


<table style="background-color: white; border: white solid 10px;">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price per gram</th>
            <th>Stock quantity</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) { ?>
            <tr>
                <td><input id="<?= $product['_id'] . 'Name' ?>" type="text" value="<?= $product['Name'] ?>"></td>
                <td><textarea id="<?= $product['_id'] . 'Description' ?>" name="" id="Description" style="width: 300px; height: 100px; resize:none"><?= $product['Description'] ?></textarea></td>
                <td><input id="<?= $product['_id'] . 'Price' ?>" type="number" min="0" step=".0001" name="Price" value="<?= $product['Price'] ?>"></td>
                <td><input id="<?= $product['_id'] . 'Quantity' ?>" type="number" name="Quantity" value="<?= $product['Quantity'] ?>"></td>
                <td><img id="<?= $product['_id'] . 'Image' ?>" style="height: 90px !important; max-width:200px !important;" src="assets/images/<?= $product['Image'] ?>"></td>
                <td>
                    <div style="display:flex; gap:10px;">
                        <button onclick="editProduct(<?= $product['_id'] ?>);" class="act-btn">
                            <svg width="25" height="25" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="m19.4 7.337-2.74-2.74a2 2 0 0 0-2.66-.07l-9 9a2 2 0 0 0-.57 1.21L4 18.907a1 1 0 0 0 1 1.09h.09l4.17-.38a2 2 0 0 0 1.21-.57l9-9a1.92 1.92 0 0 0-.07-2.71ZM9.08 17.617l-3 .28.27-3L12 9.317l2.7 2.7-5.62 5.6Zm6.92-6.94-2.68-2.68 1.95-2L18 8.727l-2 1.95Z"></path>
                            </svg>
                        </button>
                        <form method="post" action="../t/php/deleteProduct.php">
                            <input type="hidden" name="id" value="<?= $product['_id'] ?>">
                            <button type="submit" name="delete" class="act-btn">
                                <svg width="25" height="25" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 6.001h-5v-1.67a2.42 2.42 0 0 0-2.5-2.33h-3A2.42 2.42 0 0 0 8 4.331v1.67H3a1 1 0 0 0 0 2h1v11a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-11h1a1 1 0 1 0 0-2Zm-11-1.67c0-.16.21-.33.5-.33h3c.29 0 .5.17.5.33v1.67h-4v-1.67Zm8 14.67a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-11h12v11Z"></path>
                                </svg>
                            </button>
                        </form>
                    </div>

                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>