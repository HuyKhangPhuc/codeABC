<?php
session_start();
include_once('ketnoi.php');

$error = NULL;
if (isset($_POST['submit'])) {
    if ($_POST['tk'] == "") {
        $error = "Vui lòng nhập tài khoản và mật khẩu";
    } else {
        $tk = $_POST['tk'];
    }

    if ($_POST['mk'] == "") {
        $error = "Vui lòng nhập tài khoản và mật khẩu";
    } else {
        $mk = $_POST['mk'];
    }

    if (isset($tk) && isset($mk)) {
        // Sử dụng đúng tên cột trong câu truy vấn
        $stmt = $conn->prepare("SELECT * FROM thanhvien WHERE username = ? AND password = ?");
        if ($stmt === false) {
            die("Lỗi khi chuẩn bị truy vấn: " . $conn->error);
        }

        $stmt->bind_param("ss", $tk, $mk);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows <= 0) {
            $error = 'Tài khoản hoặc mật khẩu chưa đúng';
        } else {
            $_SESSION['tk'] = $tk;
            $_SESSION['mk'] = $mk;
            header('location:quantri.php');
            exit();
        }

        // Giải phóng bộ nhớ và đóng prepared statement
        $stmt->free_result();
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8" />
    <title>Vietpro Mobile Shop - Đăng nhập hệ thống</title>
    <link rel="stylesheet" type="text/css" href="css/dangnhap.css" />
</head>
<body>
    <?php
    if (!isset($_SESSION['tk'])) {
    ?>
    <form method="post">
    <div id="form-login">
        <h2>đăng nhập hệ thống quản trị</h2>
        <center><span style="color:red;"><?php echo $error;?></span></center>
        <ul>
            <li><label>tài khoản</label><input type="text" name="tk" /></li>
            <li><label>mật khẩu</label><input type="password" name="mk" /></li>
            <li><label>ghi nhớ</label><input type="checkbox" name="check" checked="checked" /></li>
            <li><input type="submit" name="submit" value="Đăng nhập" /> <input type="reset" name="reset" value="Làm mới" /></li>
        </ul>
    </div>
    </form>
    <?php
    } else {
        header('location:quantri.php');
        exit();
    }
    ?>
</body>
</html>
