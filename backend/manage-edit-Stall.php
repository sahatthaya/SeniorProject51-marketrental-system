<?php
include "../backend/1-connectDB.php";


// edit stall info----------------------------------------------------------------

if (isset($_POST['edtStall-submit'])) {
    $sKey = $_POST["sKey"];
    $sWidth = $_POST['sWidth'];
    $sHeight = $_POST['sHeight'];
    $sDept = $_POST['sDept'];
    $sPayRange = $_POST['sPayRange'];
    $sRent = $_POST['sRent'];
    $z_id = $_POST['z_id'];

    if (!isset($_POST['show'])) {
        $show = "0";
    } else {
        $show = "1";
    }

    if (isset($_POST['sWidth']) != "" && isset($_POST['sHeight']) != "" && isset($_POST['sDept']) != "" && isset($_POST['sPayRange']) != "" && $show != "") {
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

// update cost/unit----------------------------------------------------------------
if (isset($_POST['editcost'])) {
    $cu_id = $_POST['cu_id'];
    $cu_name = $_POST['cu_name'];
    $cu_price = $_POST['cu_price'];
    $cu_type = $_POST['cu_type'];

    if (isset($cu_id) != '' && isset($cu_name) != '' && isset($cu_price) != '' && isset($cu_type) != '') {
        $updatesql = mysqli_query($conn, "UPDATE `cost/unit` SET cu_name ='$cu_name',`cu_price`='$cu_price',`cu_type`='$cu_type' WHERE (`cu_id` = '$cu_id')");

        if ($updatesql != '') {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1"; />';
        } else {
            echo "<script type='text/javascript'> error(); </script>";
        }
    } else {
        echo "<script type='text/javascript'> error(); </script>";
    }
}
