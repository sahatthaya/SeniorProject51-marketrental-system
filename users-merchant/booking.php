<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - จองแผงค้า</title>
    <link rel="shortcut icon" type="image/x-icon" href="../asset/contact/logo.png" />
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
    $data2 = "SELECT * FROM stall WHERE (market_id = '$mkr_id')";
    $result3 = mysqli_query($conn, $data2);
    ?>

</head>

<body>
    <h1>จองแผงค้า<?php echo $row['mkr_name']; ?></h1>
    <div class="border rounded shadow-sm p-3 pt-3 mt-3">
        <h5>ขั้นตอนการจองแผงค้า</h5>
        <div>1. เข้าสู่ระบบ</div>
        <div>2. เลือกตลาดที่สนใจ</div>
        <div>3. เลือกแผงค้าที่ต้องการ</div>
        <div>4. กรอกข้อมูล</div>
        <div>5. ชำระค่ามัดจำ</div>
    </div>
    <hr>
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
            <button type="button" class="btn btn-outline-primary save-stall" id="save"><i class='bx bx-search'></i> ค้นหา </button>
        </div>
        <hr>
        <div id="plan">

            <div class="liststall vstack" id="sortable">
                <?php while ($row1 = $result3->fetch_assoc()) : ?>
                    <a class="m-1 text-decoration-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <div class="stallbox" data-need="<?php echo $row1['sKey'] ?>">
                            <div class="text-center stallnum">
                                <div class="mx-auto text-wrap">แผงค้า : <span><?php echo $row1['sID'] ?></span></div>
                            </div>
                        </div>
                    </a>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <td><?php echo $row1['sWidth'] ?> * <?php echo $row1['sHeight'] ?> <?php echo $row1['sAreaUnit'] ?></td>

                                            </tr>
                                            <tr>
                                                <td>ค่ามัดจำ</td>
                                                <td><?php echo $row1['sDept'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>ค่าเช่า</td>
                                                <td><?php echo $row1['sRent'] ?> <?php echo $row1['sPayRange'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>โซน/ประเภทร้านค้า</td>
                                                <td>อาหาร</td>
                                            </tr>
                                            <tr>
                                                <td>สถานะ</td>
                                                <td><?php echo $row1['sStatus'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-primary" href="booking-form.php">จองแผงค้า</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile ?>
            </div>
        </div>
    </div>
</body>


</html>