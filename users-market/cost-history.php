<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - ข้อมูลการเงิน</title>

    <!-- css  -->
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>

<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
include "../backend/manage_cost.php";
?>

<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php?mkr_id=<?php echo $row1['mkr_id']; ?>" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">ค่าใช้จ่ายเพิ่มเติม <?php echo $row1['mkr_name'] ?></li>
        </ol>
    </nav>
    <h1 class="head_contact">ประวัติการจดค่าใช้จ่ายเพิ่มเติม</h1>
    <a type="button" class="btn btn-primary add-btn text-light" id="partner-btn" href="./cost.php?mkr_id=<?php echo $row1['mkr_id'] ?>">
        <i class="bx bx-tachometer"></i> จดค่าใช้จ่ายเพิ่มเติม
    </a>
    <div id="table2" class="border mt-3 p-3 shadow-sm rounded">
        <table id="myTable" class="display " style="width: 100%;">
            <thead>
                <tr>
                    <th>
                        ลำดับ
                    </th>
                    <th>
                        รอบที่จด
                    </th>
                    <th>
                        ประเภทค่าใช้จ่าย
                    </th>
                    <th>
                        รหัสแผงค้า
                    </th>
                    <th>
                        หน่วยที่ใช้ (หน่วย)
                    </th>
                    <th>
                        คิดเป็นเงิน (บาท)
                    </th>
                    <th>
                        วันที่จด
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $count = '1';
                while ($table = $querycost->fetch_assoc()) : ?>
                    <tr>
                        <td>
                            <?php echo $count ?>
                        </td>
                        <td>
                            <?php echo $table['cost_period'] ?>
                        </td>
                        <td>
                            <?php echo $table['cu_name'] ?>
                        </td>
                        <td>
                            <?php echo $table['sID'] ?>
                        </td>
                        <td>
                            <?php echo $table['c_unit'] ?>
                        </td>
                        <td>
                            <?php echo $table['c_totalbath'] ?>
                        </td>
                        <td>
                            <?php echo  date("วันที่ d/m/Y", strtotime($table['timestamp'])) ?>
                        </td>
                    </tr>
                <?php
                    $count++;
                endwhile
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>