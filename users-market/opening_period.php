<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - ภาพรวมตลาด</title>

    <!-- css  -->
    <link rel="stylesheet" href="../css/overview.css" type="text/css">
    <link rel="stylesheet" href="../css/banner.css" type="text/css">

</head>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
include "../backend/qry-overview.php";
?>
<script src="../backend/script.js"></script>



<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item fs-5 "><a href="./overview.php?mkr_id=<?php echo $mkr_id ?>" class="text-decoration-none">ภาพรวมตลาด <?php echo $row['mkr_name']; ?></a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">จัดการรอบการเปิดทำการตลาด</li>
        </ol>
    </nav>

    <h1>ภาพรวมตลาด <?php echo $row['mkr_name']; ?></h1>
    <!-- <?php echo $opening_period ?> -->
    <div class="box">
        <div class="border rounded shadow-sm mt-4 p-3 ">
            <h4 class="mt-2 mb-0">ปฏิทินรอบการเปิดทำการของตลาด</h4>
            <div class="w-100">
                <div class="mbsc-form-group">
                    <div id="demo-colored"></div>
                </div>
            </div>
        </div>
        <div class="border rounded shadow-sm mt-4 p-3 ">
            <h4 class="mt-2 mb-2">เพิ่มรอบการเปิดทำการ</h4>
            <div class="w-100">
                <form action="" method="post">
                    <input id="demo-range-selection" name="daterange" hidden />
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-2" name="sdate">เพิ่มรอบ</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div id="table" class="bannertb border p-3 shadow-sm rounded mt-3">
        <h4 class="mt-2">รอบการเปิดทำการ</h4>
        <hr>
        <table id="myTable" class="display " style="width: 100%;">
            <thead>
                <tr>
                    <th scope="col">รอบที่</th>
                    <th scope="col">วันที่เริ่ม</th>
                    <th scope="col">วันที่สุดท้าย</th>
                    <th scope="col">จำนวน (วัน)</th>
                    <th scope="col">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row1 = $qryperiod->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $count_n; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($row1['start'])) ?></td>
                        <td><?php echo date("d/m/Y", strtotime($row1['end'])) ?></td>
                        <td><?php
                            echo floor((strtotime($row1['end']) - strtotime($row1['start'])) /  (60 * 60 * 24));
                            ?></td>
                        <td></td>
                    </tr>
                <?php $count_n++;
                endwhile ?>
            </tbody>
        </table>
    </div>
</body>

<script>
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

    mobiscroll.datepicker('#demo-range-selection', {
        controls: ['calendar'],
        display: 'inline',
        rangeSelectMode: 'wizard',
        select: 'range',
        showRangeLabels: false,

    });
    var randomColor = Math.floor(Math.random()*16777215).toString(16);
    mobiscroll.datepicker('#demo-colored', {
        controls: ['calendar'],
        display: 'inline',
        colors: [
            <?php while ($q = $qrycalendar->fetch_assoc()) : ?> {
                    start: new Date(<?php
                        $start = strtotime(str_replace('-','/',$q['start']));
                        echo date("Y,m,d", strtotime("-1 month",$start)) 
                         ?>),
                    end: new Date(<?php
                     $end = strtotime(str_replace('-','/',$q['end']));
                     echo date("Y,m,d", strtotime("-1 month",$end))
                      ?>)   ,
                    background: '#46c4f3'
                },
            <?php endwhile ?>
        ]

    });
</script>

</html>