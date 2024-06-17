<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <title>HKP</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" />
</head>
<body>

<!-- header section starts -->
<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand" href="index.php">
            <span>Welcome to Noob team</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?act=addsp">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?act=adddm">Why Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?act=dsbl">Rating</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?act=thongke">Contact Us</a>
                </li>
            </ul>
            <div class="user_option">
                <?php if(isset($_SESSION['username'])): ?>
                    <div style="position:relative;left: 80px;" class="dropdown">
                        <button style="background-color: transparent; color:black;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="profile.php">Profile</a>
                            <a class="dropdown-item" href="order_history.php">Order History</a>
                            <a class="dropdown-item" href="index.php?act=logout">Logout</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="index.php?act=dangky">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>Login</span>
                    </a>
                <?php endif; ?>
                <a href="cart.php">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    <span id="cartItemCount"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                </a>
                <form class="form-inline">
                    <button class="btn nav_search-btn" type="submit">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
            
        </div>
    </nav>
</header>

<!-- Include modal -->
<?php
    $modalPath = realpath(__DIR__ . '/../sanpham/modal.php');
    if ($modalPath) {
        include $modalPath;
    } else {
         realpath(__DIR__ . '/../sanpham/modal.php');
    }
   

    

?>

<!-- Trong phần cuối của trang HTML -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="js/cart.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
<!-- sửa giao diện-->
