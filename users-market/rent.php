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

require "../backend/invoice.php";

$open = $row['opening'];

$querystatusinv = mysqli_query($conn, "SELECT `invoice`.*,booking.b_fname,booking.b_lname,stall.sID FROM `invoice`,booking,stall WHERE (booking.b_id = invoice.b_id AND stall.sKey = booking.stall_id AND `mkr_id`= $mkr_id )");

?>



<body>

    <nav aria-label="breadcrumb mb-3">

        <ol class="breadcrumb ">

            <li class="breadcrumb-item fs-5 "><a href="./index.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none">หน้าหลัก</a></li>

            <li class="breadcrumb-item active fs-5" aria-current="page">จัดการค่าเช่า <?php echo $row['mkr_name']; ?></li>

        </ol>

    </nav>

    <h1 class="head_contact">จัดการค่าเช่า</h1>

    <div id="content">

        <div id="table2" class="border mt-3 p-3 shadow-sm rounded">
            <div class="w-100 d-flex justify-content-between">
                <h5>ตารางข้อมูลใบเรียกเก็บค่าเช่าทั้งหมด</h5>
                <a href="./invoice.php?mkr_id=<?php echo $mkr_id ?>" type="button" class="btn btn-primary"><i class='bx bxs-file-plus me-2'></i>สร้างใบเรียกเก็บค่าเช่า</a>

            </div>
            <hr>
            <table id="myTable" class="display table table-striped dt-responsive " style="width: 100%;">
                <thead>

                    <tr>

                        <th style=" width:4% ; ">ลำดับ</th>

                        <th style=" width:8% ; ">วันที่สร้าง</th>

                        <th style=" width:10% ; ">รหัสใบเรียกเก็บค่าเช่า</th>

                        <th style=" width:8% ; ">รหัสแผงค้า</th>

                        <th style=" width:10% ; ">ผู้จอง</th>

                        <th style=" width:8% ; ">สถานะ</th>

                        <th style=" width:8% ; ">ดูรายละเอียด</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while ($row = $querystatusinv->fetch_assoc()) :

                    ?>

                        <tr>

                            <td><?php echo  $count_n ?></td>

                            <td><?php echo  date("วันที่ d/m/Y", strtotime($row['INV_created'])) ?></td>

                            <td><?php echo $row['INV_id'] ?></td>

                            <td><?php echo $row['sID'] ?></td>

                            <td><?php echo $row['b_fname'] . ' ' . $row['b_lname'] ?></td>

                            <?php

                            if ($row['INV_status'] == '1') {

                                echo '<td class="text-danger">ยังไม่ชำระ</td>';
                            } else {

                                echo '<td class="text-success">ชำระแล้ว</td>';
                            }

                            ?>

                            <td><a type="button" href="../ExportPDF-master/inv_info-m.php?INV_id=<?php echo $row['INV_id'] ?>" class="btn btn-outline-primary">ดูรายละเอียด</a></td>

                        </tr>

                    <?php $count_n++;

                    endwhile; ?>

                </tbody>

            </table>

        </div>

    </div>

    <script src="../backend/script.js"></script>

</body>



</html>