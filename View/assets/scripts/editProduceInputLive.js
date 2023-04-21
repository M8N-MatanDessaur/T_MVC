async function editProduct(id) {
    // Get the input values from the adminaddform.php
    const name = document.getElementById(id + 'Name').value;
    const description = document.getElementById(id + 'Description').value;
    const price = document.getElementById(id + 'Price').value;
    const quantity = document.getElementById(id + 'Quantity').value;

    // Send the data to the server as JSON
    const response = await fetch('../Controller/edit_product.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            _id: id,
            Name: name,
            Description: description,
            Price: price,
            Quantity: quantity,
        }),
    });
    
    // Reload the page after a successful update
    if (response.ok) {
        location.reload();
    } else {
        //alert('Failed to update product.');
    }
}
