<?php

include '../backend/1-import-link.php';

include '../backend/1-connectDB.php';



$total = $_POST['total'];

$stall_id = $_POST['stall_id'];

$b_fname = $_POST['firstName'];

$b_lname = $_POST['lastName'];

$b_tel = $_POST['tel'];

$b_email = $_POST['email'];

$shopname = $_POST['storeName'];

$op_id = $_POST['op_id'];

$shop_detail = $_POST['shopdes'];

$dept_pay = $_POST['dept_pay'];

$users_id = $_POST['users_id'];

$fee_pay = $_POST['fee_pay'];



// ไฟล์ภาพบัตรปชช

date_default_timezone_set('Asia/Bangkok');

$date = date("Ymd");

$numrand = (mt_rand());

$cardID_copytmp = $_FILES['cardIDcpy']['tmp_name'];

$cardID_copyoldname = strrchr($_FILES['cardIDcpy']['name'], ".");

$cardID_copyname = $date . $numrand . $cardID_copyoldname;

$cardID_copytype = $_FILES['cardIDcpy']['type'];

$cardID_copy = 'asset/idcard/' . $cardID_copyname;

$cardID_copypath = '../asset/idcard' . $cardID_copyname;



require_once dirname(__FILE__) . '/omise-php/lib/Omise.php';

define('OMISE_API_VERSION', '2015-11-17');

define('OMISE_PUBLIC_KEY', 'pkey_test_5tl2v3azqsf7i7u6hlm');

define('OMISE_SECRET_KEY', 'skey_test_5tl2v3ctzvi24z5bpg4');



$charge = OmiseCharge::create(array(

    'amount' => $total,

    'currency' => 'thb',

    'card' => $_POST["omiseToken"]

));



$status = ($charge['status']);

$code_id = ($charge['id']);

@$total_pay = $total / 100;



if ($status == 'successful') {

    if (isset($b_fname) && isset($b_lname) && isset($cardID_copytmp) && isset($b_tel) && isset($b_email) && isset($shopname) && isset($op_id) && isset($shop_detail) && isset($dept_pay) && isset($stall_id) != '') {

        $resultop = mysqli_query($conn, "SELECT * FROM `opening_period` WHERE `id`='$op_id'");

        $rowop = mysqli_fetch_array($resultop);

        extract($rowop);

        $b_start = $rowop['start'];
        $b_end = $rowop['end'];
        $b_day = $rowop['day'];


        $insertbooking = mysqli_query($conn, "
        INSERT INTO `booking`(`b_fname`, `b_lname`, `b_cardID`, `b_tel`, `b_email`, `b_shopname`, `b_shopdetail`, `stall_id`, `b_start`, `b_end`, `b_day`, `op_id`, `b_deptpay`, `b_feepay`, `b_totalpay`, `b_codepay`, `users_id`)
        VALUES ('$b_fname','$b_lname','$cardID_copy','$b_tel','$b_email','$shopname','$shop_detail','$stall_id', '$b_start', '$b_end', '$b_day', '$op_id','$dept_pay','$fee_pay','$total_pay','$code_id','$users_id')");


        $last_id = mysqli_query($conn, "SELECT MAX(b_id) AS maxid FROM booking");
        $mid = mysqli_fetch_array($last_id);
        extract($mid);
        $fk_id = $mid['maxid'];
        $start = date("d/m/Y", strtotime($b_start));
        $end = date("d/m/Y", strtotime($b_end));
        $n_detail = 'มีการจองใหม่ในช่วงวันที่ ' . $start . '-' . $end;
        $market_name = $_POST['market_name'] . ' (แผงค้า : ' . $stall_id . ' )';
        $usersmkr_id = $_POST['usersmkr_id'];
        $insertnoti = mysqli_query($conn, "INSERT INTO `notification`(`n_sub`, `n_detail`,`status`, `type`, `fk_id`, `users_id`)
        VALUES ('$market_name','$n_detail','1','5','$fk_id','$usersmkr_id')");


        if ($insertbooking) {

            move_uploaded_file($cardID_copytmp, $cardID_copypath);

            echo '<script>pay_dept_success()</script>';
        } else {
            echo '<script>errorpay()</script>';
        }
    } else {

        echo '<script>errorpay()</script>';
    }
} else {

    echo '<script>errorpay()</script>';
}
