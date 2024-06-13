<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin sản phẩm từ POST request
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];
    $productQuantity = $_POST['quantity'];

    // Tạo một mảng chứa thông tin sản phẩm
    $product = array(
        'name' => $productName,
        'price' => $productPrice,
        'quantity' => $productQuantity
    );

    // Thêm sản phẩm vào giỏ hàng (biến session)
    $_SESSION['cart'][] = $product;

    // Trả về phản hồi (nếu cần)
    echo "Product added to cart successfully.";
}
?>
