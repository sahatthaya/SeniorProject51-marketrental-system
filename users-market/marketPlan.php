<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - แก้ไขแผนผังตลาด</title>





    <!-- css  -->

    <link rel="stylesheet" href="../css/market-plan.css" type="text/css">



    <?php

    include "profilebar.php";

    include "nav.php";

    include "../backend/1-connectDB.php";

    require "../backend/manage-edit-Stall.php";

    require "../backend/marketplan.php";

    ?>



</head>

<script type="text/javascript">
    function checkmediawidth() {
        let details = navigator.userAgent;

        let regexp = /android|iphone|kindle|ipad/i;

        let isMobileDevice = regexp.test(details);

        if (isMobileDevice) {
            Swal.fire({

                title: 'กรุณาเปิดผ่านคอมพิวเตอร์',
                text: 'ฟังก์ชันการแก้ไขแผนผังแผงค้ารองรับบนคอมพิวเตอร์เท่านั้น',

                icon: 'warning',

                showConfirmButton: false,

                timer: 3000

            })
        } else {

        }

    }

    $(document).ready(function() {

        $(".stallbox").draggable({

            containment: "#plan",

            cursor: "move",

            grid: [10, 10],

            stop: function(event, ui) {

                var elem = $(this),

                    id = elem.attr('id'),

                    desc = elem.attr('data-desc'),

                    pos = elem.position(),

                    posleft = pos.left,

                    postop = pos.top,

                    info = {

                        id: id,

                        posleft: posleft,

                        postop: postop

                    };

                // elempos.push(info);

                var

                    inputleft = document.getElementById('left' + id),

                    inputtop = document.getElementById('top' + id);



                inputleft.value = posleft;

                inputtop.value = postop;





            }

        });

        // $(".stallbox").resizable({

        //     containment: "#plan",

        //     cursor: "move",

        //     stop: function(evt, ui) {

        //         $(ui.helper).css("position", "absolute")

        //         var elem = $(this),

        //             id = elem.attr('id'),

        //             widthsize = elem.css("width"),

        //             heightsize = elem.css("height"),

        //             size = {

        //                 id: id,

        //                 width: widthsize,

        //                 height: heightsize,

        //             };

        //         // elemsize.push(size);

        //         var

        //             inputw = document.getElementById('w' + id),

        //             inputh = document.getElementById('h' + id);



        //         inputw.value = widthsize;

        //         inputh.value = heightsize;

        //     }

        // });

    });
</script>



<body onload="checkmediawidth()">

    <nav aria-label="breadcrumb mb-3">

        <ol class="breadcrumb ">

            <li class="breadcrumb-item fs-5 "><a href="./index.php?mkr_id=<?php echo $rowmkp['mkr_id']; ?>" class="text-decoration-none">หน้าหลัก</a></li>

            <li class="breadcrumb-item fs-5 "><a href="edit-Stall.php?mkr_id=<?php echo $rowmkp['mkr_id'] ?>" class="text-decoration-none">จัดการข้อมูลแผงค้า<?php echo $rowmkp['mkr_name']; ?></a></li>

            <li class="breadcrumb-item active fs-5" aria-current="page">จัดการข้อมูลแผงค้า <?php echo $rowmkp['mkr_name']; ?></li>

        </ol>

    </nav>



    <h1>แก้ไขแผนผังตลาด<i class='ms-1 bx bx-info-circle text-primary fs-4' data-bs-toggle="modal" data-bs-target="#exampleModal"></i></h1>



    <div class="content ">

        <div class="plan border shadow-sm rounded mt-4">



            <div class="w-100 hstack justify-content-between px-1 pt-3">

                <div class="hstack gap-3">

                    <h3>แผนผังตลาด</h3>

                    <form method="POST">

                        <div class="hstack gap-2">

                            (กำหนดสัดส่วนขนาดของแผงค้า 1เมตร : <input name="ratio" min="1" type="number" class="form-control" style="width:70px;height:30px;" value="<?php echo $rowmkp['ratio_plan']; ?>">พิกเซล

                            <button type="submit" class="btn btn-outline-primary p-0" name="save-ratio" style="width:70px;height:30px;">บันทึก</button>)

                        </div>

                    </form>

                </div>

                <form method="POST">

                    <button type="submit" class="btn btn-outline-success save-stall" id="saveplan" name="save">บันทึกแผนผัง</button>

            </div>
            <hr>

            <div id="plan">

                <?php while ($row1 = $result3->fetch_assoc()) : ?>

                    <?php

                    $w = $row1['sWidth'];

                    $h = $row1['sHeight'];



                    $ratio_plan = $rowmkp['ratio_plan'];



                    @$width = ($w * $ratio_plan);

                    @$height = ($h * $ratio_plan);



                    @$fs = ($ratio_plan / 3);

                    ?>

                    <div class="stallbox" style="background-color:<?php echo $row1['z_color'] ?> ;left:<?php echo $row1['left'] ?>px;top:<?php echo $row1['top'] ?>px;<?php echo ($row1['left'] != "" ? "position:absolute;" : ""); ?>width:<?php echo $width ?>px;height:<?php echo $height ?>px;" id="<?php echo $count_n ?>">

                        <div class="stallnum">

                            <div class="text-center text-break" style="font-size:<?php echo $fs ?>px;"><?php echo $row1['sID'] ?></div>

                            <div id="despos">

                                <input type="text" value="<?php echo $row1['sKey'] ?>" id="<?php echo "id" . $count_n ?>" name="<?php echo "id" . $count_n ?>" hidden>

                                <input type="text" value="<?php echo $row1['left'] ?>" id="<?php echo "left" . $count_n ?>" name="<?php echo "left" . $count_n ?>" hidden>

                                <input type="text" value="<?php echo $row1['top'] ?>" id="<?php echo "top" . $count_n ?>" name="<?php echo "top" . $count_n ?>" hidden>

                            </div>


                        </div>

                    </div>

                <?php

                    $count_n++;

                endwhile ?>

            </div>

            </form>

        </div>



    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

                                    <td> <?php echo $count_n ?></td>

                                    <td><?php echo $z['z_name'] ?></td>

                                    <td>

                                        <div class="text-center rounded" style="background-color:<?php echo $z['z_color'] ?> ;width:150px;color:white; "> ตัวอย่างแผงค้า</div>

                                    </td>

                                </tr>

                            <?php $count_n++;

                            endwhile ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</body>





</html>