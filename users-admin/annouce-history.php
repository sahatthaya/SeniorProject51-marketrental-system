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

?>



<body>
    <nav aria-label="breadcrumb mb-3">

        <ol class="breadcrumb ">

            <li class="breadcrumb-item fs-5 "><a href="./annouce.php" class="text-decoration-none">จัดการคำร้องขอประชาสัมพันธ์</a></li>

            <li class="breadcrumb-item active fs-5" aria-current="page">ประวัติคำร้องประชาสัมพันธ์ทั้งหมด</li>

        </ol>

    </nav>
    <h1 class="head_contact">ประวัติคำร้องประชาสัมพันธ์ทั้งหมด</h1>

    <div id="content">

        <div id="table2" class="border p-3 shadow-sm rounded">

            <table id="myTable" class="display table table-striped dt-responsive" style="width: 100%;">

                <thead>

                    <tr>

                        <th scope="col">ลำดับ</th>

                        <th scope="col">วันที่ส่งคำร้อง</th>

                        <th scope="col">เวลาที่ส่งคำร้อง</th>

                        <th scope="col">ตลาด</th>

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

                            <td><?php echo date("d/m/Y", strtotime($row1['timestamp'])) ?></td>

                            <td><?php $time = date(
                                    'g:i a',
                                    strtotime($row1['timestamp']) + 60 * 60 * 7
                                );
                                echo date(" h:i a", strtotime($time)) ?></td>

                            <td><?php echo $row1['mkr_name']; ?></td>

                            <td><?php echo $row1['bn_toppic']; ?></td>

                            <td><?php echo $row1['username']; ?></td>

                            <td><button name="view" type="button" class="modal_data1 btn btn-outline-primary" id="<?php echo $row1['req_an_id']; ?>">ดูรายละเอียด</button></td>

                            <td>

                                <div style="color: <?php echo $row1['color']; ?>;" class="p-1 rounded text-center"><?php echo $row1['req_status']; ?></div>

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
    // detail req popup

    $(document).ready(function() {

        $("body").on("click", ".modal_data1", function(event) {

            var anid = $(this).attr('id');

            $.ajax({

                url: '../backend/modal-applicant.php',

                type: 'post',

                data: {

                    anid: anid

                },

                success: function(data) {

                    $('#bannerdetail').html(data);

                    $('#bannerdataModal').modal('show');

                }

            });

        });

    });
</script>



</html>