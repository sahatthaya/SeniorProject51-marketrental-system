<?php
include "../backend/connectDB.php";
if (isset($_POST['bn-submit'])) {

    $ct1_fname = $_POST['ct1_fname'];
    $ct1_lname = $_POST['ct1_lname'];
    $ct1_tel = $_POST['ct1_tel'];
    $ct1_email = $_POST['ct1_email'];

    $ct2_fname = $_POST['ct2_fname'];
    $ct2_lname = $_POST['ct2_lname'];
    $ct2_tel = $_POST['ct2_tel'];
    $ct2_email = $_POST['ct2_email'];

    //เซ็ตชื่อไฟล์
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Ymd");
    $numrand = (mt_rand());

    // ไฟล์ภาพlogo
    $ct_logo_tmp = $_FILES['ct_logo']['tmp_name'];
    $ct_logo_name = $_FILES['ct_logo']['name'];
    $ct_oldname = strrchr($_FILES['ct_logo']['name'], ".");
    $ct_logo_name = $date . $numrand . $ct_oldname;
    $ct_logo_type = $_FILES['ct_logo']['type'];
    $ct_logo_path = '../asset/contact/' . $ct_logo_name;
    $ct_logo = 'asset/contact/' . $ct_logo_name;

    // ไฟล์ภาพ1
    $ct1_picc = $_FILES['ct1_pic']['tmp_name'];
    $ct1_oldname = strrchr($_FILES['ct1_pic']['name'], ".");
    $ct1_pic_name = $date . $numrand . $ct1_oldname;
    $ct1_pic_type = $_FILES['ct1_pic']['type'];
    $ct1_path = '../asset/contact/' . $ct1_pic_name;
    $ct1_pic = 'asset/contact/' . $ct1_pic_name;

    // ไฟล์ภาพ2
    $ct2_picc = $_FILES['ct2_pic']['tmp_name'];
    $ct2_oldname = strrchr($_FILES['ct2_pic']['name'], ".");
    $ct2_pic_name = $date . $numrand . $ct2_oldname;
    $ct2_path = '../asset/contact/' . $ct2_pic_name;
    $ct2_pic = 'asset/contact/' . $ct2_pic_name;


    if (isset($ct_logo) != "" && isset($_POST["ct1_fname"]) != "" && isset($_POST["ct1_lname"]) != "" && isset($_POST["ct1_tel"]) != "" && isset($_POST["ct1_email"]) != "" && isset($ct1_pic) != "" && isset($_POST["ct2_fname"]) != "" && isset($_POST["ct2_lname"]) != "" && isset($_POST["ct2_tel"]) != "" && isset($_POST["ct2_email"]) != "" && isset($ct2_pic) != "") {
        $sqlInsert = "UPDATE contact  SET ct1_fname='$ct1_fname',ct1_lname='$ct1_lname',ct1_tel='$ct1_tel',ct1_email='$ct1_email',ct2_fname='$ct2_fname',ct2_lname='$ct2_lname',ct2_tel='$ct2_tel',ct2_email='$ct2_email'";
        mysqli_query($conn, $sqlInsert);

        if ($ct_logo_tmp != "") {
            $udlogo = "UPDATE contact  SET ct_logo ='$ct_logo'";
            mysqli_query($conn, $udlogo);
        }


        if ($ct1_picc != "") {
            $udpic1 = "UPDATE contact  SET ct1_pic ='$ct1_pic'";
            mysqli_query($conn, $udpic1);
        }


        if ($ct2_picc != "") {
            $udpic2 = "UPDATE contact  SET ct2_pic ='$ct2_pic'";
            mysqli_query($conn, $udpic2);
        }

        move_uploaded_file($ct_logo_tmp, $ct_logo_path);
        move_uploaded_file($ct1_picc, $ct1_path);
        move_uploaded_file($ct2_picc, $ct2_path);
        echo "<script>alert('ลงทะเบียนสำเร็จ');</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง);</script>";
    }
}

$sql = "SELECT * FROM contact ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
extract($row);
mysqli_close($conn);
?>