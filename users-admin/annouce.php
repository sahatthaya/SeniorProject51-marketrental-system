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

require "../backend/manage-annouce.php";

if (isset($_GET['fk_id'])) {
    $an_id = $_GET['fk_id'];
} else {
    $an_id = '';
}
?>



<body>

    <div class="content">

        <h1 class="head_contact">จัดการคำร้องขอประชาสัมพันธ์</h1>

        <div id="table2" class="bannertb mt-3 border p-3 shadow-sm rounded">
            <div class="d-flex justify-content-between">
                <h4>
                    คำร้องขอประชาสัมพันธ์ทั้งหมด
                </h4>
                <a id="addbn" type="button" class="btn btn-primary" href="./annouce-history.php">

                    <i class='bx bx-history'></i> ดูประวัติคำร้องประชาสัมพันธ์ทั้งหมด

                </a>
            </div>
            <hr>
            <table id="myTable" class="display table table-striped dt-responsive " style="width: 100%;">

                <thead>

                    <tr>

                        <th scope="col">ลำดับ</th>

                        <th scope="col">วันที่ส่งคำร้อง</th>

                        <th scope="col">เวลาที่ส่งคำร้อง</th>

                        <th scope="col">หัวข้อ</th>

                        <th scope="col">ผู้ส่งคำร้อง</th>

                        <th scope="col">ดูรายละเอียด</th>

                        <th scope="col">จัดการ</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while ($row1 = $result3->fetch_assoc()) :
                        if ($an_id == $row1['req_an_id']) {
                            $bg = 'bg-info bg-opacity-10';
                        } else {
                            $bg = '';
                        }
                    ?>

                        <tr class="<?php echo $bg ?>">

                            <td class="<?php echo $bg ?>"><?php echo $count_n; ?></td>

                            <td><?php echo date("d/m/Y", strtotime($row1['timestamp'])) ?></td>

                            <td><?php echo date("h:i a", strtotime($row1['timestamp'])) ?></td>

                            <td><?php echo $row1['bn_toppic']; ?></td>

                            <td><?php echo $row1['username']; ?></td>

                            <td><button name="view" type="button" class="modal_data1 btn btn-outline-primary" id="<?php echo $row1['req_an_id']; ?>">ดูรายละเอียด</button></td>

                            <td>

                                <div class="parent" style="justify-content: center;">

                                    <a href="../backend/manage-annouce.php?approve=<?php echo $row1['req_an_id']; ?>" onclick="return confirm('คุณต้องการอนุมัติคำร้องนี้หรือไม่')" class=" btn btn-outline-success mw-100 text-center">อนุมัติ</a>

                                    <a href="../backend/manage-annouce.php?denied=<?php echo $row1['req_an_id']; ?>" onclick="return confirm('คุณต้องการปฏิเสธคำร้องนี้หรือไม่')" class=" btn btn-outline-danger mw-100 text-center">ปฏิเสธ</a>

                                </div>

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

        $("body").on("click", ".modal_data1", function(event) {

            var anid = $(this).attr("id");

            $.ajax({

                url: "../backend/modal-applicant.php",

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