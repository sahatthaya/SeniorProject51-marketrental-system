<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
include "../backend/1-import-link.php";
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
?>

<body>
    <div <?php echo $showapp ?>>
        <h1>กรุณากรอกข้อมูลเพื่อส่งคำร้องเพิ่มตลาด</h1>
        <?php
        include_once "./applicant-form.php";
        ?>
    </div>
    </div>
    <div class="market" <?php echo $showmarket ?>>
        <h1>ตลาดของคุณ <?php echo $_SESSION['username'] ?></h1>
        <!-- market tap -->
        <ul class="nav nav-tabs">
            <?php while ($row1 = mysqli_fetch_assoc($taps)) : ?>
                <li class="nav-item">
                    <a href="./index.php?mkr_id=<?php echo $row1['mkr_id'] ?>" class="nav-link fs-5 <?php echo ($row1['mkr_id'] == $first_market) ? 'active' : ''; ?>">
                        <?php echo $row1['mkr_name'] ?>
                    </a>
                </li>
            <?php
            endwhile ?>
        </ul>
        <!-- market menu -->
        <div class="border rounded mt-3 p-3 shadow-sm">
            <div class="row">
                <div class="col-3">
                    <a href="edit-market-info.php?mkr_id=<?php echo $first_market ?>" class="text-center w-100 btn btn-outline-primary ">
                        <i class="bx bxs-edit-alt"></i>
                        <span>แก้ไขข้อมูลตลาด</span>
                    </a>
                </div>
                <div class="col-3">
                    <a href="finance.php?mkr_id=<?php echo $first_market ?>" class="text-center w-100 btn btn-outline-primary ">
                        <i class="bx bxs-credit-card"></i>
                        <span>แก้ไขข้อมูลการเงิน</span>
                    </a>
                </div>
                <div class="col-3">
                    <a href="edit-Stall.php?mkr_id=<?php echo $first_market ?>" class="text-center w-100 btn btn-outline-primary ">
                        <i class="bx bx-map-alt"></i>
                        <span>แผนผังตลาด</span>
                    </a>
                </div>

                <div class="col-3">
                    <a href="news.php?mkr_id=<?php echo $first_market ?>" class="text-center w-100 btn btn-outline-primary ">
                        <i class="bx bxs-news"></i>
                        <span>ข่าวสาร</span>
                    </a>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-3">
                    <a href="booking.php?mkr_id=<?php echo $first_market ?>" class="text-center w-100 btn btn-outline-primary">
                        <i class="bx bx-message-alt-edit"></i>
                        <span>การจอง</span>
                    </a>
                </div>

                <div class="col-3">
                    <a href="rent.php?mkr_id=<?php echo $first_market ?>" class="text-center w-100 btn btn-outline-primary ">
                        <i class="bx bx-message-alt-detail"></i>
                        <span>ค่าเช่า</span>
                    </a>
                </div>

                <div class="col-3">
                    <a href="cost.php?mkr_id=<?php echo $first_market ?>" class="text-center w-100 btn btn-outline-primary ">
                        <i class="bx bx-tachometer"></i>
                        <span>ค่าใช้จ่ายเพิ่มเติม</span>
                    </a>
                </div>
                <div class="col-3">
                    <a href="complain.php?mkr_id=<?php echo $first_market ?>" class="text-center w-100 btn btn-outline-primary ">
                        <i class="bx bxs-megaphone"></i>
                        <span>การร้องเรียน</span>
                    </a>
                </div>


            </div>
        </div>
        <!-- pie graph -->
        <div class="box-2-1">
            <div class="border rounded shadow-sm p-3 mt-3">
                <h3 class="center">จำนวนของแผงค้าในแต่ละประเภท</h3>
                <div class="chartcanvas center mt-5 ms-5" id="piechart"></div>
                <div class="text-end">
                    <a href="edit-Stall.php?mkr_id=<?php echo $row3['mkr_id'] ?>" type="button" class="btn btn-primary " style="height: fit-content;"><i class="bx bxs-edit-alt"></i> แก้ไขข้อมูลแผงค้า</a>
                </div>
            </div>
            <div class="border rounded shadow-sm p-3 mt-3">
                <h3 class="center">ยอดการจองแผงค้าในแต่ละเดือน</h3>
                <div class="chartcanvas" id="chart_div"> </div>
                <div class="text-end">
                    <a href="booking.php?mkr_id=<?php echo $row3['mkr_id'] ?>" type="button" class="btn btn-primary " style="height: fit-content;"><i class="bx bxs-edit-alt"></i> จัดการการจอง</a>
                </div>
            </div>
        </div>
        <!-- line graph -->
        <div class="box">
            <div class="border rounded shadow-sm p-3 mt-3">
                <h4 class="center">3 อันดับประเภทแผงค้าที่ถูกจองมากที่สุด</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class=" row text-decoration-none">
                            <div class="col-2 ps-0">
                                1.
                            </div>
                            <div class="col-6">
                                ประเภทเนื้อสัตว์
                            </div>
                            <div class="col-4 text-end pe-0">
                                จำนวน 5 ครั้ง
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class=" row text-decoration-none">
                            <div class="col-2 ps-0">
                                2.
                            </div>
                            <div class="col-6">
                                ประเภทเนื้อสัตว์
                            </div>
                            <div class="col-4 text-end pe-0">
                                จำนวน 5 ครั้ง
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class=" row text-decoration-none">
                            <div class="col-2 ps-0">
                                3.
                            </div>
                            <div class="col-6">
                                ประเภทเนื้อสัตว์
                            </div>
                            <div class="col-4 text-end pe-0">
                                จำนวน 5 ครั้ง
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- top three user -->
            <div class="border rounded shadow-sm p-3 mt-3">
                <h4 class="center">3 อันดับผู้ใช้งานที่มีการจองมากที่สุด</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class=" row text-decoration-none">
                            <div class="col-2 ps-0">
                                1.
                            </div>
                            <div class="col-6">
                                สหัสทยา เทียนมงคล
                            </div>
                            <div class="col-4 text-end pe-0">
                                จำนวน 5 ครั้ง
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class=" row text-decoration-none">
                            <div class="col-2 ps-0">
                                2.
                            </div>
                            <div class="col-6">
                                สหัสทยา เทียนมงคล
                            </div>
                            <div class="col-4 text-end pe-0">
                                จำนวน 5 ครั้ง
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class=" row text-decoration-none">
                            <div class="col-2 ps-0">
                                3.
                            </div>
                            <div class="col-6">
                                สหัสทยา เทียนมงคล
                            </div>
                            <div class="col-4 text-end pe-0">
                                จำนวน 5 ครั้ง
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <?php echo $opening_period ?>
        <!-- complain -->
        <div class="box-3">
            <div class="border rounded shadow-sm mt-3 p-3 ">
                <h4 class="center">จำนวนคำร้องเรียนทั้งหมด</h4>
                <h1>
                    <?php
                    $queryz = "SELECT * FROM complain  WHERE (mkr_id = $mkr_id)";
                    $rsz = mysqli_query($conn, $queryz);
                    echo mysqli_num_rows($rsz);
                    ?>
                </h1>
            </div>
            <div class="border rounded shadow-sm mt-3 p-3 ">
                <h4 class="center">คำร้องเรียนที่ยังไม่ได้ตอบกลับ</h4>
                <h1>
                    <?php
                    $queryz = "SELECT * FROM complain  WHERE (mkr_id = $mkr_id AND status = 1)";
                    $rsz = mysqli_query($conn, $queryz);
                    echo $countcomp = mysqli_num_rows($rsz);
                    ?>
                </h1>
                <div class="text-end">
                    <a href="complain.php?mkr_id=<?php echo $row3['mkr_id'] ?>" type="button" class="btn btn-primary " style="height: fit-content;"><i class='bx bxs-send'></i> ตอบกลับ</a>
                </div>
            </div>
            <div class="border rounded shadow-sm mt-3 p-3 ">
                <h4 class="center">3 อันดับหัวข้อที่มีการร้องเรียนที่มากที่สุด</h4>
                <ul class="list-group list-group-flush">
                    <?php
                    $queryz = "SELECT toppic.toppic , COUNT(complain.comp_id) AS countZ  FROM complain JOIN toppic ON (complain.toppic_id = toppic.toppic_id) WHERE (mkr_id = $mkr_id) GROUP BY complain.toppic_id ORDER BY countZ DESC LIMIT 3";
                    $rsz = mysqli_query($conn, $queryz);
                    $count_n = 1;
                    foreach ($rsz as $rs_c) {
                        echo ' <li class="list-group-item">
                    <div class=" row text-decoration-none">
                    <div class="col-2 ps-0">
                    ' . $count_n . '.
                    </div>
                    <div class="col-6">
                    ' . $rs_c['toppic'] . '
                    </div>
                    <div class="col-4 text-end pe-0">
                    จำนวน ' . $rs_c['countZ'] . ' ครั้ง
                    </div>
                    </ก>
                </li>';
                    }
                    $count_n++;
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
            ['ม.ค.', 10],
            ['ก.พ.', 23],
            ['มี.ค.', 17],
            ['เม.ย.', 18],
            ['พ.ค.', 9],
            ['มิ.ย.', 11],
            ['ก.ค.', 27],
            ['ส.ค.', 33],
            ['ก.ย.', 40],
            ['ต.ค.', 32],
            ['พ.ย.', 35],
            ['ธ.ค.', 30],
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
    mobiscroll.setOptions({
        locale: mobiscroll.localeTh,
        theme: 'ios',
        themeVariant: 'light'
    });

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