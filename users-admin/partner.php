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

if (isset($_GET['fk_id'])) {
    $an_id = $_GET['fk_id'];
}else{
    $an_id = '';
}

?>



<body>

    <div class="content">

        <h1 class="head_contact">จัดการคำร้องเพิ่มตลาด</h1>

        <div>

            <div id="table" class="bannertb border p-3 shadow-sm rounded">
                <div class="d-flex justify-content-between">
                    <h4>
                        คำร้องเพิ่มตลาดทั้งหมด
                    </h4>
                    <a type="button" class="btn btn-primary" href="./partner-history.php">

                        <i class='bx bx-history'></i> ดูประวัติคำร้องเพิ่มตลาดทั้งหมด

                    </a>
                </div>
                <hr>
                <table id="myTable" class="display table table-striped dt-responsive" style="width:100%">

                    <thead>

                        <tr>

                            <th scope="col">ลำดับ</th>

                            <th scope="col">วันที่ส่งคำร้อง</th>

                            <th scope="col">เวลาที่ส่งคำร้อง</th>

                            <th scope="col">ชื่อผู้ใช้</th>

                            <th scope="col">ชื่อ-นามสกุล</th>

                            <th scope="col">ชื่อตลาด</th>

                            <th scope="col">รายละเอียด</th>

                            <th scope="col">จัดการ</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($row = $result->fetch_assoc()) :
                            if ($an_id == $row['req_partner_id']) {
                               $bg = 'bg-info bg-opacity-10';
                            }else{
                                $bg = '';
                            }
                            ?>

                            <tr class="<?php echo $bg ?>">

                                <td class="<?php echo $bg ?>"><?php echo $count_n; ?></td>

                                <td><?php echo date("d/m/Y", strtotime($row['timestamp'])) ?></td>

                                <td><?php echo date("h:i a", strtotime($row['timestamp'])) ?></td>

                                <td><?php echo $row['username']; ?></td>

                                <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>

                                <td><?php echo $row['market_name']; ?></td>

                                <td><button name="view" type="button" class="modal_data1 btn btn-outline-primary  " id="<?php echo $row['req_partner_id']; ?>">ดูรายละเอียด</button>

                                </td>

                                <td>

                                    <div class=" parent" style="justify-content: center;">

                                        <a href="../backend/manage-applicant.php?approve=<?php echo $row['req_partner_id']; ?>" onclick="return confirm('คุณต้องการอนุมัติคำร้องนี้หรือไม่')" class=" btn btn-outline-success mw-100 text-center">อนุมัติ</a>

                                        <a href="../backend/manage-applicant.php?denied=<?php echo $row['req_partner_id']; ?>" onclick="return confirm('คุณต้องการปฏิเสธคำร้องนี้หรือไม่')" class=" btn btn-outline-danger mw-100 text-center">ปฏิเสธ</a>

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

        $("body").on("click", ".modal_data1", function(event) {

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