<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - จัดการตลาด</title>

    <link rel="stylesheet" href="../css/banner.css" type="text/css">

</head>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
require "../backend/manage-applicant.php";
?>

<body>
    <div class="content">
        <h1 id="headline">ประวัติคำร้องเพิ่มตลาดทั้งหมด</h1>
        <div id="labelbn" class="col-12 toptb">
            <div id="labelbn" class="col-8">
            </div>
            <!-- Button modal -->
            <div id="addbn" class="col-4">
                <a id="addbn" type="button" class="btn btn-primary" href="./partner.php">
                    <i class='bx bxs-store-alt'></i> จัดการคำร้องเพิ่มตลาด
                </a>
            </div>
        </div>
        <div>
            <div id="table" class="bannertb border p-3 shadow-sm rounded">
                <table id="myTable" class="display " style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">วันที่ส่งคำร้อง</th>
                            <th scope="col">เวลาที่ส่งคำร้อง</th>
                            <th scope="col">ชื่อผู้ใช้</th>
                            <th scope="col">ชื่อ-นามสกุล</th>
                            <th scope="col">ชื่อตลาด</th>
                            <th scope="col">รายละเอียด</th>
                            <th scope="col">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result2->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $count_n; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($row['timestamp'])) ?></td>
                                <td><?php echo date("h:i a", strtotime($row['timestamp'])) ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                                <td><?php echo $row['market_name']; ?></td>
                                <td><button name="view" type="button" class="modal_data1 btn btn-outline-primary  " id="<?php echo $row['req_partner_id']; ?>">ดูรายละเอียด</button>
                                <td>
                                    <div style="background-color: <?php echo $row['color']; ?>;" class="p-1 rounded text-center"><?php echo $row['req_status']; ?></div>
                                </td>
                            </tr>
                        <?php $count_n++;
                        endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require '../backend/modal-applicant.php' ?>
</body>
<script>
    // apply detail popup
    $(document).ready(function() {
        $('.modal_data1').click(function() {
            var mkrdid = $(this).attr("id");
            $.ajax({
                url: "../backend/modal-applicant.php",
                method: "POST",
                data: {
                    mkrdid: mkrdid
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