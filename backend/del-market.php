<?php
include "1-connectDB.php";

if (isset($_GET['mkr_id'])) {
    $mkr_id = $_GET['mkr_id'];

    $sqlDelUsers = "UPDATE `market_detail` SET `a_id`='2'WHERE mkr_id = $mkr_id";
    $rsDelUsers = mysqli_query($conn, $sqlDelUsers);
    if ($rsDelUsers) {
        echo "<script>delsuccess();</script>";
        mysqli_close($conn);
    } 
}
