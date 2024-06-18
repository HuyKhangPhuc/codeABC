<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order History</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <div class="container mt-5">
    <h2>Your Order History</h2>
    <ul id="orderList" class="list-group mt-3">
      <!-- Đây là nơi để hiển thị danh sách các sản phẩm đã thêm vào giỏ hàng -->
    </ul>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Lấy dữ liệu giỏ hàng từ localStorage
      var cartItems = JSON.parse(localStorage.getItem('cart')) || [];

      // Hiển thị danh sách sản phẩm đã thêm vào giỏ hàng
      var orderList = document.getElementById('orderList');
      if (cartItems.length > 0) {
        cartItems.forEach(function(item) {
          var listItem = document.createElement('li');
          listItem.className = 'list-group-item';
          listItem.innerHTML = `<strong>${item.title}</strong> - Quantity: ${item.quantity} - Price: $${item.price}`;
          orderList.appendChild(listItem);
        });
      } else {
        orderList.innerHTML = '<li class="list-group-item">No items in your order history yet.</li>';
      }
    });
  </script>
  
  <style>
    /* style.css */

body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 800px;
    margin: auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 20px rgba(0,0,0,0.1);
}

h1 {
    text-align: center;
    margin-bottom: 30px;
}

.list-group-item {
    border: none;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}

.list-group-item:last-child {
    margin-bottom: 0;
}

  </style>
</body>
</html>
