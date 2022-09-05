<?php
include "../backend/1-connectDB.php";

if (isset($_GET['mkr_id'])) {
    $mkr_id = $_GET['mkr_id'];
    $sql = "SELECT * FROM market_detail WHERE (a_id='1' AND mkr_id = '$mkr_id') ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    extract($row);

    $userid = $_SESSION['users_id'];
    $sqlqry = "SELECT * FROM payment_info WHERE (mkr_id = '$mkr_id') ";
    $qry = mysqli_query($conn, $sqlqry);
    $row = mysqli_fetch_array($qry);
}

if (isset($_POST['submit-apply'])) {
    $p_name = $_POST['p_name'];
    $p_surname = $_POST['p_surname'];
    $p_promtpay = $_POST['p_promtpay'];
    $p_bank = $_POST['p_bank'];
    $p_account = $_POST['p_account'];
    $p_id = $_POST['p_id'];

    if ( isset($_POST["p_name"]) != "" && isset($_POST["p_surname"]) != "" && isset($_POST["p_promtpay"]) != "" && isset($_POST["p_bank"]) != ""&& isset($_POST["p_account"]) != "") {
        $update = 
        "UPDATE payment_info 
        SET p_name = '$p_name' , p_surname = '$p_surname' , p_promtpay = '$p_promtpay' , p_bank = '$p_bank' , p_account = '$p_account' 
        WHERE (p_id = $p_id);";
        $sqlUD = mysqli_query($conn, $update);
        if ($sqlUD) {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1";/>';
        } else {
            echo "<script type='text/javascript'> error(); </script>";
        }
    } else {
        echo "<script type='text/javascript'> error(); </script>";
    }
}
