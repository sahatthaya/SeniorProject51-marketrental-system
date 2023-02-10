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

    include "../backend/qry-booking.php";

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



    <h1>จองแผงค้า<?php echo $row['mkr_name']; ?></h1>

    <div class="plan">

        <form method="POST" class="border rounded py-1">

            <div class="d-flex justify-content-between px-3">

                <div class="hstack  px-1 gap-2">

                    <label><span class="text-secondary text-decoration-underline">ค้นหา</span> แผงค้าว่างในช่วงวันที่ : </label>

                    <input type="text" name="mkr_id" value="<?php echo $mkr_id ?>" hidden required />

                    <div id="range"></div>

                    <div style="width: 10%;">

                        <input id="start" name="startfilter" value="<?php echo date("d/m/Y", strtotime($startfilter)) ?>" class="form-control bg-white" required />

                    </div>

                    <label>ถึง </label>

                    <div style="width: 10%;">

                        <input id="end" name="endfilter" value="<?php echo  date("d/m/Y", strtotime($endfilter)) ?>" class="form-control  bg-white" required />

                    </div>

                    <label>และ ราคาค่าเช่าไม่เกิน : </label>

                    <div class="hstack gap-2">

                        <div style="width: 35%;">

                            <input id='first' type="text" name="rangeinput" class="form-control" value="<?php echo number_format($range) ?>" autocomplete="off" required />

                        </div>

                        บาท

                        <button type="submit" class="btn btn-outline-primary save-stall " name="save-range"><i class='bx bx-search'></i> ค้นหา </button>
                        <a class="btn btn-outline-danger save-stall " href="booking.php?mkr_id=<?php echo $row['mkr_id']; ?>"><i class='bx bx-reset'></i> รีเซ็ต</a>

                    </div>

                </div>

                <div class="">

                    <i class='ms-1 bx bx-info-circle text-primary fs-4 my-3 mx-2' data-bs-toggle="modal" data-bs-target="#stalltypemodal"></i>

                </div>

            </div>

        </form>



        <hr>
        <?php
        $numRowstall = mysqli_num_rows($result3);
        if ($numRowstall == 0) { ?>
            <h2 class="text-inline mt-10 ">
                <i><span class="text-secondary fs-3 "> ยังไม่มีแผงค้าในขณะนี้ </span></i>
            </h2>
            <div id="plan">

                <?php } else {
                while ($row1 = $result3->fetch_assoc()) : ?>

                    <?php

                    $w = $row1['sWidth'];

                    $h = $row1['sHeight'];



                    $ratio_plan = $row['ratio_plan'];



                    @$width = ($w * $ratio_plan);

                    @$height = ($h * $ratio_plan);



                    @$fs = ($ratio_plan / 3);

                    $opc = "";

                    $sKey =  $row1['sKey'];

                    $rsrange = mysqli_query($conn, "SELECT * FROM stall JOIN booking_range ON (stall.sKey = booking_range.stall_id) JOIN zone ON(zone.z_id = stall.z_id) WHERE (booking_range.`stall_id` = '$sKey' AND `start` <= '$endfilter' AND  '$startfilter' <= `end` )");

                    $numRows = mysqli_num_rows($rsrange);

                    if ($numRows > 0) {
                        if ($row1['sRent'] <= $val) {
                            $free = "";
                            $opc = "0.1";
                            $border = "";
                            $status = "ไม่ว่าง";
                        } else {
                            $opc = "0.1";
                            $free = "";
                            $border = "";
                            $status = "ไม่ว่าง";
                        }
                    } else {
                        if ($row1['sRent'] <= $val) {
                            $opc = "1";
                            $free = "modal_data1";
                            $border = "border border-primary border-3 text-decoration-underline fw-bold";
                            $status = "ว่าง";
                        } else {
                            $free = "modal_data1";
                            $opc = "1";
                            $border = "border border-3 text-decoration-underline fw-bold";
                            $status = "ว่าง";
                        }
                    }

                    ?>


                    <div id="<?php echo $row1['sKey']; ?>" name="<?php echo $status; ?>" class="stallbox <?php echo $free; ?> <?php echo $border; ?>" style="background-color:<?php echo $row1['z_color'] ?> ;left:<?php echo $row1['left'] ?>px;top:<?php echo $row1['top'] ?>px;<?php echo ($row1['left'] != "" ? "position:absolute;" : ""); ?>width:<?php echo $width ?>px;height:<?php echo $height ?>px;opacity:<?php echo $opc ?>;" id="<?php echo $count_n ?>">

                        <div class="stallnum">
                            <div class="text-center text-break" style="font-size:<?php echo $fs ?>px;"><?php echo $row1['sID'] ?>
                            </div>
                        </div>

                    </div>

            <?php

                    $count_n++;

                endwhile;
            } ?>

            </div>

    </div>



    <div class="modal fade" id="stalltypemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">เกี่ยวกับรายการแผงค้า</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">
                    <div class="text-break">
                        เมื่อทำการค้นหาแผงค้าหากแผงค้าที่ไม่เกินราคาที่ค้นหา แผงค้าจะมีขอบสีน้ำเงิน เช่น <button disabled class="bg-secondary border border-primary text-light p-1 rounded border-3 text-decoration-underline fw-bold">ตัวอย่างแผงค้า</button>
                        หรือ หากแผงค้าไม่ว่างในวันเวลาที่ค้นหา แผงค้าจะจางลง เช่น <button disabled class="bg-secondary text-light p-1 rounded opacity-25 ">ตัวอย่างแผงค้า</button>
                    </div>
                    <div class="text-break mt-3">
                        ซึ่งแผงค้าในแผนผังจะมีสีตามประเภทที่ได้กำหนดไว้ดังนี้
                    </div>




                    <table class="table table-bordered rounded mt-1">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ประเภท</th>

                                <th scope="col">สี</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php while ($z = $zone->fetch_assoc()) : ?>

                                <tr>

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

        $("body").on("click", ".modal_data1", function(event) {

            var s_id = $(this).attr("id");
            var status = $(this).attr("name");

            $.ajax({

                url: "../backend/modal-stallinfo.php",

                method: "POST",

                data: {

                    s_id: s_id,
                    status: status

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



    // datepicker



    mobiscroll.datepicker('#range', {

        select: 'range',

        startInput: '#start',

        endInput: '#end'

    });
</script>



</html>