<?php
include "../backend/1-connectDB.php";
if (isset($_POST['bn-submit'])) {
    $bn_id = $_POST['bn_id'];
    $bn_toppic = $_POST['bn_toppic'];
    $bn_detail = $_POST['bn_detail'];

    date_default_timezone_set('Asia/Bangkok');
    $date = date("Ymd");
    $numrand = (mt_rand());

    // ไฟล์ภาพตลาด
    $bn_pic_tmp = $_FILES['bn_pic']['tmp_name'];
    $bn_pic_oldname = strrchr($_FILES['bn_pic']['name'], ".");
    $bn_pic_name = $date . $numrand . $bn_pic_oldname;
    $bn_pic_type = $_FILES['bn_pic']['type'];
    $bn_pic = 'asset/banner/' . $bn_pic_name;
    $path = '../asset/banner/' . $bn_pic_name;

    if (($bn_id && $bn_toppic && $bn_detail) != '') {
        if ($bn_pic_tmp != '') {
            $update = "UPDATE `banner` SET `bn_toppic`='$bn_toppic',`bn_detail`='$bn_detail',`bn_pic`='$bn_pic' WHERE 'bn_id'='$bn_id'";
            if (mysqli_query($conn, $update)) {
                move_uploaded_file($bn_pic_tmp, $path);
                echo "<script type='text/javascript'> success(); </script>";
                echo '<meta http-equiv="refresh" content="1";/>';
            } else {
                echo "<script type='text/javascript'> error(); </script>";
            }
        } else {
            $update = "UPDATE `banner` SET `bn_toppic`='$bn_toppic',`bn_detail`='$bn_detail' WHERE 'bn_id'='$bn_id'";
            if (mysqli_query($conn, $update)) {
                echo "<script type='text/javascript'> success(); </script>";
                echo '<meta http-equiv="refresh" content="1";/>';
            } else {
                echo "<script type='text/javascript'> error(); </script>";
            }
        }
    }
}
