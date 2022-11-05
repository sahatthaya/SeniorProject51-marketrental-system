<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - การจองทั้งหมด</title>

    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>
<?php
include "profilebar.php";
?>
<?php
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
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
$row1 = mysqli_fetch_array($result);
extract($row1);

$count_n = 1;
if ($row1['opening'] == 'เปิดทำการทุกวัน') {
    $query = mysqli_query($conn, "SELECT * FROM `booking_range`JOIN `stall` ON (booking_range.stall_id = stall.sKey) WHERE `stall`.market_id = $mkr_id ORDER BY `b_start` ASC");
} else {
    $query = mysqli_query($conn, "SELECT * FROM `booking_period`JOIN `stall` ON (booking_period.stall_id = stall.sKey)JOIN `opening_period` ON (booking_period.op_id = opening_period.id) WHERE `stall`.market_id = $mkr_id ORDER BY `start` ASC");
}

?>

<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">การจองทั้งหมด <?php echo $row1['mkr_name']; ?></li>
        </ol>
    </nav>
    <div class="content">
        <h1 id="headline">การจองทั้งหมด</h1>
        <form method="POST" class="hstack gap-3 mt-3 b-date">
            <label>การจองในช่วงวันที่ :</label>
            <input type="date" class="form-control" style="width: 10%;">
            <label>ถึง : </label>
            <input type="date" class="form-control" style="width: 10%;">
            <button type="button" class="btn btn-primary">ค้นหา</button>
        </form>
        <div>
            <div id="table" class="bannertb border p-3 shadow-sm rounded mt-3">
                <table id="myTable" class="display " style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">วันที่เริ่มจอง</th>
                            <th scope="col">วันที่สิ้นสุด</th>
                            <th scope="col">รหัสแผงค้า</th>
                            <th scope="col">วันที่จอง</th>
                            <th scope="col">หมายเหตุ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $query->fetch_assoc()) : ?>
                            <?php if ($row1['opening'] == 'เปิดทำการทุกวัน') {
                                $start = date('d/m/Y', strtotime($row['start']));
                                $end = date('d/m/Y', strtotime($row['end']));
                                $timestamp = date('d/m/Y', strtotime($row['timestamp']));
                                $status =  $row['status'] == '1' ? '-' : 'การจองถูกยกเลิก';
                                $table = "  <tr>
                                            <td>" . $count_n . "</td>
                                            <td> " . $start . " </td>
                                            <td>" . $end . "</td>
                                            <td>" . $row['sID'] . "</td>
                                            <td>" . $timestamp . "</td>
                                            <td>" . $status . "</td>
                                            </tr>";
                                echo $table;
                            } else {
                                $start = date('d/m/Y', strtotime($row['start']));
                                $end = date('d/m/Y', strtotime($row['end']));
                                $timestamp = date('d/m/Y', strtotime($row['timestamp']));
                                $status =  $row['status'] == '1' ? '-' : 'การจองถูกยกเลิก';
                                $table = "  <tr>
                                <td>" . $count_n . "</td>
                                <td> " . $start . " </td>
                                <td>" . $end . "</td>
                                <td>" . $row['sID'] . "</td>
                                <td>" . $timestamp . "</td>
                                <td>" . $status . "</td>
                                </tr>";
                                echo $table;
                            } ?>

                        <?php $count_n++;
                        endwhile; ?>
                    </tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="../backend/script.js"></script>

</html>