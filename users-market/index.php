<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />

    <title> MarketRental - คำร้องขอเพิ่มตลาดใหม่</title>

    <link rel="stylesheet" href="../css/applicant.css" type="text/css">
    <link rel="stylesheet" href="../css/overview.css" type="text/css">


</head>

<?php

include "profilebar.php";

?>

<?php

include "nav.php";

include "../backend/1-connectDB.php";

require "../backend/graph-market.php";

include "../backend/qry-overview.php";



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



<body>

    <?php
    if ($numRows <= 0) {
        echo '  <h1 id="headline">ยินดีต้อนรับ! กรอกข้อมูลเพื่อส่งคำร้องขอเพิ่มตลาดใหม่</h1>';
        include_once "./applicant-form.php";
    } else {
        include_once "./overview.php";
    }

    ?>

    <script src="../backend/script.js"></script>

    <script src="script.js"></script>



</body>





</html>