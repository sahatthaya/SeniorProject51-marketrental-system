<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - ภาพรวมตลาด</title>

    <!-- css  -->
    <link rel="stylesheet" href="../css/overview.css" type="text/css">

</head>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
$mkr_id = $_GET['mkr_id'];
$count_n = 1;
$data2 = "SELECT stall.*, zone.* FROM stall JOIN zone ON (stall.z_id = zone.z_id) WHERE (market_id = '$mkr_id')";
$result3 = mysqli_query($conn, $data2);
$costunit = "SELECT * FROM `cost/unit` WHERE mkr_id = '$mkr_id'";
$resultCU = mysqli_query($conn, $costunit);
$numCU = mysqli_num_rows($resultCU);
$z_qry = "SELECT * FROM `zone`";
$z = mysqli_query($conn, $z_qry);
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
$row = mysqli_fetch_array($result);
extract($row);
?>
<script src="../backend/script.js"></script>
<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var options = {
            width: 500,
            height: 300,
            animation: {
                duration: 1000,
                easing: 'out'
            },
            backgroundColor: '',
            chartArea: {
                'left': 15,
                'top': 15,
                'right': 0,
                'bottom': 0
            },
            fontSize: '16',

        };
        var data = google.visualization.arrayToDataTable([
            ['ประเภทแผงค้า', 'จำนวนแผงค้า'],
            <?php
            $queryz = "SELECT zone.* , COUNT(stall.z_id) AS countZ  FROM stall JOIN zone ON (stall.z_id = zone.z_id) WHERE (market_id = '$mkr_id') GROUP BY stall.z_id ";
            $rsz = mysqli_query($conn, $queryz);
            foreach ($rsz as $rs_c) {
                echo "['" . $rs_c['z_name'] . "'," . $rs_c['countZ'] . "],";
            }
            ?>

        ]);
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
    $(window).resize(function() {
        drawBackgroundColor();
        drawChart();
    });
</script>


<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">ภาพรวมตลาด <?php echo $row['mkr_name']; ?></li>
        </ol>
    </nav>

    <h1>ภาพรวมตลาด <?php echo $row['mkr_name']; ?></h1>
    <div class="border rounded shadow-sm mt-4 p-3 box">
        <img src="../<?php echo $row['mkr_pic'] ?>" class="rounded" alt="">
        <div>
            <div class="d-flex justify-content-between ">
                <h3 class="mt-2 mb-0"><?php echo $row['mkr_name']; ?></h3>
                <a href="edit-market-info.php?mkr_id=<?php echo $row['mkr_id'] ?>" type="button" class="btn btn-primary " style="height: fit-content;"><i class="bx bxs-edit-alt"></i> แก้ไขข้อมูลตลาด</a>
            </div>
            <hr class="my-2">
            <div class="box mt-4 pe-3">
                <div>
                    <p class="fs-5 mb-0">
                    <div class="fw-bold">ประเภทตลาด</div> <?php echo $row['market_type']; ?>
                    </p>
                    <p class="fs-5 mb-0">
                    <div class="fw-bold">เบอร์โทรศัพท์</div> <?php echo $row['tel']; ?>
                    </p>
                    <p class="fs-5 mb-0">
                    <div class="fw-bold">อีเมล</div>
                    <a href="mailto:<?php echo $row['email'] ?>">
                        <?php echo $row['email']; ?>
                    </a>
                    </p>

                </div>
                <div>
                    <p class="fs-5 mb-0">
                    <div class="fw-bold">รายละเอียดโดยสังเขป</div> <?php echo $row['mkr_descrip']; ?>
                    </p>
                    <p class="fs-5 mb-0">
                    <div class="fw-bold">สถานที่ตั้ง</div> <?php echo $row['house_no']; ?> ซอย <?php echo $row['soi']; ?> หมู่ <?php echo $row['moo']; ?> ถนน <?php echo $row['road']; ?> ตำบล/แขวง <?php echo $row['district_name']; ?> อำเภอ/เขต <?php echo $row['amphure_name']; ?> จังหวัด <?php echo $row['province_name']; ?> รหัสไปรษณีย์ <?php echo $row['postalcode']; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- content -->
    <div class="top">
        <div class="border rounded shadow-sm p-3 mt-3">
            <h3>จำนวนของแผงค้าในแต่ละประเภท</h3>
            <div class="chartcanvas center mt-5 ms-5" id="piechart"></div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $("body").tooltip({
            selector: '[data-toggle=tooltip]',
            placement: 'right'
        });
    });
</script>

</html>