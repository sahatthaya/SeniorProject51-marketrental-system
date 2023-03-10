<?php

include "../backend/1-connectDB.php";

require_once "../backend/1-import-link.php";

// tb rqan query

$count_n = 1;

$data2 = "SELECT * FROM req_annouce JOIN users ON (req_annouce.users_id = users.users_id)JOIN market_detail ON (market_detail.mkr_id = req_annouce.mkr_id) WHERE (req_status_id = '1') ORDER BY `timestamp` DESC";

$result3 = mysqli_query($conn, $data2);

$data3 = "SELECT * FROM req_annouce JOIN users ON (req_annouce.users_id = users.users_id)JOIN market_detail ON (market_detail.mkr_id = req_annouce.mkr_id)JOIN req_status ON (req_annouce.req_status_id = req_status.req_status_id) ORDER BY `timestamp` DESC";


$result4 = mysqli_query($conn, $data3);





if (isset($_GET['approve'])) {

    $approveid = $_GET['approve'];

    $sqlqry = "SELECT * FROM req_annouce WHERE (req_an_id = '$approveid') ";

    $qry = mysqli_query($conn, $sqlqry);

    $row = mysqli_fetch_array($qry);

    extract($row);

    $bn_toppic = $row['bn_toppic'];

    $bn_detail = $row['bn_detail'];

    $bn_pic = $row['bn_pic'];
    $mkr_id = $row['mkr_id'];

    $bn_link = 'market-info.php?mkr_id=' . $mkr_id;




    $approve = "UPDATE req_annouce SET req_status_id = '2' WHERE (req_an_id = $approveid)";

    $insert = "INSERT INTO banner (bn_toppic,bn_detail,bn_pic,bn_link) VALUES ('$bn_toppic','$bn_detail','$bn_pic','$bn_link')";
    $mkrname = $_GET['mkrname'];
    $usersid = $_GET['usersid'];
    $n_detail = "คำร้องขอประชาสัมพันธ์ได้รับการอนุมัติ";
    $insertnoti = mysqli_query($conn, "INSERT INTO `notification`(`n_sub`, `n_detail`,`status`, `type`, `fk_id`, `users_id`)
    VALUES (' $mkrname','$n_detail','1','1','$approveid','$usersid')");

    if ($ql = mysqli_query($conn, $approve) && $isql = mysqli_query($conn, $insert)) {

        echo "<script>ApprovesuccessAN();</script>";
    } else {

        echo "<script>error();</script>";
    }
}



if (isset($_GET['denied'])) {

    $deniedid = $_GET['denied'];

    $denied = "UPDATE req_annouce SET req_status_id = '3' WHERE (req_an_id = $deniedid)";

    $mkrname = $_GET['mkrname'];
    $usersid = $_GET['usersid'];
    $n_detail = "คำร้องขอประชาสัมพันธ์ถูกปฎิเสธ";
    $insertnoti = mysqli_query($conn, "INSERT INTO `notification`(`n_sub`, `n_detail`,`status`, `type`, `fk_id`, `users_id`)
    VALUES (' $mkrname','$n_detail','1','1','$deniedid','$usersid')");

    if (mysqli_query($conn, $denied)) {

        echo "<script>DeninedsuccessAN();</script>";
    } else {

        echo "<script>error();</script>";
    }
}

mysqli_close($conn);
