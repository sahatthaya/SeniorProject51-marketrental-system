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
    include "../backend/1-import-link.php";
    $mkr_id = $_GET['mkr_id'];
    $count_n = 1;
    $data2 = "SELECT stall.*, zone.* FROM stall JOIN zone ON (stall.z_id = zone.z_id) WHERE (market_id = '$mkr_id' AND `show` = '1')";
    $result3 = mysqli_query($conn, $data2);
    $zone = mysqli_query($conn, "SELECT * FROM `zone`");
    require "../backend/manage-edit-Stall.php";
    $sql = "SELECT market_detail.*,users.username ,
    provinces.province_name,
    amphures.amphure_name,
    districts.district_name , 
    market_type.market_type
    FROM market_detail 
        JOIN users ON (market_detail.users_id = users.users_id)
        JOIN provinces ON (market_detail.province_id = provinces.id)
        JOIN amphures ON (market_detail.	amphure_id = amphures.id)
        JOIN districts ON (market_detail.district_id = districts.id)
        JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)
         WHERE (a_id='1' AND mkr_id = '$mkr_id') ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    extract($row);


    // // แบบแก้ไซส์ได้
    // if (isset($_POST['save'])) {
    //     $numRows = mysqli_num_rows($result3);
    //     for ($i = 1; $i <= $numRows; $i++) {
    //         $idi = "id$i";
    //         $lefti = "left$i";
    //         $topi = "top$i";
    //         $wi = "w$i";
    //         $hi = "h$i";
    //         $id = $_POST[$idi];
    //         $left = $_POST[$lefti];
    //         $top = $_POST[$topi];
    //         $w = $_POST[$wi];
    //         $h = $_POST[$hi];
    //         if (isset($id) && isset($top) && isset($left) && isset($w) && isset($h)) {
    //             $InsertSameCrop = mysqli_query($conn, "UPDATE `stall` SET `left`='$left',`top`='$top',`width`='$w',`height`='$h' WHERE `sKey`= '$id'");
    //             if ($InsertSameCrop) {
    //             } else {
    //                 echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง')</script>";
    //             }
    //         } else {
    //             echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง ไม่พบข้อมูลความกว้าง + ยาว')</script>";
    //         }
    //     }
    //     echo "<script>alert('ok')</script>";
    // }

    if (isset($_POST['save'])) {
        $numRows = mysqli_num_rows($result3);
        for ($i = 1; $i <= $numRows; $i++) {
            $idi = "id$i";
            $lefti = "left$i";
            $topi = "top$i";
            $id = $_POST[$idi];
            $left = $_POST[$lefti];
            $top = $_POST[$topi];
            if (isset($id) && isset($top) && isset($left)) {
                $InsertSameCrop = mysqli_query($conn, "UPDATE `stall` SET `left`='$left',`top`='$top' WHERE `sKey`= '$id'");
                if ($InsertSameCrop) {
                } else {
                    echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง')</script>";
                }
            } else {
                echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง ไม่พบข้อมูล')</script>";
            }
        }
        echo "<script type='text/javascript'> success(); </script>";
        echo '<meta http-equiv="refresh" content="1"; URL=../users-market/edit-stall.php" />';
    }

    if (isset($_POST['save-ratio'])) {
        $ratio = $_POST['ratio'];
        if (isset($ratio) != "") {
            $udratio = mysqli_query($conn, "UPDATE `market_detail` SET `ratio_plan`='$ratio' WHERE mkr_id = '$mkr_id'");
            if ($udratio) {
                echo "<script type='text/javascript'> success(); </script>";
                echo '<meta http-equiv="refresh" content="1"; URL=../users-market/edit-stall.php" />';
            } else {
                echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง')</script>";
            }
        } else {
            echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง ไม่พบข้อมูล')</script>";
        }
    }
    ?>

</head>
<script type="text/javascript">
    $(document).ready(function() {
        $(".stallbox").draggable({
            containment: "#plan",
            cursor: "move",
            grid: [ 10, 10 ],
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

<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item fs-5 "><a href="edit-Stall.php?mkr_id=<?php echo $row['mkr_id'] ?>" class="text-decoration-none">จัดการข้อมูลแผงค้า<?php echo $row['mkr_name']; ?></a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">จัดการข้อมูลแผงค้า <?php echo $row['mkr_name']; ?></li>
        </ol>
    </nav>

    <h1>แก้ไขแผนผังตลาด<i class='ms-1 bx bx-info-circle text-primary fs-4' data-bs-toggle="modal" data-bs-target="#exampleModal"></i></h1>

    <div class="content">
        <div class="plan border shadow-sm rounded">

            <div class="w-100 hstack justify-content-between px-1 pt-3">
                <div class="hstack gap-3">
                    <h3>แผนผังตลาด</h3>
                    <form method="POST">
                        <div class="hstack gap-2">
                            (กำหนดสัดส่วนขนาดของแผงค้า 1เมตร : <input name="ratio" type="number" class="form-control" style="width:70px;height:30px;" value="<?php echo $row['ratio_plan']; ?>">พิกเซล
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

                    $ratio_plan = $row['ratio_plan'];
                    
                    @$width = ($w * $ratio_plan);
                    @$height = ($h * $ratio_plan);

                    @$fs = ($ratio_plan/3);
                    ?>
                    <div class="stallbox" style="background-color:<?php echo $row1['z_color'] ?> ;left:<?php echo $row1['left'] ?>px;top:<?php echo $row1['top'] ?>px;<?php echo ($row1['left'] != "" ? "position:absolute;" : ""); ?>width:<?php echo $width ?>px;height:<?php echo $height ?>px;" id="<?php echo $count_n ?>">
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