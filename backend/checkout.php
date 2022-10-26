<?php
$total = $_POST['total'];
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

if ($status == 'successful') {
    // success
    echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    echo ' <script>
    setTimeout(function() {
     swal({
         title: "ชำระเงินสำเร็จ",
         type: "success"
     }, function() {
         window.location = "./index.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';
} else {
    // error
}
