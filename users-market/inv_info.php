<?php
include "./profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";

if (isset($_GET["INV_id"])) {
    $INV_id = $_GET["INV_id"];
    $resultdata = mysqli_query($conn, "SELECT invoice.INV_id AS invid,`invoice`.*,booking_range.*,stall.* FROM `invoice`,`booking_range`,`stall` WHERE (booking_range.b_id = invoice.b_id AND stall.sKey = booking_range.stall_id AND invoice.INV_id = $INV_id)");
    $row = mysqli_fetch_array($resultdata);
    extract($row);
}

$qrycost = mysqli_query($conn, "SELECT * FROM `inv_cost` WHERE `INV_id`= '$INV_id'");
$qrycost2 = mysqli_query($conn, "SELECT * FROM `inv_cost` WHERE `INV_id`= '$INV_id'");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - ข้อมูลการจองแผงค้า</title>
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
    <link rel="stylesheet" href="../css/reciept.css" type="text/css">
</head>

<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item fs-5 "><a href="./rent.php?mkr_id=<?php echo $mkr_id ?>" class="text-decoration-none">จัดการค่าเช่า</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">ข้อมูลใบเรียกเก็บค่าเช่า <?php echo  $row["invid"] ?></li>
        </ol>
    </nav>
    <div class="content">
        <h1 id="headline">ข้อมูลใบเรียกเก็บค่าเช่า (รหัส <?php echo  $row["invid"] ?>)</h1>

        <div id="table" class="bannertb border p-3 shadow-sm rounded mt-2">
            <div class="fs-5">ข้อมูลใบเรียกเก็บค่าเช่า</div>
            <hr>
            <div class="row mb-2">
                <div class="col-2">วันที่สร้าง</div>
                <div class="col-3"><?php echo date("d/m/Y", strtotime($row['INV_created'])) ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-2">หมดเขตชำระภายในวันที่</div>
                <div class="col-3"><?php echo date("d/m/Y", strtotime($row['INV_expired'])) ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-2">รหัสแผงค้า</div>
                <div class="col-3"><?php echo  $row["sID"] ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-2">รายละเอียดค่าใช้จ่ายเพิ่มเติม</div>
                <div class="col-3">
                    <?php
                    $numRowsop2 = mysqli_num_rows($qrycost2);
                    if ($numRowsop2 > 0) {
                        while ($c = mysqli_fetch_assoc($qrycost2)) : ?>
                            - <?php echo $c["cost_name"] ?> <?php echo number_format($c["price/unit"]) ?> <?php echo $c["unit"] ?><br>
                        <?php endwhile;
                    } else {
                        ?>
                        -
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-2">สถานะ</div>
                <div class="col-3">
                    <?php
                    if ($row["INV_status"] = 1) { ?>
                        <span class="text-danger">ยังไม่ชำระ</span>
                    <?php } else { ?>
                        <span class="text-success">ชำระแล้ว</span> <button type="button" class="btn btn-link">ดูรายละเอียดการขำระ</button>
                    <?php } ?>
                </div>
            </div>
            <table class="display table table-striped table-hover " style="width: 100%;">
                <thead class="table-dark">
                    <tr>
                        <th>ลำดับ</th>
                        <th>รายการ</th>
                        <th>รายละเอียด</th>
                        <th>จำนวนเงิน</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>ค่าเช่า</td>
                        <td>- </td>
                        <td>+ <?php echo number_format($row["INV_rentprice"]) ?> บาท</td>
                    </tr>
                    <?php
                    if ($row["INV_discount"] != 0) {
                        $count = 2;
                    ?>
                        <tr>
                            <td>2</td>
                            <td>คืนค่ามัดจำ</td>
                            <td>-</td>
                            <td>- <?php echo number_format($row["INV_discount"]) ?> บาท</td>
                        </tr>
                        <?php
                    } else {
                        $count = 1;
                    }
                    $numRowsop = mysqli_num_rows($qrycost);
                    if ($numRowsop > 0) {
                        $cost = 0;
                        while ($rowc = mysqli_fetch_assoc($qrycost)) :
                            $unit = floor($rowc["price"] / $rowc["price/unit"]);
                            if ($rowc["unit"] == "(เหมาจ่าย)") {
                                $detail = '';
                            } else {
                                $detail =  " x " . number_format($unit) . " หน่วย = " . number_format($rowc["price"]) . " บาท";
                            }
                        ?>
                            <tr>
                                <td><?php echo $count + 1 ?></td>
                                <td><?php echo $rowc["cost_name"] ?></td>
                                <td><?php echo number_format($rowc["price/unit"]) . " " . $rowc["unit"] . $detail ?></td>
                                <td>+ <?php echo number_format($rowc["price"]) ?> บาท</td>
                            </tr>
                    <?php
                            $cost = $cost + $rowc["price"];
                            $count++;
                        endwhile;
                    } else {
                        $cost = 0;
                    }

                    $total = $row["INV_rentprice"] - $row["INV_discount"] + $cost;
                    ?>

                    <tr class="fw-bold">
                        <td>#</td>
                        <td>รวมทั้งสิ้น</td>
                        <td>-</td>
                        <td>= <?php echo number_format($total) ?> บาท</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>