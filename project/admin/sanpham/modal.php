<!-- Modal Structure -->
<div id="productModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="modal-body">
      <img id="modalImg" src="" alt="Product Image">
      <h4 id="modalTitle">Product Title</h4>
      <p id="modalPrice">Price: $0</p>
      <button id="addToCartBtn">Add to Cart</button>
    </div>
  </div>
</div>
<script>
  // Giỏ hàng
  var cart = JSON.parse(localStorage.getItem('cart')) || [];

  // Lưu giỏ hàng vào localStorage
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

  // Function to open modal with product details
  function openModal(product) {
    document.getElementById("modalImg").src = product.img;
    document.getElementById("modalTitle").innerText = product.title;
    document.getElementById("modalPrice").innerText = "Price: $" + product.price;
    modal.style.display = "block";
  }

  // Add event listeners to product cards
  document.querySelectorAll('.box a').forEach(function(card, index) {
    card.addEventListener('click', function(event) {
      event.preventDefault();
      var product = {
        img: card.querySelector('img').src,
        title: card.querySelector('.detail-box h6').innerText,
        price: card.querySelector('.detail-box span').innerText.replace('$', '')
      };
      openModal(product);
    });
  });

  // Get the modal
  var modal = document.getElementById("productModal");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

  // Load cart item count when page is loaded
  document.addEventListener('DOMContentLoaded', function() {
    updateCartItemCount();
  });
</script>
