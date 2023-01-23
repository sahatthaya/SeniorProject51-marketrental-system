<?php
include '../backend/1-import-link.php';
include '../backend/1-connectDB.php';

$total = $_POST['total'];
$totalcal = $total * 100;
$price = $_POST['price'];
$users_id = $_POST['users_id'];
$inv_id = $_POST['inv_id'];
$fee_pay = $_POST['fee'];

require_once dirname(__FILE__) . '/omise-php/lib/Omise.php';
define('OMISE_API_VERSION', '2015-11-17');
define('OMISE_PUBLIC_KEY', 'pkey_test_5tl2v3azqsf7i7u6hlm');
define('OMISE_SECRET_KEY', 'skey_test_5tl2v3ctzvi24z5bpg4');

$charge = OmiseCharge::create(array(
    'amount' => $totalcal,
    'currency' => 'thb',
    'card' => $_POST["omiseToken"]
));

$status = ($charge['status']);
$id = ($charge['id']);
if ($status == 'successful') {
    $insertbooking = mysqli_query($conn, "INSERT INTO `invoice_paid`( `inv_id`, `price`, `fee`, `total`, `token_pay`,  `users_id`) 
    VALUES ('$inv_id','$price','$fee_pay','$total','$id','$users_id')");

    $updateinv = mysqli_query($conn, "UPDATE `invoice` SET `INV_status`='2' WHERE `INV_id` = $inv_id");

    if ($insertbooking) {
        echo '<script>pay_rent_success()</script>';
    } else {
        echo '<script>errorpay()</script>';
    }
} else {
    echo '<script>errorpay()</script>';
}
