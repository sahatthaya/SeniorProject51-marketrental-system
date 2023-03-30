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
    $qrybr = mysqli_query($conn, "SELECT booking.*,stall.market_id FROM `booking`JOIN stall ON (booking.stall_id = stall.sKey) WHERE market_id = $mkr_id");
    $br = mysqli_num_rows($qrybr);
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
        <div class="border rounded shadow-sm mb-3 mt-3 p-3 row mx-1">
            <div class="col-lg-8">
                <h4 class="text-center">สรุปการจองแผงค้าในตลาดทั้งหมดของคุณ ปี <?php echo date("Y") ?></h4>
                <div class="p-0" id="linechart_material" style=" height: 400px"></div>
            </div>
            <div class="col-lg-4 border p-3 rounded mw-100">
                เรียงลำดับตลาดที่มีการจองมากที่สุด ปี <?php echo date("Y") ?>
                <hr>
                <ul class="list-group list-group-flush w-100" style="height:100%;">
                    <?php
                    $year =  date("Y");
                    $query = mysqli_query($conn, "SELECT COALESCE(COUNT(booking.b_id), 0) AS countZ, market_detail.mkr_name 
                        FROM market_detail 
                        LEFT JOIN stall ON (market_detail.mkr_id = stall.market_id) 
                        LEFT JOIN booking ON (stall.sKey = booking.stall_id AND booking.status = '1' AND booking.b_start <= '$year-12-31' AND booking.b_end >= '$year-01-01') 
                        WHERE market_detail.users_id = '$userid' and a_id = 1
                        GROUP BY market_detail.mkr_id 
                        ORDER BY countZ DESC
                        ");
                    $i = 1;
                    foreach ($query as $rs) { ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <div><?php echo $i . ". " . $rs['mkr_name'] ?></div>
                            <div>จำนวน <?php echo $rs['countZ'] ?> ครั้ง</div>
                        </li>
                    <?php
                        $i++;
                    } ?>

                </ul>
            </div>
        </div>
        <!-- market tap -->

        <ul class="nav nav-tabs list-group list-group-horizontal-sm ">

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


                <div class="col-md-3 mrkmenu-item ">


                    <a href="edit-market-info.php?mkr_id=<?php echo $first_market ?>" class="mrkmenu-item w-100 btn btn-outline-primary ">

                        <i class="bx bxs-edit-alt"></i>

                        <span>แก้ไขข้อมูลตลาด</span>

                    </a>

                </div>

                <div class="col-md-6 mrkmenu-item">

                    <a href="finance.php?mkr_id=<?php echo $first_market ?>" class="mrkmenu-item w-100 btn btn-outline-primary ">

                        <i class="bx bxs-credit-card"></i>

                        <span>แก้ไขข้อมูลการเงิน</span>

                    </a>

                </div>

                <div class="col-md-6 mrkmenu-item">

                    <a href="edit-Stall.php?mkr_id=<?php echo $first_market ?>" class="mrkmenu-item w-100 btn btn-outline-primary ">

                        <i class="bx bx-map-alt"></i>

                        <span>แผนผังตลาด</span>

                    </a>

                </div>

                <div class="col-md-6 mrkmenu-item">

                    <a href="news.php?mkr_id=<?php echo $first_market ?>" class="mrkmenu-item w-100 btn btn-outline-primary ">

                        <i class="bx bxs-news"></i>

                        <span>ข่าวสาร</span>

                    </a>

                </div>

            </div>


            <div class="row mrkmenu2">

<<<<<<< HEAD
                <div class="col-md-6 mrkmenu-item">
=======
                <div class="col-md-3 mrkmenu-item mrkmenu-item2">
>>>>>>> origin/master

                    <a href="booking.php?mkr_id=<?php echo $first_market ?>" class="mrkmenu-item w-100 btn btn-outline-primary">

                        <i class="bx bx-message-alt-edit"></i>

                        <span>การจอง</span>

                    </a>

                </div>

<<<<<<< HEAD
                <div class="col-md-6 mrkmenu-item">
=======
                <div class="col-md-3 mrkmenu-item mrkmenu-item2">
>>>>>>> origin/master

                    <a href="rent.php?mkr_id=<?php echo $first_market ?>" class="mrkmenu-item w-100 btn btn-outline-primary ">

                        <i class="bx bx-message-alt-detail"></i>

                        <span>ค่าเช่า</span>

                    </a>

                </div>



<<<<<<< HEAD
                <div class="col-md-6 mrkmenu-item">
=======
                <div class="col-md-3 mrkmenu-item mrkmenu-item2">
>>>>>>> origin/master

                    <a href="complain.php?mkr_id=<?php echo $first_market ?>" class="mrkmenu-item w-100 btn btn-outline-primary">

                        <i class="bx bxs-megaphone"></i>

                        <span>การร้องเรียน</span>

                    </a>

                </div>
<<<<<<< HEAD
                <div class="col-md-6 mrkmenu-item">
=======
>>>>>>> origin/master

                <div class="col-md-3 mrkmenu-item mrkmenu-item2">

                    <a href="index.php?del_id=<?php echo $mkr_id ?>" class="mrkmenu-item w-100 btn btn-outline-danger " onclick="return confirm('คุณต้องการลบตลาดหรือไม่')">

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

            <div class="border rounded shadow-sm p-3 mt-3 ">

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

                    $queryz = "SELECT zone.z_name , COUNT(booking.b_id) AS countZ  FROM stall JOIN zone ON (zone.z_id = stall.z_id) JOIN booking ON (booking.stall_id = stall.sKey) WHERE (stall.market_id = '$mkr_id') GROUP BY zone.z_id ORDER BY countZ DESC LIMIT 3";

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

                    $queryz = "SELECT users.username,booking.b_fname,booking.b_lname , COUNT(booking.b_id) AS countZ  FROM booking JOIN users ON (users.users_id = booking.users_id) JOIN stall ON (stall.sKey = booking.stall_id) WHERE (stall.market_id = '$mkr_id') GROUP BY users.users_id ORDER BY countZ DESC LIMIT 3";

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

        packages: ['corechart', 'line']

    });

    google.charts.setOnLoadCallback(drawall);



    function drawall() {

        var data = new google.visualization.DataTable();

        data.addColumn('string', 'เดือน');
        <?php
        $userlogin = $_SESSION['users_id'];
        $qrymkrname = mysqli_query($conn, "SELECT `mkr_name` FROM `market_detail` WHERE `users_id` = '$userlogin' AND `a_id` = '1' ORDER BY `mkr_id` DESC");
        foreach ($qrymkrname as $rowname) { ?>
            data.addColumn('number', '<?php echo $rowname['mkr_name'] ?>');
        <?php
        }
        ?>



        data.addRows([

            <?php
            $curr_Y = date("Y");
            $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
            $lastday = ['31', '29', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31'];
            $mth = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
            for ($i = 0; $i < 12; $i++) {
                $startdate = $curr_Y . "-" . $months[$i] . "-1";
                $enddate = $curr_Y . "-" . $months[$i] . "-" . $lastday[$i];
                $arr = [];
                $query = mysqli_query($conn, "SELECT COALESCE(COUNT(booking.b_id), 0) AS countZ, market_detail.mkr_name 
                FROM market_detail 
                LEFT JOIN stall ON (market_detail.mkr_id = stall.market_id) 
                LEFT JOIN booking ON (stall.sKey = booking.stall_id AND booking.status = '1' AND booking.b_start <= '$enddate' AND booking.b_end >= '$startdate') 
                WHERE market_detail.users_id = '$userlogin' and a_id = 1
                GROUP BY market_detail.mkr_id 
                ORDER BY market_detail.mkr_id DESC
                ");
                foreach ($query as $rs) {
                    array_push($arr, $rs['countZ']);
                }
                echo "['" . $mth[$i] . "'," . implode(",", $arr) . "],";
            }

            ?>
        ]);

        var options = {
            hAxis: {

                title: 'เดือน'

            },

            vAxis: {

                title: 'ยอดการจอง'

            },
            chartArea: {
                width: "70%",
                height: "80%"
            }

        };



        var chart = new google.visualization.LineChart(document.getElementById('linechart_material'));

        chart.draw(data, options);

    }

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
            $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
            $lastday = ['31', '29', '31', '30', '31', '30', '31', '31', '30', '31', '30', '31'];
            $mth = ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];
            $rows = [];
            for ($i = 0; $i < 12; $i++) {
                $startdate = $curr_Y . "-" . $months[$i] . "-1";
                $enddate = $curr_Y . "-" . $months[$i] . "-" . $lastday[$i];
                $query = mysqli_query($conn, "SELECT  COUNT(booking.b_id) AS countZ FROM booking JOIN stall ON (stall.sKey = booking.stall_id) WHERE stall.market_id ='$mkr_id'  AND `b_start` <= '$enddate' AND  '$startdate' <=`b_end` AND `status`='1'");
                foreach ($query as $rs) {
                    echo "['" . $mth[$i] . "'," . $rs['countZ'] . "],";
                }
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

        drawall();

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