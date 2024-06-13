// cart.js

// Khởi tạo giỏ hàng từ Local Storage
var cart = JSON.parse(localStorage.getItem('cart')) || [];

// Lưu giỏ hàng vào Local Storage
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartItemCount();
}

// Cập nhật số lượng sản phẩm trong giỏ hàng
function updateCartItemCount() {
    document.getElementById('cartItemCount').textContent = cart.reduce((total, item) => total + item.quantity, 0);
}

// Thêm sản phẩm vào giỏ hàng
function addToCart(title, price) {
    var item = cart.find(product => product.title === title);
    if (item) {
        item.quantity++;
    } else {
        cart.push({ title: title, price: price, quantity: 1 });
    }
    saveCart();
}

// Xử lý sự kiện khi nhấn nút "Add to Cart" trong modal
document.getElementById('addToCartBtn').addEventListener('click', function() {
    var title = document.getElementById('modalTitle').innerText;
    var price = document.getElementById('modalPrice').innerText.replace('Price: $', '');
    addToCart(title, price);
    alert('Product added to cart!');
    modal.style.display = "none";
});

// Load cart item count when page is loaded
document.addEventListener('DOMContentLoaded', function() {
    updateCartItemCount();
});
