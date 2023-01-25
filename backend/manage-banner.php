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

// qry edit banner
if (isset($_GET["bn_id"])) {
    $id = $_GET["bn_id"];
    $data = "SELECT * FROM banner WHERE bn_id = '$id'";
    $resultdata = mysqli_query($conn, $data);
    $row2 = mysqli_fetch_array($resultdata);
    extract($row2);
}

// add banner
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
        $sqlInsert = "INSERT INTO banner (`bn_toppic`,`bn_detail`,`bn_pic`) VALUES ('$bn_toppic','$bn_detail','$path') ";
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


// del banner
if (isset($_GET['delbn_id'])) {
    $bn_id = $_GET['delbn_id'];

    $sqlDelUsers = "DELETE FROM banner WHERE bn_id = '$bn_id'";
    if ($rsDelUsers = mysqli_query($conn, $sqlDelUsers)) {
        echo "<script>delbannersuccess().then(window.location='../users-admin/banner.php');</script>";
    } else {
        echo "<script type='text/javascript'> error(); </script>";
    }
}

// edit banner
if (isset($_POST['bn-submit-edit'])) {
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
