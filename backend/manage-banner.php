<?php
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";

// corusel query
$query = "SELECT * FROM banner ORDER BY bn_id DESC";
$result = mysqli_query($conn, $query);

// tb query
$count_n = 1;
$datatb = "SELECT * FROM banner  ORDER BY bn_id DESC";
$result2 = mysqli_query($conn, $datatb);

if (isset($_POST['bn-submit'])) {
    $bn_toppic = $_POST['bn_toppic'];
    $bn_detail = $_POST['bn_detail'];
    // ไฟล์ภาพ
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Ymd");
    $numrand = (mt_rand());
    $bn_tmp = $_FILES['bn_img']['tmp_name'];
    $oldname = strrchr($_FILES['bn_img']['name'], ".");
    $bn_name = $date . $numrand . $oldname;
    $bn_type = $_FILES['bn_img']['type'];
    $bn_img = '../asset/banner/' . $bn_name;
    $path = 'asset/banner/' . $bn_name;
    if (isset($_POST["bn_toppic"]) != "" && isset($_POST["bn_detail"]) != "" && isset($_POST["bn_toppic"]) != "" && isset($bn_img) != "") {
        move_uploaded_file($bn_tmp, $bn_img);
        $sqlInsert = "INSERT INTO banner (bn_toppic,bn_detail,bn_pic) VALUES ('$bn_toppic','$bn_detail','$path') ";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1"; />';
        } else {
            echo "<script type='text/javascript'> error(); </script>";

        }
    } else {
        echo "<script type='text/javascript'> error(); </script>";

    }
}



if (isset($_GET['bn_id'])) {
    $bn_id = $_GET['bn_id'];

    $sqlDelUsers = "DELETE FROM banner WHERE bn_id = '$bn_id'";
    if ($rsDelUsers = mysqli_query($conn, $sqlDelUsers)) {
        echo "<script>delbannersuccess().then(window.location='../users-admin/banner.php');</script>";
        
    } else {
        echo "<script type='text/javascript'> error(); </script>";
    }
}

