<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - คำร้องขอเพิ่มตลาดใหม่</title>



    <link rel="stylesheet" href="../css/applicant.css" type="text/css">

</head>

<?php

include "profilebar.php";

?>

<?php

include "nav.php";

include "../backend/1-connectDB.php";

$mkr_id = $_GET['mkr_id'];

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


$resultnews = mysqli_query($conn, "select * from `notification` where `fk_id` = $mkr_id ");


?>



<body>
    <nav aria-label="breadcrumb mb-3">

        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php?mkr_id=<?php echo $row1['mkr_id']; ?>" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item fs-5 "><a href="./booking.php?mkr_id=<?php echo $mkr_id ?>" class="text-decoration-none">การจองทั้งหมด <?php echo $row1['mkr_name']; ?></a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">ประวัติการสร้างประกาศถึงผู้เช่า</li>
        </ol>

    </nav>
    <h1 id="headline">ประวัติการสร้างประกาศถึงผู้เช่า</h1>



    <!-- form--1 -->

    <div id="table" class="bannertb border p-3 shadow-sm rounded mt-3">

        <table id="myTable" class="display table table-striped dt-responsive  " style="width: 100%;">

            <thead>

                <tr>

                    <th scope="col">ลำดับ</th>

                    <th scope="col">ส่งเมื่อวันที่</th>

                    <th scope="col">หัวข้อ</th>

                    <th scope="col">ข้อความ</th>

                </tr>

            </thead>

            <tbody>

                <?php
                $count_n = 1;
                while ($row = $resultnews->fetch_assoc()) : ?>

                    <tr>
                        <td><?php echo $count_n; ?></td>

                        <td><?php echo date("d/m/Y", strtotime($row['timestamp'])) ?></td>

                        <td><?php echo $row['n_sub'] ?></td>

                        <td><?php echo $row['n_detail'] ?></td>
                    </tr>

                <?php $count_n++;

                endwhile; ?>

            </tbody>

            </tbody>

        </table>

    </div>

</body>

</html>