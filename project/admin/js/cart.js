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

// Xóa toàn bộ giỏ hàng và lưu lại
function clearCart() {
    cart = [];
    saveCart();
}

// Hiển thị giỏ hàng
function showCart() {
    var cartItems = document.getElementById('cartItems');
    cartItems.innerHTML = '';

    if (cart.length === 0) {
        cartItems.innerHTML = '<li>Your cart is empty.</li>';
    } else {
        cart.forEach(function(item, index) {
            var li = document.createElement('li');
            li.textContent = item.title + ' - $' + item.price + ' (Quantity: ' + item.quantity + ')';
            cartItems.appendChild(li);

            // Add a remove button for each item
            var removeBtn = document.createElement('button');
            removeBtn.textContent = 'Remove';
            removeBtn.setAttribute('data-index', index); // Store index in data attribute
            removeBtn.addEventListener('click', function() {
                removeFromCart(index);
                showCart(); // Refresh cart display after removing item
            });
            li.appendChild(removeBtn);
        });
    }

    cartModal.style.display = "block";
}

// Xóa sản phẩm khỏi giỏ hàng
function removeFromCart(index) {
    cart.splice(index, 1);
    saveCart();
    updateCartItemCount();
}

