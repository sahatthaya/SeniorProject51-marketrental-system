<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - ข้อมูลการจองแผงค้า</title>
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>
<?php
include "profilebar.php";
?>
<?php
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";

if (isset($_GET["b_id"])) {
    $id = $_GET["b_id"];
    $resultdata = mysqli_query($conn, "SELECT * FROM market_detail,booking_range,stall WHERE booking_range.stall_id=stall.sKey and stall.market_id = market_detail.mkr_id and b_id = '$id'");
    $row = mysqli_fetch_array($resultdata);
    extract($row);
}
?>


<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./rent.php" class="text-decoration-none">จัดการการจอง</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">ข้อมูลการจองแผงค้า</li>
        </ol>
    </nav>
    <div class="content">
        <h1 id="headline">ข้อมูลการจองแผงค้า</h1>
        <div>
            <div id="table" class="bannertb border p-3 shadow-sm rounded mt-2">
                <h5>ข้อมูลการจอง</h5>
                <hr>
                <table class="display table" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td width="30%"><label>ตลาด</label></td>
                            <td width="70%"><?php echo $row['mkr_name'] ?></td>
                        </tr>
                        <tr>
                            <td width="30%"><label>รหัสแผงค้า</label></td>
                            <td width="70%"><?php echo  $row["sID"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%"><label>ช่วงวันที่จอง</label></td>
                            <td width="70%"><?php echo date("d/m/Y", strtotime($row['start'])) ?> - <?php echo date("d/m/Y", strtotime($row['end'])) ?></td>
                        </tr>
                        <tr>
                            <td width="30%"><label>ระยะเวลาที่จอง</label></td>
                            <td width="70%"><?php echo $row["day"] ?> วัน</td>
                        </tr>
                        <tr>
                            <td width="30%"><label>ราคาค่าเช่าแผง</label></td>
                            <td width="70%"><?php echo number_format($row["sRent"]) ?> <?php echo $row["sPayRange"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%"><label>ราคาค่ามัดจำ</label></td>
                            <td width="70%"><?php echo number_format($row["sDept"]) ?> บาท</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div id="table" class="bannertb border p-3 shadow-sm rounded mt-2">
                <h5>ข้อมูลการชำระเงิน</h5>
                <hr>
                <table class="table ">
                    <tr>
                        <td width="30%"><label>รหัสการชำระ</label></td>
                        <td width="70%"><?php echo $row["code_pay"] ?></td>
                    </tr>
                    <tr>
                        <td width="30%"><label>ชำระเงินเมื่อวันที่</label></td>
                        <td width="70%"><?php echo  date("d/m/Y เวลา h:ia", strtotime($row['timestamp'])) ?></td>
                    </tr>
                    <tr>
                        <td width="30%"><label>ค่ามัดจำ</label></td>
                        <td width="70%"><?php echo number_format($row["dept_pay"]) ?> บาท</td>
                    </tr>
                    <tr>
                        <td width="30%"><label>ค่าบริการและภาษี <span class="text-secondary">(4.07%)</span></label></td>
                        <td width="70%"><?php echo number_format($row["fee_pay"]) ?> บาท</td>
                    </tr>
                    <tr>
                        <td width="30%"><label>รวมทั้งสิ้น</label></td>
                        <td width="70%"><?php echo number_format($row["total_pay"]) ?> บาท</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="../backend/script.js"></script>

</html>