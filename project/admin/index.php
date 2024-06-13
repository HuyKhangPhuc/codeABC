<?php
include "../model/pdo.php";
include "header.php";
        //controller
        if(isset($_GET['act'])){
            $act=$_GET['act'];
            switch ($act) {
                case 'adddm':
                   if(isset($_POST['themmoi'])&&($_POST['themmoi'])){
                        $tenloai=$_POST['tenloai'];
                        $sql="insert into users(name) values('$tenloai')";
                        pdo_execute($sql);
                        $thongbao="thêm thành công";
                    }
                    include "danhmuc/add.php";
                    break;
                case 'addsp':
                    include "sanpham/shop.php";
                    break;
                case'dsbl':
                    include "danhgia/testimonial.php";
                    break;
                case'thongke':
                include "lienhe/contact.php";
                break;
                case'muahang':
                    include "sanpham/shop.php";
                    break;
                    case'muangay':
                    include "sanpham/shop.php";
                    break;
                case'location':
                    include "lienhe/contact.php";
                    break;
                case 'dangky':
                    include "Taikhoan/index2.php";
                    break;
                default:
                   include "home.php";
                    break;
            }
        }
        else{
            include "home.php";
        }
       ?>
        <?php include "footer.php";?>
        

    </div>
    
</body>
</html>