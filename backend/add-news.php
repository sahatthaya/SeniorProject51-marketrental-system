<?php
include "1-connectDB.php";



if (isset($_GET['mkr_id'])) {
    $mkr_id = $_GET['mkr_id'];
}


if (isset($_POST['add-news'])) {
    $n_sub = $_POST['n_sub'];
    $n_detail = $_POST['n_detail'];
    $n_file = '';
    $n_file = isset($_POST['n_file']);


    date_default_timezone_set('Asia/Bangkok');
    $date = date("Ymd");
    $numrand = (mt_rand());
    // ไฟล์ภาพ
    $n_tmp = $_FILES['n_file']['tmp_name'];
    $n_nameoldname = strrchr($_FILES['n_file']['name'], ".");
    $n_name = $date . $numrand . $n_nameoldname;
    $n_type = $_FILES['n_file']['type'];
    $n_file = 'asset/news/' . $n_name;
    $npath = '../asset/news/' . $n_name;
    if (isset($_POST["n_sub"]) != "" && isset($_POST["n_detail"]) != "") {
        move_uploaded_file($n_tmp, $npath);
        $sqlInsert = "INSERT INTO news(n_sub, n_detail, n_file,mkr_id) VALUES ('$n_sub', '$n_detail', '$n_file', $mkr_id)";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script>alert('เพิ่มข่าวสารเสร็จสิ้น');</script>";
            mysqli_close($conn);
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง);</script>";
        }
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง);</script>";
    }
}
// delete
if(isset($_GET['del'])){
    $del = $_GET['del'];
    $sqldel = "DELETE FROM `news` WHERE n_id='$del'";
    if (mysqli_query($conn, $sqldel)) {
        echo "<script>alert('ลบข่าวสารสำเร็จ');</script>";
        mysqli_close($conn);
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง);</script>";
    }
}