<?php
session_start();
include_once('ketnoi.php');

// Kiểm tra xem người dùng đã đăng nhập chưa
if(isset($_SESSION['tk'])){
    // Kiểm tra xem có tồn tại tham số id_sp trên URL không
    if(isset($_GET['id_sp'])){
        $id_sp = $_GET['id_sp'];

        // Sử dụng MySQLi và prepared statement để xóa sản phẩm
        $sql = "DELETE FROM sanpham WHERE id_sp = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_sp);

        // Thực thi câu lệnh
        if($stmt->execute()){
            // Xóa thành công, chuyển hướng về trang danh sách sản phẩm
            header('location:quantri.php?page_layout=danhsachsp');
            exit;
        } else {
            // Xóa không thành công, xử lý thông báo lỗi hoặc chuyển hướng về trang cần thiết
            echo "Có lỗi xảy ra khi xóa sản phẩm.";
        }
    } else {
        // Nếu không có id_sp trên URL, xử lý theo logic của bạn (ví dụ: thông báo lỗi hoặc chuyển hướng)
        echo "Không tìm thấy sản phẩm cần xóa.";
    }
} else {
    // Nếu người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
    header('location:index.php');
    exit;
}
?>
