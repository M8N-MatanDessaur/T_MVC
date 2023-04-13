<form id="addProd" class="add" method="post" action="../t/php/addProduct.php" enctype="multipart/form-data">
    <h2>Add Product</h2>
    <label for="name">Name:</label>
    <input type="text" name="Name" required>
    <label for="desc">Description:</label>
    <input type="text" name="Description" required>
    <label for="price">Price per gram:</label>
    <input type="number" step="0.0001"  min="0" name="Price" required>
    <label for="quantity">Quantity:</label>
    <input type="number" name="Quantity" required>
    <label for="image">Image:</label>
    <input type="file" name="Image" accept="image/*" required>
    <button type="submit" name="add">Add</button>
</form>