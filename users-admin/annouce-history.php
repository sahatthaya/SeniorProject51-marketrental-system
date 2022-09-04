<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - คำร้องประชาสัมพันธ์</title>
    
    <!-- css  -->
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
require "../backend/manage-annouce.php";
?>

<body>
    <h1 class="head_contact">ประวัติคำร้องประชาสัมพันธ์ทั้งหมด</h1>
    <div id="labelbn" class="col-12 toptb">
        <div id="labelbn" class="col-8">
        </div>
        <!-- Button modal -->
        <div id="addbn" class="col-4">
            <a id="addbn" type="button" class="btn btn-primary" href="./annouce.php">
            <i class='bx bx-clipboard'></i> จัดการคำร้องขอประชาสัมพันธ์
            </a>
        </div>
    </div>
    <div id="content">
        <div id="table2"  class="border p-3 shadow-sm rounded">
            <table id="myTable" class="display " style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">วันที่ส่งคำร้อง</th>
                        <th scope="col">หัวข้อ</th>
                        <th scope="col">ผู้ส่งคำร้อง</th>
                        <th scope="col">ดูรายละเอียด</th>
                        <th scope="col">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row1 = $result4->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $count_n; ?></td>
                            <td><?php echo $row1['timestamp'] ?></td>
                            <td><?php echo $row1['bn_toppic']; ?></td>
                            <td><?php echo $row1['username']; ?></td>
                            <td><button name="view" type="button" class="modal_data1 btn btn-outline-primary" id="<?php echo $row1['req_an_id']; ?>">ดูรายละเอียด</button></td>
                            <td>
                            <?php echo $row1['req_status']; ?>
                            </td>
                        </tr>
                    <?php $count_n++;
                    endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php require '../backend/modal-applicant.php' ?>
</body>

<script>
    //detail req popup
    $(document).ready(function() {
        $('.modal_data1').click(function() {
            var anid = $(this).attr("id");
            $.ajax({
                url: "../backend/manage-annouce.php",
                method: "POST",
                data: {
                    anid: anid
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