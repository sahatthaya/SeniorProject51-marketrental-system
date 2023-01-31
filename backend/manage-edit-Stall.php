<?php

include "../backend/1-connectDB.php";





// edit stall info----------------------------------------------------------------



if (isset($_POST['edtStall-submit'])) {

    $sKey = $_POST["sKey"];

    $sWidth = $_POST['sWidth'];

    $sHeight = $_POST['sHeight'];

    $sDept = $_POST['sDept'];

    $sPayRange ='บาท/วัน';

    $sRent = $_POST['sRent'];

    $z_id = $_POST['z_id'];



    if (!isset($_POST['show'])) {

        $show = "0";

    } else {

        $show = "1";

    }



    if (isset($_POST['sWidth']) != "" && isset($_POST['sHeight']) != "" && isset($_POST['sDept']) != "" && $show != "") {

        $sqlInsert = "UPDATE `stall` SET `sKey`=$sKey,`sID`='$sID',`sWidth`='$sWidth',`sHeight`='$sHeight',`sDept`='$sDept',`sRent`='$sRent',`sPayRange`='$sPayRange',`z_id`='$z_id',`show`='$show' WHERE (sKey = '$sKey') ";

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



