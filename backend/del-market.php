<?php
include "1-connectDB.php";

if (isset($_GET['mkr_id'])) {
    $mkr_id = $_GET['mkr_id'];

    $sqlDelUsers = "UPDATE `market_detail` SET `a_id`='2'WHERE mkr_id = $mkr_id";
    $rsDelUsers = mysqli_query($conn, $sqlDelUsers);
    if ($rsDelUsers) {
        echo "<script>alert('ลบข้อมูลตลาดเสร็จสิ้น');window.location = '../users-market/index.php';</script>";
        mysqli_close($conn);
    } else {
        echo "<script>alert ('ผิดพลาด ไม่สามารถลบข้อมูลได้ .$mkr_id.');window.location = '../users-market/index.php';</script>";
    }
}
