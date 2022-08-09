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
        <div class="graph">
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
                            <div class="infomarket row">
                                <div class="col-6 vstack">
                                    <span class="status-number center">45</span>
                                    <p class="mkrdetail center">การจองทั้งหมด</p>
                                </div>
                                <div class="col-6 vstack">
                                    <span class="status-number center">0</span>
                                    <p class="mkrdetail center">จำนวนแผงว่าง</p>
                                </div>
                            </div>
                            <div class="project-box-footer vstack center">
                                <a class="days-left" href="rent.php?mkr_id=<?php echo $row['mkr_id']; ?>">การจองแผงค้า</a>
                                <a class="days-left" href="complain.php?mkr_id=<?php echo $row['mkr_id']; ?>">การร้องเรียน</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endwhile ?>

        </div>
    </div>

</body>
<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("graph", {
            title: {
                text: "ยอดการจองในสัปดาห์นี้"
            },
            axisY: {
                title: "จำนวนการจอง"
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
</script>

</html>