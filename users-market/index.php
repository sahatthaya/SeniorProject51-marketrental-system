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
include "../backend/connectDB.php";
include "../backend/import-link.php";
require "../backend/market-dashboard.php";
?>

<body>

    <div class="box">
        <div class="graph" id="graph">
        </div>
        <div class="vstack gap-3">
            <div class="cardrent" id="rent">
                <div class="rent-content center vstack">
                    <p>ยอดการจองทั้งหมด</p>
                    <h1>0</h1>
                </div>
            </div>

            <div class="card-emptystaw" id="blank">
                <div class="blank-content center vstack">
                    <p>จำนวนแผงว่างทั้งหมด</p>
                    <h1>0</h1>

                </div>
            </div>
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
                                        <a class="del" href="../backend/deletemarket.php?mkr_id=<?php echo $row['mkr_id']; ?>" onclick="return confirm('คุณต้องการลบ <?php echo $row['mkr_name'] ?> หรือไม่')"><i class='bx bx-trash-alt'></i>ลบตลาด</a>
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
                                <a class="days-left">การจองแผงค้า</a>
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