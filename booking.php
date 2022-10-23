<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - แก้ไขแผนผังตลาด</title>
    <!-- css  -->
    <link rel="stylesheet" href="./css/stallplan.css" type="text/css">

    <?php
    include "profilebar.php";
    include "nav.php";
    include "backend/1-connectDB.php";
    include "backend/1-import-link.php";
    include "backend/qry-booking.php";
    ?>

</head>

<body onload="plslogin( event );">
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./all-market.php" class="text-decoration-none">ตลาดทั้งหมด</a></li>
            <li class="breadcrumb-item fs-5 "><a href="market-info.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none"><?php echo $row['mkr_name']; ?></a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">จองแผงค้า<?php echo $row['mkr_name']; ?></li>
        </ol>
    </nav>
    <h1>จองแผงค้า<?php echo $row['mkr_name']; ?><i class='ms-1 bx bx-info-circle text-primary fs-4' data-bs-toggle="modal" data-bs-target="#exampleModal"></i></h1>
    <div class="plan">
        <form method="POST">
            <div class="row px-3">
                <div class="hstack  px-1 gap-2 col-sm-6">
                    <label>ค้นหา ราคาค่าเช่าไม่เกิน : </label>
                    <div class="range-slider hstack gap-2">
                        <input id="range" name="rangeinput" class="range-slider__range form-range" type="range" value="<?php echo $range ?>" min="0" step="100" max="<?php echo $max ?>">
                        <div class="" style="min-width:55px;"><span id="showrangevalue" class="range-slider__value"><?php echo $range ?></span></div>บาท
                    </div>
                    <button type="submit" class="btn btn-outline-primary save-stall " name="save-range"><i class='bx bx-search'></i> ค้นหา </button>
                </div>
                <div class="text-end col-sm-6">
                    <i class='ms-1 bx bx-info-circle text-primary fs-4 my-3 mx-2' data-bs-toggle="modal" data-bs-target="#stalltypemodal"></i>
                </div>
            </div>
        </form>

        <hr>
        <div id="plan">
            <?php while ($row1 = $result3->fetch_assoc()) : ?>
                <?php
                $w = $row1['sWidth'];
                $h = $row1['sHeight'];

                $ratio_plan = $row['ratio_plan'];

                @$width = ($w * $ratio_plan);
                @$height = ($h * $ratio_plan);

                @$fs = ($ratio_plan / 3);
                ?>

                <div id="<?php echo $row1['sKey']; ?>" class="stallbox modal_data1" style="background-color:<?php echo $row1['z_color'] ?> ;left:<?php echo $row1['left'] ?>px;top:<?php echo $row1['top'] ?>px;<?php echo ($row1['left'] != "" ? "position:absolute;" : ""); ?>width:<?php echo $width ?>px;height:<?php echo $height ?>px;opacity:<?php echo ($row1['sRent'] < $val ? "1" : "0.2"); ?>;" id="<?php echo $count_n ?>">
                    <div class="stallnum">
                        <div class="text-center text-break" style="font-size:<?php echo $fs ?>px;"><?php echo $row1['sID'] ?></div>
                        <div id="despos">
                            <input type="text" value="<?php echo $row1['sKey'] ?>" id="<?php echo "id" . $count_n ?>" name="<?php echo "id" . $count_n ?>" hidden>
                            <input type="text" value="<?php echo $row1['left'] ?>" id="<?php echo "left" . $count_n ?>" name="<?php echo "left" . $count_n ?>" hidden>
                            <input type="text" value="<?php echo $row1['top'] ?>" id="<?php echo "top" . $count_n ?>" name="<?php echo "top" . $count_n ?>" hidden>
                        </div>
                        <div id="dessize">
                            <input type="text" value="<?php echo $row1['w'] ?>" id="<?php echo "w" . $count_n ?>" name="<?php echo "w" . $count_n ?>" hidden>
                            <input type="text" value="<?php echo $row1['h'] ?>" id="<?php echo "h" . $count_n ?>" name="<?php echo "h" . $count_n ?>" hidden>
                        </div>
                    </div>
                </div>
            <?php
                $count_n++;
            endwhile ?>
        </div>
    </div>

    <!-- tutorial modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">ขั้นตอนการจองแผงค้า</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="parent">
                        <div>
                            <h5 class="center">1.เข้าสู่ระบบ</h5>
                            <img src="../asset/booking_tutorial/login.jpg" class="w-100">
                        </div>
                        <div>
                            <h5 class="center">2.เลือกตลาดที่สนใจ</h5>
                            <img src="../asset/booking_tutorial/choosemarket.jpg" class="w-100">
                        </div>
                        <div>
                            <h5 class="center">3.เลือกแผงค้าที่ต้องการ</h5>
                            <img src="../asset/booking_tutorial/choosestall.jpg" class="w-100">
                        </div>
                        <div>
                            <h5 class="center">4.กรอกข้อมูล</h5>
                            <img src="../asset/booking_tutorial/fillform.jpg" class="w-100">
                        </div>
                        <div>
                            <h5 class="center">5.ชำระค่ามัดจำ</h5>
                            <img src="../asset/booking_tutorial/pay.jpg" class="w-100">
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="stalltypemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เกี่ยวกับรายการแผงค้า</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    แผงค้าจะมีสีตามประเภทที่ได้กำหนดไว้ดังนี้
                    <br>
                    <table class="table">
                        <thead>
                            <tr></tr>
                            <th scope="col">#</th>
                            <th scope="col">ประเภท</th>
                            <th scope="col">สี</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($z = $zone->fetch_assoc()) : ?>
                                <tr>
                                    <td> <?php echo $count_zone ?></td>
                                    <td><?php echo $z['z_name'] ?></td>
                                    <td>
                                        <div class="text-center rounded" style="background-color:<?php echo $z['z_color'] ?> ;width:150px;color:white; "> ตัวอย่างแผงค้า</div>
                                    </td>
                                </tr>
                            <?php $count_zone++;
                            endwhile ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php require '../backend/modal-stallinfo.php' ?>

</html>
<script>
    // range input
    var rangeSlider = function() {
        var slider = $('.range-slider'),
            range = $('.range-slider__range'),
            value = $('.range-slider__value');

        slider.each(function() {

            value.each(function() {
                var value = $(this).prev().attr('value');
                $(this).html(value);
            });

            range.on('input', function() {
                $(this).next(value).html(this.value);
            });
        });
    };

    rangeSlider();
</script>