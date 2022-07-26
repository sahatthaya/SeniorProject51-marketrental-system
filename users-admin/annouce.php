<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คำร้องประชาสัมพันธ์</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/connectDB.php";
include "../backend/import-link.php";
require "../backend/manageannouce.php";
?>

<body>
    <h1 class="head_contact">จัดการคำร้องขอประชาสัมพันธ์</h1>
    <div id="content">
        <div id="table2">
            <table id="myTable" class="display " style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">วันที่ส่งคำร้อง</th>
                        <th scope="col">หัวข้อ</th>
                        <th scope="col">ผู้ส่งคำร้อง</th>
                        <th scope="col">ดูรายละเอียด</th>
                        <th scope="col">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row1 = $result3->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $count_n; ?></td>
                            <td><?php echo $row1['timestamp'] ?></td>
                            <td><?php echo $row1['bn_toppic']; ?></td>
                            <td><?php echo $row1['username']; ?></td>
                            <td><button name="view" type="button" class="modal_data1 btn btn-outline-primary" id="<?php echo $row1['req_an_id']; ?>">ดูรายละเอียด</button></td>
                            <td>
                                <div class="row" style="justify-content: center;">
                                    <a href="../backend/manageannouce.php?approve=<?php echo $row1['req_an_id']; ?>" onclick="return confirm('คุณต้องการอนุมัติคำร้องนี้หรือไม่')" class=" btn btn-outline-success col-md-4" id="" style="margin-right: 2px; font-size:14px;">อนุมัติ</a>
                                    <a href="../backend/manageannouce.php?denied=<?php echo $row1['req_an_id']; ?>" onclick="return confirm('คุณต้องการลบคำร้องนี้หรือไม่')" class=" btn btn-outline-danger col-md-4" style="margin-left: 2px; font-size:14px;">ลบ</a>
                                </div>
                            </td>
                        </tr>
                    <?php $count_n++;
                    endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php require '../backend/applicant-modal.php' ?>
</body>

<script>
    //detail req popup
    $(document).ready(function() {
        $('.modal_data1').click(function() {
            var anid = $(this).attr("id");
            $.ajax({
                url: "../backend/manageannouce.php",
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