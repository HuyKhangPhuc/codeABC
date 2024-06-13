<?php
include_once('ketnoi.php'); // Connect to Database

$error = NULL;
if (isset($_POST['submit'])) {
    // Initialize an array to hold errors
    $errors = array();

    // Product Name
    if (empty($_POST['ten_sp'])) {
        $errors['ten_sp'] = '<span style="color:red;">(*)</span>';
    } else {
        $ten_sp = mysqli_real_escape_string($conn, $_POST['ten_sp']);
    }

    // Product Price
    if (empty($_POST['gia_sp'])) {
        $errors['gia_sp'] = '<span style="color:red;">(*)</span>';
    } else {
        $gia_sp = mysqli_real_escape_string($conn, $_POST['gia_sp']);
    }

    // Product Status
    if (empty($_POST['trang_thai'])) {
        $errors['trang_thai'] = '<span style="color:red;">(*)</span>';
    } else {
        $trang_thai = mysqli_real_escape_string($conn, $_POST['trang_thai']);
    }

    // Product Details
    if (empty($_POST['chi_tiet_sp'])) {
        $errors['chi_tiet_sp'] = '<span style="color:red;">(*)</span>';
    } else {
        $chi_tiet_sp = mysqli_real_escape_string($conn, $_POST['chi_tiet_sp']);
    }

    // Product Image
    if (empty($_FILES['anh_sp']['name'])) {
        $errors['anh_sp'] = '<span style="color:red;">(*)</span>';
    } else {
        $anh_sp = basename($_FILES['anh_sp']['name']);
        $tmp = $_FILES['anh_sp']['tmp_name'];
        $upload_dir = 'anh/' . $anh_sp;

        if (!move_uploaded_file($tmp, $upload_dir)) {
            $errors['anh_sp'] = '<span style="color:red;">Failed to upload image.</span>';
        }
    }

    // Product Category
    if (!isset($_POST['id_dm']) || $_POST['id_dm'] == 'unselect') {
        $errors['id_dm'] = '<span style="color:red;">(*)</span>';
    } else {
        $id_dm = mysqli_real_escape_string($conn, $_POST['id_dm']);
    }

    // If no errors, proceed to insert data
    if (empty($errors)) {
        // Prepare insert query
        $sql = "INSERT INTO sanpham (ten_sp, gia_sp, tinh_trang, trang_thai, chi_tiet_sp, anh_sp, id_dm) 
                VALUES ('$ten_sp', '$gia_sp', 'Còn hàng', '$trang_thai', '$chi_tiet_sp', '$anh_sp', '$id_dm')";

        // Execute query
        if (mysqli_query($conn, $sql)) {
            header('Location: quantri.php?page_layout=danhsachsp');
            exit;
        } else {
            $error = "Có lỗi xảy ra trong quá trình thêm sản phẩm.";
        }
    }
}
?>


<link rel="stylesheet" type="text/css" href="css/themsp.css" />
<h2>Thêm sản phẩm mới</h2>
<div id="main">
    <form method="post" enctype="multipart/form-data">
        <table id="add-prd" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td><label>Tên sản phẩm</label><br />
                    <input type="text" name="ten_sp" /><?php if (isset($errors['ten_sp'])) { echo $errors['ten_sp']; } ?>
                </td>
            </tr>
            <tr>
                <td><label>Ảnh mô tả</label><br />
                    <input type="file" name="anh_sp" /><?php if (isset($errors['anh_sp'])) { echo $errors['anh_sp']; } ?>
                </td>
            </tr>
            <tr>
                <td><label>Giá sản phẩm</label><br />
                    <input type="text" name="gia_sp" /> VNĐ <?php if (isset($errors['gia_sp'])) { echo $errors['gia_sp']; } ?>
                </td>
            </tr>
            <tr>
                <td><label>Còn hàng</label><br />
                    <input type="text" name="trang_thai" value="Còn hàng" /><?php if (isset($errors['trang_thai'])) { echo $errors['trang_thai']; } ?>
                </td>
            </tr>
            <tr>
                <td><label>Chi tiết sản phẩm</label><br />
                    <textarea name="chi_tiet_sp"></textarea><?php if (isset($errors['chi_tiet_sp'])) { echo $errors['chi_tiet_sp']; } ?>
                </td>
            </tr>
            <tr>
                <td><label>Danh mục sản phẩm</label><br />
                    <select name="id_dm">
                        <option value="unselect">Chọn danh mục</option>
                        <!-- Add your categories here -->
                        <option value="1">Category 1</option>
                        <option value="2">Category 2</option>
                    </select>
                    <?php if (isset($errors['id_dm'])) { echo $errors['id_dm']; } ?>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Thêm mới" /></td>
            </tr>
        </table>
    </form>
    <?php if ($error) { echo '<p style="color:red;">' . $error . '</p>'; } ?>
</div>
