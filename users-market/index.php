<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/market-index.css">
    <title>หน้าหลัก(เจ้าของตลาด)</title>

</head>
<?php

include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
require "../backend/graph-market.php";
?>

<body>
    <script>
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


        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var options = {
                width: 300,
                height: 300,
                animation: {
                    duration: 1000,
                    easing: 'out'
                },
                backgroundColor: ''
            };
            var data = google.visualization.arrayToDataTable([
                ['สถานะ', 'จำนวนแผงค้า'],
                ['ว่าง', 10],
                ['ถูกจอง', 90],

            ]);
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

    <div class="box">
        <div class="graph ">
            <h5 class="center">จำนวนแผงที่ถูกจองต่อจำนวนแผงว่าง</h5>
            <div class="chartcanvas" id="chart_div"> </div>
        </div>
        <div class="graph">
            <h5 class="center">จำนวนการจองต่อจำนวนแผงว่าง</h5>
            <div class="chartcanvas" id="piechart"></div>
        </div>
    </div>
    <div class="products-feature">
        <div class="grid-container carousel" data-flickity='{ "groupCells": true}'>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="three columns carousel-cell">
                    <div class="project-box-wrapper">
                        <div class="project-box">
                            <div class="head">
                                <div class="dropdown-center">
                                    <div class="project-box-header float-end " type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        <i class='bx bx-dots-vertical-rounded'></i>
                                    </div>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
                                        <li>
                                            <a class="edit" href="editmarket-info.php?mkr_id=<?php echo $row['mkr_id']; ?>"><i class='bx bxs-edit-alt'></i>แก้ไขข้อมูลตลาด</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="del" href="../backend/del-market.php?mkr_id=<?php echo $row['mkr_id']; ?>" onclick="return confirm('คุณต้องการลบ <?php echo $row['mkr_name'] ?> หรือไม่')"><i class='bx bx-trash-alt'></i>ลบตลาด</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="project-box-content-header">
                                    <h5 class=""><?php echo $row['mkr_name'] ?></h5>
                                </div>
                            </div>
                            <div>
                                <img src="../<?php echo $row['mkr_pic'] ?>" alt="">
                                <hr>
                            </div>
                            <div class="menu-mrk">
                                <div class="item ">
                                    <a  href="editStall.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="vstack gap-2">
                                        <i class='bx bx-map-alt'></i>
                                        <span>แผนผังตลาด</span> 
                                    </a>
                                </div>
                                <div class="item ">
                                    <a href="rent.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="vstack gap-2">
                                        <i class='bx bx-message-alt-detail'></i>
                                        <span>ค่าเช่า</span>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="booking.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="vstack gap-2">
                                        <i class='bx bx-message-alt-edit'></i>
                                        <span>การจอง</span>
                                    </a>
                                </div>
                                <div class="item ">
                                    <a href="news.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="vstack gap-2">
                                        <i class='bx bxs-news'></i>
                                        <span>ข่าวสาร</span>
                                    </a>
                                </div>
                               
                                <div class="item">
                                    <a href="complain.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="vstack gap-2">
                                        <i class='bx bxs-megaphone'></i>
                                        <span>การร้องเรียน</span>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="finance.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="vstack gap-2">
                                        <i class='bx bxs-credit-card'></i>
                                        <span>ข้อมูลการเงิน</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endwhile ?>

        </div>
    </div>

</body>
</html>