<?php
$mkr_id = $_GET['mkr_id'];
$count_n = 1;
$data2 = "SELECT stall.*, zone.* FROM stall JOIN zone ON (stall.z_id = zone.z_id) WHERE (market_id = '$mkr_id' AND `show` = '1')";
$result3 = mysqli_query($conn, $data2);
$zone = mysqli_query($conn, "SELECT * FROM `zone`");
$sql = "SELECT market_detail.*,users.username ,
provinces.province_name,
amphures.amphure_name,
districts.district_name , 
market_type.market_type
FROM market_detail 
    JOIN users ON (market_detail.users_id = users.users_id)
    JOIN provinces ON (market_detail.province_id = provinces.id)
    JOIN amphures ON (market_detail.	amphure_id = amphures.id)
    JOIN districts ON (market_detail.district_id = districts.id)
    JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)
     WHERE (a_id='1' AND mkr_id = '$mkr_id') ";
$result = mysqli_query($conn, $sql);
$rowmkp = mysqli_fetch_array($result);
extract($rowmkp);


// // แบบแก้ไซส์ได้
// if (isset($_POST['save'])) {
//     $numRows = mysqli_num_rows($result3);
//     for ($i = 1; $i <= $numRows; $i++) {
//         $idi = "id$i";
//         $lefti = "left$i";
//         $topi = "top$i";
//         $wi = "w$i";
//         $hi = "h$i";
//         $id = $_POST[$idi];
//         $left = $_POST[$lefti];
//         $top = $_POST[$topi];
//         $w = $_POST[$wi];
//         $h = $_POST[$hi];
//         if (isset($id) && isset($top) && isset($left) && isset($w) && isset($h)) {
//             $InsertSameCrop = mysqli_query($conn, "UPDATE `stall` SET `left`='$left',`top`='$top',`width`='$w',`height`='$h' WHERE `sKey`= '$id'");
//             if ($InsertSameCrop) {
//             } else {
//                 echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง')</script>";
//             }
//         } else {
//             echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง ไม่พบข้อมูลความกว้าง + ยาว')</script>";
//         }
//     }
//     echo "<script>alert('ok')</script>";
// }

if (isset($_POST['save'])) {
    $numRows = mysqli_num_rows($result3);
    for ($i = 1; $i <= $numRows; $i++) {
        $idi = "id$i";
        $lefti = "left$i";
        $topi = "top$i";
        $id = $_POST[$idi];
        $left = $_POST[$lefti];
        $top = $_POST[$topi];
        if (isset($id) && isset($top) && isset($left)) {
            $InsertSameCrop = mysqli_query($conn, "UPDATE `stall` SET `left`='$left',`top`='$top' WHERE `sKey`= '$id'");
            if ($InsertSameCrop) {
            } else {
                echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง')</script>";
            }
        } else {
            echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง ไม่พบข้อมูล')</script>";
        }
    }
    echo "<script type='text/javascript'> success(); </script>";
    echo '<meta http-equiv="refresh" content="1"; URL=../users-market/edit-stall.php" />';
}

if (isset($_POST['save-ratio'])) {
    $ratio = $_POST['ratio'];
    if (isset($ratio) != "") {
        $udratio = mysqli_query($conn, "UPDATE `market_detail` SET `ratio_plan`='$ratio' WHERE mkr_id = '$mkr_id'");
        if ($udratio) {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1"; URL=../users-market/edit-stall.php" />';
        } else {
            echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง')</script>";
        }
    } else {
        echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง ไม่พบข้อมูล')</script>";
    }
}
