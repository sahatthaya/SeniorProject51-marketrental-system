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
require "../backend/invoice.php";

?>

<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">จัดการค่าเช่า <?php echo $row['mkr_name']; ?></li>
        </ol>
    </nav>
    <h1 class="head_contact">จัดการค่าเช่า</h1>
    <div class="w-100 text-end">
        <a href="./invoice.php?mkr_id=<?php echo $mkr_id ?>" type="button" class="btn btn-primary"><i class='bx bxs-file-plus me-2'></i>ส่งใบเรียกเก็บค่าเช่า</a>
    </div>

    <div id="content">
        <div id="table2" class="border mt-3 p-3 shadow-sm rounded">
            <table id="myTable" class="display " style="width: 100%;">
                <thead>
                    <tr>
                        <th style=" width:4% ; ">ลำดับ</th>
                        <th style=" width:5% ; ">วันที่ส่งใบเรียกเก็บค่าเช่า</th>
                        <th style=" width:5% ; ">งวดที่</th>
                        <th style=" width:8% ; ">รหัสแผงค้า</th>
                        <th style=" width:10% ; ">จำนวนเงิน (บาท)</th>
                        <th style=" width:10% ; ">ผู้จอง</th>
                        <th style=" width:8% ; ">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1/08/2022</td>
                        <td>1 </td>
                        <td>A01</td>
                        <td>1000.00</td>
                        <td>สหัสทยา เทียนมงคล</td>
                        <td class="text-danger">ยังไม่ชำระ</td>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../backend/script.js"></script>

</body>



</html>