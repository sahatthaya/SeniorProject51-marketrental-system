<?php
include "1-connectDB.php";

if (isset($_GET['mkr_id'])) {
    $mkr_id = $_GET['mkr_id'];
    // ลบข้อมูลที่เกี่ยวกับตลาด
    $delcomplain = "DELETE FROM `complain` WHERE mkr_id = $mkr_id";
    $sqldelcomp = mysqli_query($conn, $delcomplain);

    $delCU = "DELETE FROM `cost/unit` WHERE mkr_id = $mkr_id";
    $sqldelCU = mysqli_query($conn, $delCU);

    $sqlDelUsers = "DELETE FROM `market_detail` WHERE mkr_id = $mkr_id";
    $rsDelUsers = mysqli_query($conn, $sqlDelUsers);
    if ($sqldelcomp && $rsDelUsers && $sqldelCU) {
        echo "<script>alert('ลบข้อมูลเสร็จสิ้น');window.location = '../users-market/index.php';</script>";
        mysqli_close($conn);
    } else {
        echo "<script>alert ('ผิดพลาด ไม่สามารถลบข้อมูลได้');window.location = '../users-market/index.php';</script>";
    }
}
