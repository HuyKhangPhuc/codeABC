<!-- checkout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <style>/* checkout.php */
body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f2f2f2;
    padding: 20px;
}

form {
    max-width: 600px;
    margin: auto;
    background: #fff;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

h1 {
    text-align: center;
    margin-bottom: 30px;
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="text"],
textarea,
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}
body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        background-color: #f2f2f2;
        padding: 20px;
    }

    .cart-item {
        display: flex;
        margin-bottom: 20px;
        padding: 10px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
    }

    .cart-item img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        margin-right: 20px;
        border-radius: 5px;
    }

    .cart-item-info {
        flex-grow: 1;
    }

    .cart-item-info strong {
        font-size: 18px;
        color: #333;
    }

    .cart-item-info p {
        margin: 5px 0;
        color: #666;
    }
</style>
    <h1>Checkout</h1>
    <form action="process_order.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="4" cols="50" required></textarea><br><br>

        <label for="payment">Payment Method:</label>
        <select id="payment" name="payment" required>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
            <option value="cash">Cash on Delivery</option>
        </select><br><br>

        <button type="submit">Place Order</button>
    </form>
    <!-- checkout.php -->
<div id="cartItems"></div>

<script>
    // Load cart items for checkout
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
    var cartItemsContainer = document.getElementById('cartItems');
    if (cart.length > 0) {
        cart.forEach(function(item) {
            var cartItemDiv = document.createElement('div');
            cartItemDiv.className = 'cart-item';

            var img = document.createElement('img');
            img.src = item.img;
            img.alt = 'Product Image';
            cartItemDiv.appendChild(img);

            var cartItemInfo = document.createElement('div');
            cartItemInfo.className = 'cart-item-info';
            cartItemInfo.innerHTML = `
                <strong>${item.title}</strong><br>
                Quantity: ${item.quantity}<br>
                Price: $${item.price}
            `;
            cartItemDiv.appendChild(cartItemInfo);

            cartItemsContainer.appendChild(cartItemDiv);
        });
    } else {
        cartItemsContainer.innerHTML = '<p>No items in cart.</p>';
    }
</script>

</body>
</html>
