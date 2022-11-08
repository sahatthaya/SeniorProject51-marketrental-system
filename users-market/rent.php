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
$open = $row['opening'];
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
                        <th style=" width:5% ; ">รหัสใบเรียกเก็บค่าเช่า</th>
                        <th style=" width:8% ; ">รหัสแผงค้า</th>
                        <th style=" width:10% ; ">จำนวนเงิน (บาท)</th>
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
                            <td><?php echo  date("วันที่ d/m/Y เวลา h:ia", strtotime($row['INV_created'])) ?></td>
                            <td><?php echo $row['INV_id'] ?></td>
                            <td><?php echo $row['sID'] ?></td>
                            <td><?php echo $row['INV_total'] ?></td>
                            <td><?php echo $row['b_fname'] . ' ' . $row['b_lname'] ?></td>
                            <?php
                            if ($row['status'] == '1') {
                                echo '<td class="text-danger">ยังไม่ชำระ</td>';
                            } else {
                                echo '<td class="text-success">ชำระแล้ว</td>';
                            }
                            ?>
                            <td><button type="button" id="<?php echo $row['INV_id'] ?>" class="btn btn-outline-primary modal_data2">ดูรายละเอียด</button></td>
                        </tr>
                    <?php $count_n++;
                    endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../backend/script.js"></script>
</body>
<?php require '../backend/modal-invoice.php' ?>

<script>
    $(document).ready(function() {
        $('.modal_data2').click(function() {
            var INV_id = $(this).attr("id");
            $.ajax({
                url: "../backend/modal-invoice.php",
                method: "POST",
                data: {
                    INV_id: INV_id
                },
                success: function(data) {
                    $('#bannerdetail').html(data);
                    $('#bannerdataModal').modal('show');
                }
            });

        })

    });
</script>

</html>