<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - จองแผงค้า</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/stallplan.css" type="text/css">

    <?php
    include "profilebar.php";
    include "nav.php";
    include "../backend/1-connectDB.php";
    include "../backend/qry-booking-period.php";
    ?>

</head>

<body>
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
            <div class="d-flex justify-content-between px-3">
                <div class="hstack px-1 gap-2">
                    <label><span class="text-secondary text-decoration-underline">ค้นหา</span> แผงค้าว่างในวันที่ : </label>
                    <div>
                        <select name="op_id" id="daterangerent" class="form-select">
                            <?php while ($rowcalen = mysqli_fetch_assoc($qryrentperiod)) : ?>
                                <option value="<?php echo $rowcalen['id'] ?>">รอบวันที่ <?php echo date("d/m/Y", strtotime($rowcalen['start'])) ?> ถึง <?php echo date("d/m/Y", strtotime($rowcalen['end']))  ?> ( จำนวน <?php echo $rowcalen['day'] ?> วัน )</option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <label>และ ราคาค่าเช่าไม่เกิน : </label>
                    <div class="hstack gap-2">
                        <input id='first' type="text" name="rangeinput" class="form-control w-50" value="<?php echo number_format($range) ?>" autocomplete="off" required />บาท
                        <button type="submit" class="btn btn-outline-primary save-stall " name="save-period"><i class='bx bx-search'></i> ค้นหา </button>
                    </div>
                </div>
                <div>
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
                $opc = "";
                $sKey =  $row1['sKey'];

                if ($row1['sRent'] <= $val) {
                    $rsrange = mysqli_query($conn, "SELECT * FROM stall JOIN booking_period ON (stall.sKey = booking_period.stall_id) WHERE (`stall_id` = '$sKey' AND `op_id` = '$op_id')");
                    $numRows = mysqli_num_rows($rsrange);
                    if ($numRows > 0) {
                        $opc = "0.2";
                        $free = "ไม่ว่าง";
                    } else {
                        $opc = "1";
                        $free = "ว่าง";
                    }
                } else {
                    $opc = "0.2";
                    $free = "";
                }
                ?>

                <div id="<?php echo $row1['sKey']; ?>" class="stallbox modal_data1" style="background-color:<?php echo $row1['z_color'] ?> ;left:<?php echo $row1['left'] ?>px;top:<?php echo $row1['top'] ?>px;<?php echo ($row1['left'] != "" ? "position:absolute;" : ""); ?>width:<?php echo $width ?>px;height:<?php echo $height ?>px;opacity:<?php echo $opc ?>" id="<?php echo $count_n ?>">
                    <div class="stallnum">
                        <div class="text-center text-break" style="font-size:<?php echo $fs ?>px;"><?php echo $row1['sID'] ?>
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

</body>

<script>
    //detail popup
    $(document).ready(function() {
        $('.modal_data1').click(function() {
            var s_id = $(this).attr("id");
            $.ajax({
                url: "../backend/modal-stallinfo.php",
                method: "POST",
                data: {
                    s_id: s_id
                },
                success: function(data) {
                    $('#bannerdetail').html(data);
                    $('#bannerdataModal').modal('show');
                }
            });

        })
    });

    $("#first").keyup(function(event) {

        // skip for arrow keys
        if (event.which >= 37 && event.which <= 40) return;

        // format number
        $(this).val(function(index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });

        var firstValue = Number($('#first').val().replace(/,/g, ''));
    });
</script>

</html>