<?php
    include_once('ketnoi.php'); // File kết nối CSDL
    $id_sp = $_GET['id_sp'];
    $sql = "SELECT * FROM sanpham WHERE id_sp = $id_sp";
    $query = mysqli_query($conn, $sql); // Sử dụng kết nối $conn đã được thiết lập từ file kết nối

    if (mysqli_num_rows($query) > 0) {
        $arr = mysqli_fetch_array($query);

        // Xử lý khi submit form
        if(isset($_POST['submit'])){
            // Các biến lỗi và xử lý validate nếu cần

            // Thực hiện update dữ liệu sản phẩm
            $ten_sp = mysqli_real_escape_string($conn, $_POST['ten_sp']);
            $gia_sp = mysqli_real_escape_string($conn, $_POST['gia_sp']);
            $trang_thai = mysqli_real_escape_string($conn, $_POST['trang_thai']);
            $chi_tiet_sp = mysqli_real_escape_string($conn, $_POST['chi_tiet_sp']);
            $id_dm = mysqli_real_escape_string($conn, $_POST['id_dm']);

            // Xử lý ảnh sản phẩm
            $anh_sp = $arr['anh_sp']; // Giữ nguyên ảnh cũ nếu không có ảnh mới
            if(isset($_FILES['anh_sp']) && $_FILES['anh_sp']['name'] != ''){
                $tmp = $_FILES['anh_sp']['tmp_name'];
                $anh_sp = $_FILES['anh_sp']['name'];
                move_uploaded_file($tmp, 'quantri/anh/'.$anh_sp);
            }

            // Câu lệnh SQL update
            $sqlUpdate = "UPDATE sanpham SET 
                            id_dm = '$id_dm', 
                            ten_sp = '$ten_sp', 
                            anh_sp = '$anh_sp', 
                            gia_sp = '$gia_sp', 
                            trang_thai = '$trang_thai', 
                            chi_tiet_sp = '$chi_tiet_sp' 
                         WHERE id_sp = $id_sp";
            $queryUpdate = mysqli_query($conn, $sqlUpdate);

            if($queryUpdate){
                header('location:quantri.php?page_layout=danhsachsp');
                exit;
            } else {
                echo "Cập nhật sản phẩm không thành công.";
            }
        }
    } else {
        echo "Không tìm thấy sản phẩm.";
    }
?>
<link rel="stylesheet" type="text/css" href="css/themsp.css" />
<h2>sửa thông tin sản phẩm</h2>
<div id="main">
    <form method="post" enctype="multipart/form-data">
        <table id="add-prd" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td><label>Tên sản phẩm</label><br /><input type="text" name="ten_sp" value="<?php echo htmlspecialchars($arr['ten_sp']); ?>" /></td>
            </tr>
            <tr>
                <td><label>Ảnh mô tả</label><br /><input type="file" name="anh_sp" /><input type="text" disabled name="anh_sp" value="<?php echo htmlspecialchars($arr['anh_sp']); ?>" /></td>
            </tr>
            <tr>
                <td><label>Nhà cung cấp</label><br />
                    <select name="id_dm">
                        <?php
                            $sqlDm = "SELECT * FROM dmsanpham";
                            $queryDm = mysqli_query($conn, $sqlDm);
                            while ($arrDm = mysqli_fetch_array($queryDm)) {
                                echo "<option value='" . $arrDm['id_dm'] . "'";
                                if($arrDm['id_dm'] == $arr['id_dm']) { echo " selected"; }
                                echo ">" . htmlspecialchars($arrDm['ten_dm']) . "</option>";
                            }
                        ?>
                    </select>   
                </td>
            </tr>
            <tr>
                <td><label>Giá sản phẩm</label><br /><input type="text" name="gia_sp" value="<?php echo htmlspecialchars($arr['gia_sp']); ?>" /> VNĐ</td>
            </tr>
            <tr>
                <td><label>Tình trạng</label><br /><input type="text" name="tinh_trang" value="<?php echo htmlspecialchars($arr['tinh_trang']); ?>" /></td>
            </tr>
            <tr>
                <td><label>Còn hàng</label><br /><input type="text" name="trang_thai" value="<?php echo htmlspecialchars($arr['trang_thai']); ?>" /></td>
            </tr>
            <tr>
                <td><label>Thông tin chi tiết sản phẩm</label><br /><textarea cols="60" rows="12" name="chi_tiet_sp"><?php echo htmlspecialchars($arr['chi_tiet_sp']); ?></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Cập nhật" /> <input type="reset" name="reset" value="Làm mới" /></td>
            </tr>
        </table>
    </form>
</div>
