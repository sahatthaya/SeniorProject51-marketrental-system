<?php
include "connectDB.php";

if ($_GET) {
    $mkr_id = $_GET['mkr_id'];
    $sqlDelUsers = "DELETE FROM market_detail WHERE (mkr_id = $mkr_id)";
    if($rsDelUsers = mysqli_query($conn, $sqlDelUsers)){
       echo "<script>alert('ลบข้อมูลเสร็จสิ้น');window.location = '../users-market/index.php';</script>" ;
       mysqli_close($conn);
    }else{
        echo "<script>alert ('ผิดพลาด ไม่สามารถลบข้อมูลได้');window.location = 'market-index.php';</script>" ;
    }
}
?>
