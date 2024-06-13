<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

  <title>
    HKP
  </title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>
<body>
  <!-- header section strats -->
  <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="index.html">
          <span>
            Welcome to Noob team
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  ">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?act=addsp">
                Shop
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?act=adddm">
                Why Us
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?act=dsbl">
                Rating
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?act=thongke">Contact Us</a>
            </li>
          </ul>
          <div class="user_option">
            <a href="index.php?act=dangky">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>
                Login
              </span>
            </a>
            <a href="">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
              <span id="cartItemCount">0</span>

            </a>
            <form class="form-inline ">
              <button class="btn nav_search-btn" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </form>
          </div>
        </div>
      </nav>
    </header>
    <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <script src="js/custom.js"></script>
  <script>// JavaScript để cập nhật số lượng sản phẩm trên icon giỏ hàng
function updateCartItemCount() {
    var cartItemCount = <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>;
    var cartItemCountElement = document.getElementById('cartItemCount');
    if (cartItemCountElement) {
        cartItemCountElement.textContent = cartItemCount;
    }
}

// Gọi hàm updateCartItemCount() khi trang được tải
document.addEventListener('DOMContentLoaded', function() {
    updateCartItemCount();
});
</script>
