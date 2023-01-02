<?php
// ส่งข้อมูลคำร้อง
if (isset($_POST['submit-apply'])) {
    $firstName = $_POST['firstName'];
    $laststName = $_POST['lastName'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $mkrName = $_POST['mkrName'];
    $mkrtype = $_POST['mkrtype'];
    $mkrDes = $_POST['mkrDes'];
    $userlogin = $_SESSION['users_id'];
    $opening = $_POST['opening'];
    $min_rent = $_POST['min_rent'];

    $house_no = $_POST['HouseNo'];
    $soi = $_POST['Soi'];
    $moo = $_POST['Moo'];
    $road = $_POST['Road'];
    $province_id = $_POST['province_id'];
    $amphure_id = $_POST['amphure_id'];
    $district_id = $_POST['district_id'];
    $postalcode = $_POST['PostalCode'];

    date_default_timezone_set('Asia/Bangkok');
    $date = date("Ymd");
    $numrand = (mt_rand());
    // ไฟล์ภาพตลาด
    $mkrfiletmp = $_FILES['mkrFile']['tmp_name'];
    $mkrfileoldname = strrchr($_FILES['mkrFile']['name'], ".");
    $mkrfilename = $date . $numrand . $mkrfileoldname;
    $mkrfiletype = $_FILES['mkrFile']['type'];
    $mkrfilepath = 'asset/img_market/' . $mkrfilename;
    $mkrpath = '../asset/img_market/' . $mkrfilename;
    // ไฟล์ภาพบัตรปชช
    $idfiletmp = $_FILES['cardIDcpy']['tmp_name'];
    $idfilenameoldname = strrchr($_FILES['cardIDcpy']['name'], ".");
    $idfilename = $date . $numrand . $idfilenameoldname;
    $idfiletype = $_FILES['cardIDcpy']['type'];
    $idfilepath = 'asset/idcard/' . $idfilename;
    $idpath = '../asset/idcard/' . $idfilename;


    if (
        isset($_POST["firstName"]) != "" && isset($_POST["lastName"]) != "" && isset($_POST["email"]) != "" && isset($_POST["tel"]) != ""
        && isset($idfilepath) != "" && isset($_POST["mkrName"]) != "" && isset($_POST["mkrtype"]) != "" && isset($mkrfilepath) != ""
        && isset($opening) != "" && isset($min_rent) != ""
    ) {
        move_uploaded_file($mkrfiletmp, $mkrpath);
        move_uploaded_file($idfiletmp, $idpath);
        $sqlInsert = "INSERT INTO req_partner (`market_name`, `market_descrip`, `market_pic`, `market_type_id`, `req_status_id`, `firstName`, `lastName`, `email`, `tel`, `cardIDcpy`, `users_id`, `house_no`, `soi`, `moo`, `road`, `district_id`, `amphure_id`, `province_id`, `postalcode`,`opening`,`min_rent`)
        VALUES ('$mkrName','$mkrDes','$mkrfilepath',' $mkrtype','1','$firstName','$laststName',' $email',' $tel', '$idfilepath','$userlogin','$house_no','$soi','$moo','$road','$district_id','$amphure_id','$province_id','$postalcode','$opening','$min_rent') ";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script type='text/javascript'> partnersuccess(); </script>";
            echo '<meta http-equiv="refresh" content="1";/>';
        } else {
            echo "<script type='text/javascript'> error(); </script>";
        }
    }
}

if (isset($_POST['bn-submit'])) {
    $bn_toppic = $_POST['bn_toppic'];
    $bn_detail = $_POST['bn_detail'];

    date_default_timezone_set('Asia/Bangkok');
    $date = date("Ymd");
    $numrand = (mt_rand());
    // ไฟล์ภาพ
    $bn_tmp = $_FILES['bn_img']['tmp_name'];
    $bn_nameoldname = strrchr($_FILES['bn_img']['name'], ".");
    $bn_name = $date . $numrand . $bn_nameoldname;
    $bn_type = $_FILES['bn_img']['type'];
    $bn_img = 'asset/banner/' . $bn_name;
    $bnpath = '../asset/banner/' . $bn_name;
    if (isset($_POST["bn_toppic"]) != "" && isset($_POST["bn_detail"]) != "" && isset($_POST["bn_toppic"]) != "" && isset($bn_img) != "") {
        move_uploaded_file($bn_tmp, $bnpath);
        $sqlInsert = "INSERT INTO req_annouce(bn_toppic, bn_detail, bn_pic,users_id) VALUES ('$bn_toppic', '$bn_detail', '$bn_img', $users_id)";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script type='text/javascript'> partnersuccess(); </script>";
            echo '<meta http-equiv="refresh" content="1";/>';
            mysqli_close($conn);
        } else {
            echo "<script type='text/javascript'> error(); </script>";
        }
    } else {
        echo "<script type='text/javascript'> error(); </script>";
    }
}
