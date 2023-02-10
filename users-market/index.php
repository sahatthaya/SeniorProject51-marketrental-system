<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/overview.css" type="text/css">

    <link rel="stylesheet" href="../css/applicant.css" type="text/css">

    <title> MarketRental - หน้าหลัก(เจ้าของตลาด)</title>

</head>



<?php

include "profilebar.php";

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



require "../backend/add-applicant.php";


if (isset($_GET['del_id'])) {
    $mkr_id = $_GET['del_id'];
    $qrybr = mysqli_query($conn, "SELECT booking_range.*,stall.market_id FROM `booking_range`JOIN stall ON (booking_range.stall_id = stall.sKey) WHERE market_id = $mkr_id");
    $qrybp = mysqli_query($conn, "SELECT booking_period .*,market_id FROM booking_period JOIN stall ON (booking_period.stall_id = stall.sKey) WHERE market_id = $mkr_id");
    $br = mysqli_num_rows($qrybr);
    $bp = mysqli_num_rows($qrybp);

    if ($br > 0 or $bp > 0) {
        echo "<script>errdelmkb();</script>";
    } else {
        $del = mysqli_query($conn, "UPDATE `market_detail` SET `a_id`='2' WHERE mkr_id = $mkr_id");
        if ($del) {
            echo "<script>delmk();</script>";
        } else {
            echo "<script>errdelmk();</script>";
        }
    }
}
?>



<body>

    <div <?php echo $showapp ?>>

        <h1>ยินดีต้อนรับ! กรอกข้อมูลเพื่อส่งคำร้องเพิ่มตลาดของคุณ</h1>

        <?php

        include_once "./applicant-form.php";

        ?>

    </div>

    </div>

    <div class="market" <?php echo $showmarket ?>>

        <h1>ตลาดของคุณ <?php echo $_SESSION['username'] ?></h1>

        <!-- market tap -->

        <ul class="nav nav-tabs list-group list-group-horizontal-sm">

            <?php while ($row1 = mysqli_fetch_assoc($taps)) : ?>

                <li class="nav-item list-group">

                    <a href="./index.php?mkr_id=<?php echo $row1['mkr_id'] ?>" class="nav-link fs-5 <?php echo ($row1['mkr_id'] == $first_market) ? 'active' : ''; ?>">

                        <?php echo $row1['mkr_name'] ?>

                    </a>

                </li>

            <?php

            endwhile ?>

        </ul>

        <!-- market menu -->

        <div class="border rounded mt-3 p-3 shadow-sm mrkmenu">

            <div class="row mrkmenu">

                <div class="col-md-3 mrkmenu-item">

                    <a href="edit-market-info.php?mkr_id=<?php echo $first_market ?>" class="mrkmenu-item w-100 btn btn-outline-primary ">

                        <i class="bx bxs-edit-alt"></i>

                        <span>แก้ไขข้อมูลตลาด</span>

                    </a>

                </div>

                <div class="col-md-3 mrkmenu-item">

                    <a href="finance.php?mkr_id=<?php echo $first_market ?>" class="mrkmenu-item w-100 btn btn-outline-primary ">

                        <i class="bx bxs-credit-card"></i>

                        <span>แก้ไขข้อมูลการเงิน</span>

                    </a>

                </div>

                <div class="col-md-3 mrkmenu-item">

                    <a href="edit-Stall.php?mkr_id=<?php echo $first_market ?>" class="mrkmenu-item w-100 btn btn-outline-primary ">

                        <i class="bx bx-map-alt"></i>

                        <span>แผนผังตลาด</span>

                    </a>

                </div>



                <div class="col-md-3 mrkmenu-item">

                    <a href="news.php?mkr_id=<?php echo $first_market ?>" class="mrkmenu-item w-100 btn btn-outline-primary ">

                        <i class="bx bxs-news"></i>

                        <span>ข่าวสาร</span>

                    </a>

                </div>

            </div>

            <div class="row mrkmenu2">

                <div class="col-md-3 mrkmenu-item">

                    <a href="booking.php?mkr_id=<?php echo $first_market ?>" class="mrkmenu-item w-100 btn btn-outline-primary">

                        <i class="bx bx-message-alt-edit"></i>

                        <span>การจอง</span>

                    </a>

                </div>



                <div class="col-md-3 mrkmenu-item">

                    <a href="rent.php?mkr_id=<?php echo $first_market ?>" class="mrkmenu-item mrkmenu-itemrent w-100 btn btn-outline-primary ">

                        <i class="bx bx-message-alt-detail"></i>

                        <span>ค่าเช่า</span>

                    </a>

                </div>



                <div class="col-md-3 mrkmenu-item">

                    <a href="complain.php?mkr_id=<?php echo $first_market ?>" class="mrkmenu-item mrkmenu-itemcomp w-100 btn btn-outline-primary ">

                        <i class="bx bxs-megaphone"></i>

                        <span>การร้องเรียน</span>

                    </a>

                </div>
                <div class="col-md-3 mrkmenu-item">

                    <a href="index.php?del_id=<?php echo $mkr_id ?>" class="mrkmenu-item mrkmenu-itemcomp w-100 btn btn-outline-danger ">

                        <i class='bx bxs-minus-square'></i>

                        <span>ลบตลาด</span>

                    </a>

                </div>
            </div>

        </div>



        <!-- pie graph -->

        <div class="box-2-1">

            <div class="border rounded shadow-sm p-3 mt-3 ">

                <h3 class="center">จำนวนของแผงค้าในแต่ละประเภท</h3>

                <div class="chartcanvas center " id="piechart"></div>

                <div class="text-end">

                    <a href="edit-Stall.php?mkr_id=<?php echo $row3['mkr_id'] ?>" type="button" class="btn btn-primary piechart-btn" style="height: fit-content;"><i class="bx bxs-edit-alt"></i> แก้ไขข้อมูลแผงค้า</a>

                </div>

            </div>

            <div class="border rounded shadow-sm p-3 mt-3 " ng-sum>

                <h3 class="center">สรุปการจองแผงค้าในปี <?php echo date("Y") ?></h3>

                <div class="chartcanvas" id="chart_div"> </div>

                <div class="text-end">

                    <a href="booking.php?mkr_id=<?php echo $row3['mkr_id'] ?>" type="button" class="btn btn-primary " style="height: fit-content;"><i class="bx bxs-edit-alt"></i> จัดการการจอง</a>

                </div>

            </div>

        </div>



        <!-- line graph -->

        <div class="box-mk">

            <div class="border rounded shadow-sm p-3 mt-3 h-100">

                <h4 class="center">3 อันดับประเภทแผงค้าที่ถูกจองมากที่สุด</h4>

                <ul class="list-group list-group-flush">

                    <?php

                    if ($row3['opening'] == 'เปิดทำการทุกวัน') {

                        $queryz = "SELECT zone.z_name , COUNT(booking_range.b_id) AS countZ  FROM stall JOIN zone ON (zone.z_id = stall.z_id) JOIN booking_range ON (booking_range.stall_id = stall.sKey) WHERE (stall.market_id = '$mkr_id') GROUP BY zone.z_id ORDER BY countZ DESC LIMIT 3";
                    } else {

                        $queryz = "SELECT zone.z_name , COUNT(booking_period.b_id) AS countZ  FROM stall JOIN zone ON (zone.z_id = stall.z_id) JOIN booking_period ON (booking_period.stall_id = stall.sKey) WHERE (stall.market_id = '$mkr_id') GROUP BY zone.z_id ORDER BY countZ DESC LIMIT 3";
                    }



                    $rsz = mysqli_query($conn, $queryz);

                    $count_type = 1;

                    foreach ($rsz as $rs_c) {

                        echo ' <li class="list-group-item">

                    <div class=" row text-decoration-none">

                    <div class="col-1 ps-0">

                    ' . $count_type . '.

                    </div>

                    <div class="col-7">

                     ' . $rs_c['z_name'] . '

                    </div>

                    <div class="col-4 text-end pe-0">

                        จำนวน ' . $rs_c['countZ'] . ' ครั้ง

                    </div>

            

                </li>';

                        $count_type++;
                    }

                    ?>



                </ul>

            </div>



            <!-- top three user -->

            <div class="border rounded shadow-sm p-3 mt-3 h-100 top-user">

                <h4 class="center">3 อันดับผู้ใช้งานที่มีการจองมากที่สุด</h4>

                <ul class="list-group list-group-flush list-group-topuser">

                    <?php

                    if ($row3['opening'] == 'เปิดทำการทุกวัน') {

                        $queryz = "SELECT users.username,booking_range.b_fname,booking_range.b_lname , COUNT(booking_range.b_id) AS countZ  FROM booking_range JOIN users ON (users.users_id = booking_range.users_id) JOIN stall ON (stall.sKey = booking_range.stall_id) WHERE (stall.market_id = '$mkr_id') GROUP BY users.users_id ORDER BY countZ DESC LIMIT 3";
                    } else {

                        $queryz = "SELECT users.username,booking_period.b_fname,booking_period.b_lname , COUNT(booking_period.b_id) AS countZ  FROM booking_period JOIN users ON (users.users_id = booking_period.users_id) JOIN stall ON (stall.sKey = booking_period.stall_id) WHERE (stall.market_id = '$mkr_id') GROUP BY users.users_id ORDER BY countZ DESC LIMIT 3";
                    }



                    $rsz = mysqli_query($conn, $queryz);

                    $count_user = 1;

                    foreach ($rsz as $rs_c) {

                        echo ' <li class="list-group-item">

                    <div class=" row text-decoration-none">

                    <div class="col-1 ps-0">

                    ' . $count_user . '.

                    </div>

                    <div class="col-7">

                    คุณ ' . $rs_c['b_fname'] . ' ' . $rs_c['b_lname'] . ' ( ชื่อผู้ใช้ : ' . $rs_c['username'] . ' )

                    </div>

                    <div class="col-4 text-end pe-0">

                    จำนวน ' . $rs_c['countZ'] . ' ครั้ง

                    </div>

                 

                </li>';

                        $count_user++;
                    }

                    ?>

                </ul>

            </div>

        </div>

        <?php echo $opening_period ?>

        <!-- complain -->

        <div class="box-3 mt-3 mb-3">

            <div class="border rounded shadow-sm mt-3 p-3 h-100">

                <h4 class="center">จำนวนคำร้องเรียนทั้งหมด</h4>

                <h1 class="my-4">

                    <?php

                    $queryz = "SELECT * FROM complain  WHERE (mkr_id = $mkr_id)";

                    $rsz = mysqli_query($conn, $queryz);

                    echo mysqli_num_rows($rsz);

                    ?>

                </h1>
                <a href="complain.php?mkr_id=<?php echo $row3['mkr_id'] ?>" type="button" class="btn btn-primary w-100" style="height: fit-content;"><i class='bx bxs-send'></i> จัดการคำร้องเรียน</a>
            </div>

            <div class="border rounded shadow-sm mt-3 p-3 h-100">
                <h4 class="center">จำนวนคำร้องเรียนในแต่ละสถานะ</h4>
                <ul class="list-group list-group-flush">
                    <?php
                    for ($i = 1; $i <= 3; $i++) {
                        $qrycs[$i] = mysqli_query($conn, "SELECT COUNT(complain.comp_id) AS countZ, comp_status.*  FROM comp_status  JOIN complain ON (complain.status = comp_status.cs_id) WHERE (mkr_id = $mkr_id AND cs_id = $i)");
                        foreach ($qrycs[$i] as $cs[$i]) { ?>
                            <li class="list-group-item">
                                <div class=" row text-decoration-none">
                                    <div class="col-1 ps-0  <?php echo $cs[$i]['cs_color'] ?>">
                                        <i class='bx bxs-circle'></i>
                                    </div>
                                    <div class="col-7 <?php echo $cs[$i]['cs_color'] ?>">
                                        <?php echo $cs[$i]['cs_name'] ?>
                                    </div>
                                    <div class="col-4 text-end pe-0">
                                        <?php echo $cs[$i]['countZ'] ?>
                                    </div>
                                </div>
                            </li>
                    <?php }
                    } ?>
                </ul>
            </div>

            <div class="border rounded shadow-sm mt-3 p-3 h-100">

                <h4 class="center">3 อันดับหัวข้อที่มีการร้องเรียนที่มากที่สุด</h4>

                <ul class="list-group list-group-flush">

                    <?php

                    $queryz = "SELECT toppic.toppic , COUNT(complain.comp_id) AS countZ  FROM complain JOIN toppic ON (complain.toppic_id = toppic.toppic_id) WHERE (mkr_id = $mkr_id) GROUP BY complain.toppic_id ORDER BY countZ DESC LIMIT 3";

                    $rsz = mysqli_query($conn, $queryz);

                    $count_n = 1;

                    foreach ($rsz as $rs_c) {

                        echo ' <li class="list-group-item">

                    <div class=" row text-decoration-none">

                    <div class="col-1 ps-0">

                    ' . $count_n . '.

                    </div>

                    <div class="col-7">

                    ' . $rs_c['toppic'] . '

                    </div>

                    <div class="col-4 text-end pe-0">

                    จำนวน ' . $rs_c['countZ'] . ' ครั้ง

                    </div>

                   

                </li>';

                        $count_n++;
                    }

                    ?>

                </ul>

            </div>

        </div>

        <!-- market info -->

        <div class="border rounded shadow-sm mt-4 p-3 box">

            <img src="../<?php echo $row3['mkr_pic'] ?>" class="rounded" alt="">

            <div class="ms-2">

                <div class="d-flex justify-content-between ">

                    <h4 class="mt-2 mb-0"><?php echo $row3['mkr_name']; ?></h4>

                    <a href="edit-market-info.php?mkr_id=<?php echo $row3['mkr_id'] ?>" type="button" class="btn btn-primary " style="height: fit-content;"><i class="bx bxs-edit-alt"></i> แก้ไขข้อมูลตลาด</a>

                </div>

                <hr class="my-2">

                <div class="box mt-4 pe-3">

                    <div>

                        <p class="fs-5 mb-0">

                        <div class="fw-bold">ประเภทตลาด</div> <?php echo $row3['market_type']; ?>

                        </p>

                        <p class="fs-5 mb-0">

                        <div class="fw-bold">เบอร์โทรศัพท์</div> <?php echo $row3['tel']; ?>

                        </p>

                        <p class="fs-5 mb-0">

                        <div class="fw-bold">อีเมล</div>

                        <a href="mailto:<?php echo $row3['email'] ?>">

                            <?php echo $row3['email']; ?>

                        </a>

                        </p>



                        <p class="fs-5 mb-0">

                        <div class="fw-bold">วันเปิดทำการ</div>

                        <?php echo $row3['opening']; ?>

                        </p>



                    </div>

                    <div>

                        <p class="fs-5 mb-0">

                        <div class="fw-bold">รายละเอียดโดยสังเขป</div> <?php echo $row3['mkr_descrip']; ?>

                        </p>

                        <p class="fs-5 mb-0">

                        <div class="fw-bold">สถานที่ตั้ง</div> <?php echo $row3['house_no']; ?> ซอย <?php echo $row3['soi']; ?> หมู่ <?php echo $row3['moo']; ?> ถนน <?php echo $row3['road']; ?> ตำบล/แขวง <?php echo $row3['district_name']; ?> อำเภอ/เขต <?php echo $row3['amphure_name']; ?> จังหวัด <?php echo $row3['province_name']; ?> รหัสไปรษณีย์ <?php echo $row3['postalcode']; ?>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>



<script src="script.js"></script>

<script src="../backend/script.js"></script>

<script>
    google.charts.load('current', {

        'packages': ['corechart']

    });

    google.charts.setOnLoadCallback(drawChart);



    function drawChart() {

        var options = {

            width: 347,

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

            $queryz = "SELECT zone.* , COUNT(stall.z_id) AS countZ  FROM stall JOIN zone ON (stall.z_id = zone.z_id) WHERE (market_id = '$first_market') GROUP BY stall.z_id ";

            $rsz = mysqli_query($conn, $queryz);

            foreach ($rsz as $rs_c) {

                echo "['" . $rs_c['z_name'] . "'," . $rs_c['countZ'] . "],";
            }

            ?>



        ]);

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));



        chart.draw(data, options);

    }

    // gg chart

    google.charts.load('current', {

        packages: ['corechart', 'line']

    });

    google.charts.setOnLoadCallback(drawBackgroundColor);



    function drawBackgroundColor() {

        var data = new google.visualization.DataTable();

        data.addColumn('string', 'X');

        data.addColumn('number', 'ยอดการจอง');



        data.addRows([

            <?php

            $curr_Y = date("Y");

            if ($row3['opening'] == 'เปิดทำการทุกวัน') {

                $query1 = mysqli_query($conn, "SELECT  COUNT(booking_range.b_id) AS countZ  FROM booking_range JOIN stall ON (stall.sKey = booking_range.stall_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-01-31' AND  '$curr_Y-01-01' <=`end`");

                $query2 = mysqli_query($conn, "SELECT  COUNT(booking_range.b_id) AS countZ  FROM booking_range JOIN stall ON (stall.sKey = booking_range.stall_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-02-29' AND  '$curr_Y-02-01' <=`end`");

                $query3 = mysqli_query($conn, "SELECT  COUNT(booking_range.b_id) AS countZ  FROM booking_range JOIN stall ON (stall.sKey = booking_range.stall_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-03-31' AND  '$curr_Y-03-01' <=`end`");

                $query4 = mysqli_query($conn, "SELECT  COUNT(booking_range.b_id) AS countZ  FROM booking_range JOIN stall ON (stall.sKey = booking_range.stall_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-04-30' AND  '$curr_Y-04-01' <=`end`");

                $query5 = mysqli_query($conn, "SELECT  COUNT(booking_range.b_id) AS countZ  FROM booking_range JOIN stall ON (stall.sKey = booking_range.stall_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-05-31' AND  '$curr_Y-05-01' <=`end`");

                $query6 = mysqli_query($conn, "SELECT  COUNT(booking_range.b_id) AS countZ  FROM booking_range JOIN stall ON (stall.sKey = booking_range.stall_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-06-30' AND  '$curr_Y-06-01' <=`end`");

                $query7 = mysqli_query($conn, "SELECT  COUNT(booking_range.b_id) AS countZ  FROM booking_range JOIN stall ON (stall.sKey = booking_range.stall_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-07-31' AND  '$curr_Y-07-01' <=`end`");

                $query8 = mysqli_query($conn, "SELECT  COUNT(booking_range.b_id) AS countZ  FROM booking_range JOIN stall ON (stall.sKey = booking_range.stall_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-08-31' AND  '$curr_Y-08-01' <=`end`");

                $query9 = mysqli_query($conn, "SELECT  COUNT(booking_range.b_id) AS countZ  FROM booking_range JOIN stall ON (stall.sKey = booking_range.stall_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-09-30' AND  '$curr_Y-09-01' <=`end`");

                $query10 = mysqli_query($conn, "SELECT  COUNT(booking_range.b_id) AS countZ  FROM booking_range JOIN stall ON (stall.sKey = booking_range.stall_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-10-31' AND  '$curr_Y-10-01' <=`end`");

                $query11 = mysqli_query($conn, "SELECT  COUNT(booking_range.b_id) AS countZ  FROM booking_range JOIN stall ON (stall.sKey = booking_range.stall_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-11-30' AND  '$curr_Y-11-01' <=`end`");

                $query12 = mysqli_query($conn, "SELECT  COUNT(booking_range.b_id) AS countZ  FROM booking_range JOIN stall ON (stall.sKey = booking_range.stall_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-12-31' AND  '$curr_Y-12-01' <=`end`");
            } else {

                $query1 = mysqli_query($conn, "SELECT  COUNT(booking_period.b_id) AS countZ  FROM booking_period JOIN stall ON (stall.sKey = booking_period.stall_id) JOIN opening_period ON (opening_period.id = booking_period.op_id) WHERE stall.market_id = '$mkr_id' AND `start` <= '$curr_Y-01-30' AND  '$curr_Y-01-01' <=`end`");

                $query2 = mysqli_query($conn, "SELECT  COUNT(booking_period.b_id) AS countZ  FROM booking_period JOIN stall ON (stall.sKey = booking_period.stall_id) JOIN opening_period ON (opening_period.id = booking_period.op_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-02-29' AND  '$curr_Y-02-01' <=`end`");

                $query3 = mysqli_query($conn, "SELECT  COUNT(booking_period.b_id) AS countZ  FROM booking_period JOIN stall ON (stall.sKey = booking_period.stall_id) JOIN opening_period ON (opening_period.id = booking_period.op_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-03-31' AND  '$curr_Y-03-01' <=`end`");

                $query4 = mysqli_query($conn, "SELECT  COUNT(booking_period.b_id) AS countZ  FROM booking_period JOIN stall ON (stall.sKey = booking_period.stall_id) JOIN opening_period ON (opening_period.id = booking_period.op_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-04-30' AND  '$curr_Y-04-01' <=`end`");

                $query5 = mysqli_query($conn, "SELECT  COUNT(booking_period.b_id) AS countZ  FROM booking_period JOIN stall ON (stall.sKey = booking_period.stall_id) JOIN opening_period ON (opening_period.id = booking_period.op_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-05-31' AND  '$curr_Y-05-01' <=`end`");

                $query6 = mysqli_query($conn, "SELECT  COUNT(booking_period.b_id) AS countZ  FROM booking_period JOIN stall ON (stall.sKey = booking_period.stall_id) JOIN opening_period ON (opening_period.id = booking_period.op_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-06-30' AND  '$curr_Y-06-01' <=`end`");

                $query7 = mysqli_query($conn, "SELECT  COUNT(booking_period.b_id) AS countZ  FROM booking_period JOIN stall ON (stall.sKey = booking_period.stall_id) JOIN opening_period ON (opening_period.id = booking_period.op_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-07-31' AND  '$curr_Y-07-01' <=`end`");

                $query8 = mysqli_query($conn, "SELECT  COUNT(booking_period.b_id) AS countZ  FROM booking_period JOIN stall ON (stall.sKey = booking_period.stall_id) JOIN opening_period ON (opening_period.id = booking_period.op_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-08-31' AND  '$curr_Y-08-01' <=`end`");

                $query9 = mysqli_query($conn, "SELECT  COUNT(booking_period.b_id) AS countZ  FROM booking_period JOIN stall ON (stall.sKey = booking_period.stall_id) JOIN opening_period ON (opening_period.id = booking_period.op_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-09-30' AND  '$curr_Y-09-01' <=`end`");

                $query10 = mysqli_query($conn, "SELECT  COUNT(booking_period.b_id) AS countZ  FROM booking_period JOIN stall ON (stall.sKey = booking_period.stall_id) JOIN opening_period ON (opening_period.id = booking_period.op_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-10-31' AND  '$curr_Y-10-01' <=`end`");

                $query11 = mysqli_query($conn, "SELECT  COUNT(booking_period.b_id) AS countZ  FROM booking_period JOIN stall ON (stall.sKey = booking_period.stall_id) JOIN opening_period ON (opening_period.id = booking_period.op_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-11-30' AND  '$curr_Y-11-01' <=`end`");

                $query12 = mysqli_query($conn, "SELECT  COUNT(booking_period.b_id) AS countZ  FROM booking_period JOIN stall ON (stall.sKey = booking_period.stall_id) JOIN opening_period ON (opening_period.id = booking_period.op_id) WHERE stall.market_id ='$mkr_id'  AND `start` <= '$curr_Y-12-31' AND  '$curr_Y-12-01' <=`end`");
            }

            foreach ($query1 as $rs_1) {

                echo "['ม.ค.'," . $rs_1['countZ'] . "],";
            }

            foreach ($query2 as $rs_2) {

                echo "['ก.พ.'," . $rs_2['countZ'] . "],";
            }

            foreach ($query3 as $rs_3) {

                echo "['มี.ค.'," . $rs_3['countZ'] . "],";
            }

            foreach ($query4 as $rs_4) {

                echo "['เม.ย.'," . $rs_4['countZ'] . "],";
            }

            foreach ($query5 as $rs_5) {

                echo "['พ.ค.'," . $rs_5['countZ'] . "],";
            }

            foreach ($query6 as $rs_6) {

                echo "['มิ.ย.'," . $rs_6['countZ'] . "],";
            }

            foreach ($query7 as $rs_7) {

                echo "['ก.ค.'," . $rs_7['countZ'] . "],";
            }

            foreach ($query8 as $rs_8) {

                echo "['ส.ค.'," . $rs_8['countZ'] . "],";
            }

            foreach ($query9 as $rs_9) {

                echo "['ก.ย.'," . $rs_9['countZ'] . "],";
            }

            foreach ($query10 as $rs_10) {

                echo "['ต.ค.'," . $rs_10['countZ'] . "],";
            }

            foreach ($query11 as $rs_11) {

                echo "['พ.ย.'," . $rs_11['countZ'] . "],";
            }

            foreach ($query12 as $rs_12) {

                echo "['ธ.ค.'," . $rs_12['countZ'] . "]";
            }

            ?>

        ]);



        var options = {

            height: 350,

            hAxis: {

                title: 'เดือน'

            },

            vAxis: {

                title: 'ยอดการจอง'

            }

        };



        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

        chart.draw(data, options);

    }

    $(window).resize(function() {

        drawBackgroundColor();

        drawChart();

    });

    $(document).ready(function() {

        $("body").tooltip({

            selector: '[data-toggle=tooltip]',

            placement: 'right'

        });

    });



    // datepicker

    var now = new Date();

    var colorset = [

        '#abdee6',

        '#cbaacb',

        '#ffffb5',

        '#ffccb6',

        '#f3b0c3',

        '#c6dbda',

        '#fee1e8',

        '#fed7c3',

        '#f6eac2',

        '#ecd5e3',



    ];





    mobiscroll.datepicker('#demo-colored', {

        controls: ['calendar'],

        display: 'inline',
        calendarType: 'month',

        colors: [

            <?php

            $countcolor = 0;

            while ($q = $qrycalendar->fetch_assoc()) : ?> {

                    start: new Date(<?php

                                    $start = strtotime(str_replace('-', '/', $q['start']));

                                    echo date("Y,m,d", strtotime("-1 month", $start))

                                    ?>),

                    end: new Date(<?php

                                    $end = strtotime(str_replace('-', '/', $q['end']));

                                    echo date("Y,m,d", strtotime("-1 month", $end))

                                    ?>),

                    background: colorset[<?php echo $countcolor; ?>]





                },

            <?php

                $countcolor++;

                if ($countcolor > 10) {

                    $countcolor = 0;
                }

            endwhile ?>

        ]



    });
</script>



</html>