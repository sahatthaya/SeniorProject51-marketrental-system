<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/market-index.css">
    <title> MarketRental - หน้าหลัก(เจ้าของตลาด)</title>


</head>

<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
require "../backend/graph-market.php";
?>

<body>

    <?php
    if (mysqli_num_rows($result) <= 0) {
        echo "<script>
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
                ['ม.ค.', 0],
                ['ก.พ.', 0],
                ['มี.ค.', 0],
                ['เม.ย.', 0],
                ['พ.ค.', 0],
                ['มิ.ย.', 0],
                ['ก.ค.', 0],
                ['ส.ค.', 0],
                ['ก.ย.', 0],
                ['ต.ค.', 0],
                ['พ.ย.', 0],
                ['ธ.ค.', 0],
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
                ['สถานะ', 'จำนวนแผงค้า'],
                ['ว่าง', 100],
                ['ถูกจอง', 0],
    
            ]);
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
            chart.draw(data, options);
        }
        $(window).resize(function(){
            drawBackgroundColor();
            drawChart();
          });
    </script>";
        echo '
    <div class="box ">
    <div class="graph">
        <h5 class="center">ยอดการจองแผงค้าในแต่ละเดือน</h5>
        <div class="chartcanvas" id="chart_div"> </div>
    </div>
    <div class="graph">
        <h5 class="center">จำนวนการจองต่อจำนวนแผงว่าง</h5>
        <div class="chartcanvas center" id="piechart"></div>
    </div>
</div>';
        echo '
        <div class="no-market text-center vstack gap-2">
        <h4 class="mt-5">ยังไม่มีข้อมูลตลาดในระบบ</h4>
        <div class="text-center">
            <a href="applicant.php" type="button" class="btn btn-primary w-25">ส่งคำร้องเพื่อเพิ่มตลาดของคุณ</a>
        </div>
    </div>';
    } else {
        echo "<script>
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
                ['สถานะ', 'จำนวนแผงค้า'],
                ['ว่าง', 10],
                ['ถูกจอง', 90],
    
            ]);
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
            chart.draw(data, options);
        }
        $(window).resize(function(){
            drawBackgroundColor();
            drawChart();
          });
    </script>";
        echo '
    <div class="box ">
    <div class="graph">
        <h5 class="center">ยอดการจองแผงค้าในแต่ละเดือน</h5>
        <div class="chartcanvas" id="chart_div"> </div>
    </div>
    <div class="graph">
        <h5 class="center">จำนวนการจองต่อจำนวนแผงว่าง</h5>
        <div class="chartcanvas center" id="piechart"></div>
    </div>
</div>

<div class="products-feature ">
    <div class="grid-container carousel " 
    ';
        echo "data-flickity='";
        echo '{ "groupCells": true}';
        echo "'>";
        while ($row = $result->fetch_assoc()) {
            echo '  <div class="three columns carousel-cell">
        <div class="project-box-wrapper">
            <div class="project-box">
                <div class="head">
                    <div class="dropdown-center">
                        <div class="project-box-header float-end " type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
                            <li>
                                <a class="edit" href="finance.php?mkr_id=' . $row['mkr_id'] . '">  <i class="bx bxs-credit-card"></i>แก้ไขข้อมูลการเงิน</a>
                            </li>
                            <li>
                                <a class="edit" href="edit-market-info.php?mkr_id=' . $row['mkr_id'] . '"><i class="bx bxs-edit-alt"></i>แก้ไขข้อมูลตลาด</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="del" href="../backend/del-market.php?mkr_id=' . $row['mkr_id'] . '" onclick="return confirm("คุณต้องการลบ' . $row['mkr_name'] . ' หรือไม่")"><i class="bx bx-trash-alt"></i>ลบตลาด</a>
                            </li>
                        </ul>
                    </div>
                    <div class="project-box-content-header">
                        <h5 class="">' . $row['mkr_name'] . '</h5>
                    </div>
                </div>
                <div>
                    <img src="../' . $row['mkr_pic'] . '" alt="">
                  
                    <hr class="my-2">
                </div>
                <div class="menu-mrk">
                <div class="item">
                    <a href="booking.php?mkr_id=' . $row['mkr_id'] . '" class="vstack gap-2">
                        <i class="bx bx-message-alt-edit"></i>
                        <span>การจอง</span>
                    </a>
                 </div>
                <div class="item ">
                    <a href="rent.php?mkr_id=' . $row['mkr_id'] . '" class="vstack gap-2">
                        <i class="bx bx-message-alt-detail"></i>
                        <span>ค่าเช่า</span>
                    </a>
                </div>
                <div class="item">
                    <a href="cost.php?mkr_id=' . $row['mkr_id'] . '" class="vstack gap-2">
                        <i class="bx bx-tachometer"></i>
                        <span>ค่าใช้จ่ายเพิ่มเติม</span>
                    </a>
                </div>
                    <div class="item ">
                        <a href="edit-Stall.php?mkr_id=' . $row['mkr_id'] . '" class="vstack gap-2">
                            <i class="bx bx-map-alt"></i>
                            <span>แผนผังตลาด</span>
                        </a>
                    </div>
                    <div class="item ">
                        <a href="news.php?mkr_id=' . $row['mkr_id'] . '" class="vstack gap-2">
                            <i class="bx bxs-news"></i>
                            <span>ข่าวสาร</span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="complain.php?mkr_id=' . $row['mkr_id'] . '" class="vstack gap-2">
                            <i class="bx bxs-megaphone"></i>
                            <span>การร้องเรียน</span>
                        </a>
                    </div> 
                    </div>
              
                    <hr class="my-2">
                <a href="overview.php?mkr_id=' . $row['mkr_id'] . '" type="button" class="btn btn-primary " style="width:100%;">ดูภาพรวม ' . $row['mkr_name'] . ' </a>
            </div>
        </div>
    </div>';
        }
    }
    ?>
</body>

</html>