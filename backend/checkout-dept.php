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
$start = strtr($_REQUEST['start'], '/', '-');
$b_start =  date("Y/m/d", strtotime($start));
$end = strtr($_REQUEST['end'], '/', '-');
$b_end =  date("Y/m/d", strtotime($end));
$shop_detail = $_POST['shopdes'];
$dept_pay = $_POST['dept_pay'];
$users_id = $_POST['users_id'];
$fee_pay = $_POST['fee_pay'];
// คำนวนจำนวนวัน
$startcal  = date('Y-m-d', strtotime($b_start));
$endcal  = date('Y-m-d', strtotime($b_end));
$day = floor((strtotime($endcal) - strtotime($startcal)) /  (60 * 60 * 24) + 1);

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
$id = ($charge['id']);
@$total_pay = $total/100;
if ($status == 'successful') {
    if (isset($b_fname) && isset($b_lname) && isset($cardID_copytmp) && isset($b_tel) && isset($b_email) && isset($shopname) && isset($b_start) && isset($b_end) && isset($day) && isset($shop_detail) && isset($dept_pay) && isset($stall_id) != '') {
        $insertbooking = mysqli_query($conn, "INSERT INTO `booking_range`(`b_fname`, `b_lname`, `cardID_copy`, `b_tel`, `b_email`, `shopname`, `start`, `end`, `day`, `shop_detail`, `dept_pay`, `fee_pay`,`total_pay`,`code_pay`,`stall_id`,`users_id`)
        VALUES('$b_fname','$b_lname','$cardID_copy','$b_tel','$b_email','$shopname','$b_start','$b_end','$day','$shop_detail','$dept_pay','$fee_pay','$total_pay','$id','$stall_id','$users_id')");

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
