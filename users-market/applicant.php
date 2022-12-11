<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - ส่งคำร้องขอเพิ่มตลาดใหม่</title>

    <link rel="stylesheet" href="../css/applicant.css" type="text/css">
</head>
<?php
include "profilebar.php";
?>
<?php
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";

$userid = $_SESSION['users_id'];
$sqlqry = "SELECT * FROM users WHERE (users_id = '$userid') ";
$qry = mysqli_query($conn, $sqlqry);
$row = mysqli_fetch_array($qry);

$query_mkrType = "SELECT * FROM market_type ORDER BY market_type_id";
$result_mkrType = mysqli_query($conn, $query_mkrType);
$query_province = "SELECT * FROM provinces";
$result_province = mysqli_query($conn, $query_province);

require "../backend/add-applicant.php"
?>

<body class="mt-5">
    <h1 id="headline">กรอกข้อมูลเพื่อส่งคำร้องขอเพิ่มตลาดใหม่</h1>
    <?php
    include_once "./applicant-form.php";
    ?>
    <script src="../backend/script.js"></script>
    <script src="script.js"></script>

</body>
<script>
    $(document).ready(function() {
        $("body").tooltip({
            selector: '[data-toggle=tooltip]',
            placement: 'right'
        });
    });
    $(":input").inputmask();

    $("#tel").inputmask({
        "mask": "9999999999"
    });
    $("#zip-code").inputmask({
        "mask": "99999"
    });
</script>

</html>