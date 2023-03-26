<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - ประกาศถึงผู้เช่า</title>



    <link rel="stylesheet" href="../css/applicant.css" type="text/css">

</head>

<?php

include "profilebar.php";

?>

<?php

include "nav.php";

include "../backend/1-connectDB.php";

$mkr_id = $_GET['mkr_id'];
$n_id = $_GET['n_id'];

$sql = "SELECT market_detail.*,users.username ,

    provinces.province_name,

    amphures.amphure_name,

    districts.district_name , 

    market_type.market_type

    FROM market_detail 

        JOIN users ON (market_detail.users_id = users.users_id)

        JOIN provinces ON (market_detail.province_id = provinces.id)

        JOIN amphures ON (market_detail.	amphure_id = amphures.id)

        JOIN districts ON (market_detail.district_id = districts.id)

        JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)

         WHERE (a_id='1' AND mkr_id = '$mkr_id') ";

$result = mysqli_query($conn, $sql);

$row1 = mysqli_fetch_array($result);

extract($row1);

$resultnews = mysqli_query($conn, "select * from `notification` where `n_id` = $n_id ");

$row2 = mysqli_fetch_array($resultnews);

extract($row2);
?>



<body>
    <h1 id="headline">ประกาศถึงผู้เช่าตลาด <?php echo $row1['mkr_name']; ?></h1>


    <form id="applyform" method="POST" enctype="multipart/form-data" class="was-validated">

        <div class="form-outer" style="overflow: visible;">

            <!-- form--1 -->

            <div id="stepOne" class="row border shadow-sm p-5 mt-3 mb-3 rounded">

                <div class="des_input mb-3">เรียน ผู้เช่าแผงค้าในตลาด<?php echo $row1['mkr_name']; ?></div>

                <div class="mb-3 fs-5"><?php echo $row2['n_detail']; ?></div>

                <div class="text-end des_input">ด้วยความเคารพ <br> ตลาด<?php echo $row1['mkr_name']; ?></div>

            </div>

        </div>

    </form>
</body>

</html>