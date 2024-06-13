<?php
// File: cart.php

function addProductToCart($productName, $productPrice, $productQuantity) {
    // Check if the cart session is set
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
    }
  
    // Create a new product array
    $product = array(
      'name' => $productName,
      'price' => $productPrice,
      'quantity' => $productQuantity
    );
  
    // Add the product to the cart session
    $_SESSION['cart'][] = $product;
  
    // Return a success message
    return "Product added to cart successfully.";
  }
?>