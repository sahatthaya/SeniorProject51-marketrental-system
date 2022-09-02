<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการตลาด</title>
    <link rel="stylesheet" href="../css/banner.css" type="text/css">

</head>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
require "../backend/manage-applicant.php";
?>

<body>
    <div class="content">
        <h1 id="headline">จัดการคำร้องเพิ่มตลาด</h1>
        <div id="labelbn" class="col-12 toptb">
            <div id="labelbn" class="col-8">
            </div>
            <!-- Button modal -->
            <div id="addbn" class="col-4">
                <a id="addbn" type="button" class="btn btn-primary" href="./partner-history.php">
                    <i class='bx bx-history'></i> ดูประวัติคำร้องเพิ่มตลาดทั้งหมด
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
                            <th scope="col">ชื่อผู้ใช้</th>
                            <th scope="col">ชื่อ-นามสกุล</th>
                            <th scope="col">ชื่อตลาด</th>
                            <th scope="col">รายละเอียด</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $count_n; ?></td>
                                <td><?php echo $row['timestamp'] ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                                <td><?php echo $row['market_name']; ?></td>
                                <td><button name="view" type="button" class="modal_data1 btn btn-outline-primary  " id="<?php echo $row['req_partner_id']; ?>">ดูรายละเอียด</button>
                                </td>
                                <td>
                                    <div class="row" style="justify-content: center;">
                                        <a href="../backend/manage-applicant.php?approve=<?php echo $row['req_partner_id']; ?>" onclick="return confirm('คุณต้องการอนุมัติคำร้องนี้หรือไม่')" class=" btn btn-outline-success col-md-4" style="margin-right: 2px;font-size:14px;">อนุมัติ</a>
                                        <a href="../backend/manage-applicant.php?denied=<?php echo $row['req_partner_id']; ?>" onclick="return confirm('คุณต้องการปฏิเสธคำร้องนี้หรือไม่')" class=" btn btn-outline-danger col-md-4" style="margin-left: 2px;font-size:14px;">ปฏิเสธ</a>
                                    </div>
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
                url: "../backend/manage-applicant.php",
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