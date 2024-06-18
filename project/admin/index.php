<?php
session_start(); // Start the session

// Include necessary files
include "../model/pdo.php";
include "header.php";

// Controller logic
if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'adddm':
            if (isset($_POST['themmoi']) && $_POST['themmoi']) {
                $tenloai = $_POST['tenloai'];
                $sql = "INSERT INTO users(name) VALUES('$tenloai')";
                pdo_execute($sql);
                $thongbao = "Thêm thành công";
            }
            include "danhmuc/add.php";
            break;

        case 'addsp':
            include "sanpham/shop.php";
            break;

        case 'dsbl':
            include "danhgia/testimonial.php";
            break;

        case 'thongke':
            include "lienhe/contact.php";
            break;

        case 'muahang':
        case 'muangay':
            include "sanpham/shop.php";
            break;

        case 'location':
            include "lienhe/contact.php";
            break;

        case 'dangky':
            header("Location: login.php");
            exit; // Always exit after a header redirect

        case 'logout':
            unset($_SESSION['username']); // Unset the session variable
            header("Location: index.php");
            exit; // Always exit after a header redirect
      

        default;
        
            include "home.php";
            break;
    }
} else {
    include "home.php";
}

include "footer.php"; // Include footer at the end

    // Xử lý đăng xuất
    if (isset($_GET['act']) && $_GET['act'] == 'logout') {
        // Thực hiện đăng xuất, ví dụ:
        unset($_SESSION['username']);
        session_destroy();
        
        // Gọi hàm clearCart() để xóa giỏ hàng
        echo '<script>clearCart();</script>';
    }

// End of PHP script
?>
