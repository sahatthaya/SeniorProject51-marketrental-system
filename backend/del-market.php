<?php

include "1-connectDB.php";

include "../backend/1-import-link.php";



if (isset($_GET['mkr_id'])) {

    $mkr_id = $_GET['mkr_id'];



    $sqlDelUsers = "UPDATE `market_detail` SET `a_id`='2'WHERE mkr_id = $mkr_id";

    $rsDelUsers = mysqli_query($conn, $sqlDelUsers);

    if ($rsDelUsers) {

        echo "<script>delsuccessmarket();</script>";

        echo "<script>window.location='../users-market/index.php';</script>";

        

    } 

}

