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
    include "../backend/1-import-link.php";
    if ($_GET) {
        $mkr_id = $_GET['mkr_id'];
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
    }
    $count_n = 1;
    $result3 = mysqli_query($conn, "SELECT stall.*, zone.* FROM stall JOIN zone ON (stall.z_id = zone.z_id) WHERE (market_id = '$mkr_id' AND `show` = '1')");
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
    <!-- <div class="border rounded shadow-sm p-3 pt-3 mt-3">
        <h5>ขั้นตอนการจองแผงค้า</h5>
        <div>1. เข้าสู่ระบบ</div>
        <div>2. เลือกตลาดที่สนใจ</div>
        <div>3. เลือกแผงค้าที่ต้องการ</div>
        <div>4. กรอกข้อมูล</div>
        <div>5. ชำระค่ามัดจำ</div>
    </div>
    <hr> -->
    <div class="plan">
        <div class="w-100 hstack px-1 pt-3 gap-2">
            <label>ช่วงวันที่ : </label>
            <input type="date" class="form-control" style="width: 10%;" id="customRange1">
            <label>ถึง</label>
            <input type="date" class="form-control" style="width: 10%;" id="customRange1">

            <label>ช่วงราคาค่าเช่า : </label>
            <input type="number" class="form-control" style="width: 10%;" id="customRange1">
            <label>ถึง</label>
            <input type="number" class="form-control" style="width: 10%;" id="customRange1">
            <button type="button" class="btn btn-outline-primary save-stall " id="save"><i class='bx bx-search'></i> ค้นหา </button>
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

    <!-- Modal -->
    <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แผงค้า : <span><?php echo $row1['sID'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>ขนาดแผงค้า</td>
                                <td><?php echo number_format($row1['sWidth']) ?> * <?php echo number_format($row1['sHeight']) ?> <?php echo $row1['sAreaUnit'] ?></td>

                            </tr>
                            <tr>
                                <td>ค่ามัดจำ</td>
                                <td><?php echo number_format($row1['sDept']) ?> บาท</td>
                            </tr>
                            <tr>
                                <td>ค่าเช่า</td>
                                <td><?php echo number_format($row1['sRent']) ?> <?php echo $row1['sPayRange'] ?></td>
                            </tr>
                            <tr>
                                <td>โซน/ประเภทร้านค้า</td>
                                <td>อาหาร</td>
                            </tr>
                            <tr>
                                <td>สถานะ</td>
                                <td>ว่าง</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="plslogin();signIn();">จองแผงค้า</button>
                </div>
            </div>
        </div>
    </div> -->
</body>


</html>