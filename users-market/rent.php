<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - จัดการค่าเช่า</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>
<?php
include "./profilebar.php";
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
$row = mysqli_fetch_array($result);
extract($row);
?>

<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">จัดการค่าเช่า <?php echo $row['mkr_name']; ?></li>
        </ol>
    </nav>
    <h1 class="head_contact">จัดการค่าเช่า</h1>

    <div class="w-100">
        <form method="POST" class="hstack gap-3 mt-3">
            <label>การเช่าในช่วงวันที่ :</label>
            <input type="date" class="form-control" style="width: 10%;">
            <label>ถึง : </label>
            <input type="date" class="form-control" style="width: 10%;">
            <button type="button" class="btn btn-primary">ค้นหา</button>
        </form>
    </div>

    <div id="content">
        <div id="table2" class="border mt-3 p-3 shadow-sm rounded">
            <table id="myTable" class="display " style="width: 100%;">
                <thead>
                    <tr>
                        <th style=" width:4% ; ">ลำดับ</th>
                        <th style=" width:5% ; ">งวดวันที่</th>
                        <th style=" width:8% ; ">รหัสแผง</th>
                        <th style=" width:10% ; ">ชื่อบัญชีผู้ใช้</th>
                        <th style=" width:8% ; ">สถานะ</th>
                        <th style=" width:10% ; ">ค่าเช่าแผง (บาท)</th>
                        <th style=" width:5% ; ">ค่าน้ำ (หน่วย)</th>
                        <th style=" width:5% ; ">ค่าไฟ (หน่วย)</th>
                        <th style=" width:7% ; ">ค่าขยะ (บาท)</th>
                        <th style=" width:10% ; ">จัดการ</th>
                        <th style=" width:13% ; ">ดูรายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1/08/2022</td>
                        <td>A01</td>
                        <td>สหัสทยา</td>
                        <td class="text-danger">ยังไม่ชำระ</td>
                        <td>1000</td>
                        <td><input name="view" type="text" class="form-control"></td>
                        <td><input name="view" type="text" class="form-control"></td>
                        <td><input name="view" type="text" class="form-control"></td>
                        <td>
                            <a href="" class=" btn btn-outline-primary w-100">บันทึก</a>
                        </td>
                        <td class="vstack gap-2">
                            <a href="" class=" btn btn-outline-info">ใบแจ้งหนี้</a>
                            <a href="" class=" btn btn-outline-success">หลักฐานการชำระ</a>

                        </td>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../backend/script.js"></script>

</body>



</html>