<?php
include_once('ketnoi.php'); // Kết nối CSDL

$error = NULL;
if(isset($_POST['submit'])){
    // Kiểm tra và xử lý lỗi cho các trường bắt buộc
    $errors = array();

    // Tên Sản phẩm
    if(empty($_POST['ten_sp'])){
        $errors['ten_sp'] = '<span style="color:red;">(*)</span>';
    }
    else{
        $ten_sp = $_POST['ten_sp'];
    }

    // Giá Sản phẩm
    if(empty($_POST['gia_sp'])){
        $errors['gia_sp'] = '<span style="color:red;">(*)</span>';
    }
    else{
        $gia_sp = $_POST['gia_sp'];
    }

    // Trạng thái
    if(empty($_POST['trang_thai'])){
        $errors['trang_thai'] = '<span style="color:red;">(*)</span>';
    }
    else{
        $trang_thai = $_POST['trang_thai'];
    }

    // Chi tiết Sản phẩm
    if(empty($_POST['chi_tiet_sp'])){
        $errors['chi_tiet_sp'] = '<span style="color:red;">(*)</span>';
    }
    else{
        $chi_tiet_sp = $_POST['chi_tiet_sp'];
    }

    // Ảnh mô tả Sản phẩm
    if(empty($_FILES['anh_sp']['name'])){
        $errors['anh_sp'] = '<span style="color:red;">(*)</span>';
    }
    else{
        $anh_sp = $_FILES['anh_sp']['name'];
        $tmp = $_FILES['anh_sp']['tmp_name'];
    }

    // Danh mục Sản phẩm
    if($_POST['id_dm'] == 'unselect'){
        $errors['id_dm'] = '<span style="color:red;">(*)</span>';
    }
    else{
        $id_dm = $_POST['id_dm'];
    }

    // Nếu không có lỗi, thực hiện insert dữ liệu
    if(empty($errors)){
        // Upload ảnh sản phẩm
        move_uploaded_file($tmp, 'anh/'.$anh_sp);

        // Chuẩn bị câu truy vấn insert
        $sql = "INSERT INTO sanpham (ten_sp, gia_sp, tinh_trang, trang_thai, chi_tiet_sp, anh_sp, id_dm) 
                VALUES ('$ten_sp', '$gia_sp', '$tinh_trang', '$trang_thai', '$chi_tiet_sp', '$anh_sp', '$id_dm')";

        // Thực thi truy vấn
        $query = mysqli_query($conn, $sql);

        // Kiểm tra và xử lý kết quả
        if($query){
            header('location:quantri.php?page_layout=danhsachsp');
            exit;
        } else {
            $error = "Có lỗi xảy ra trong quá trình thêm sản phẩm.";
        }
    }
}

?>

<link rel="stylesheet" type="text/css" href="css/themsp.css" />
<h2>thêm mới sản phẩm</h2>
<div id="main">
    <form method="post" enctype="multipart/form-data">
        <table id="add-prd" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td><label>Tên sản phẩm</label><br /><input type="text" name="ten_sp" /><?php if(isset($errors['ten_sp'])){ echo $errors['ten_sp']; } ?></td>
            </tr>
            <tr>
                <td><label>Ảnh mô tả</label><br /><input type="file" name="anh_sp" /><?php if(isset($errors['anh_sp'])){ echo $errors['anh_sp']; } ?></td>
            </tr>
            <tr>
                <td><label>Giá sản phẩm</label><br /><input type="text" name="gia_sp" /> VNĐ <?php if(isset($errors['gia_sp'])){ echo $errors['gia_sp']; } ?></td>
            </tr>
            <tr>
                <td><label>Còn hàng</label><br /><input type="text" name="trang_thai" value="Còn hàng" /><?php if(isset($errors['trang_thai'])){ echo $errors['trang_thai']; } ?></td>
            </tr>