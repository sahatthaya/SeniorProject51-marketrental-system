<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/banner.css" type="text/css">

    <title> MarketRental - ติดตามสถานะคำร้องขอประชาสัมพันธ์</title>

</head>

<?php

include "profilebar.php";

?>

<?php

include "nav.php";

include "../backend/1-connectDB.php";



// tb rqan query

$count_n = 1;

$userid = $_SESSION['users_id'];



$data2 = "SELECT * FROM req_annouce 

JOIN users ON (req_annouce.users_id = users.users_id) 

JOIN req_status ON (req_annouce.req_status_id = req_status.req_status_id)

JOIN market_detail ON (market_detail.mkr_id = req_annouce.mkr_id)

 WHERE (req_annouce.users_id = '$userid') ORDER BY `timestamp` DESC";

$result3 = mysqli_query($conn, $data2);

if (isset($_GET['fk_id'])) {
    $an_id = $_GET['fk_id'];
} else {
    $an_id = '';
}
?>



<body>
    <div class="content">

        <h1 id="headline">คำร้องขอประชาสัมพันธ์</h1>

        <div>

            <div id="table" class="bannertb border p-3 shadow-sm rounded mt-3">
                <div class="d-flex justify-content-between">
                    <h3>ประวัติคำร้องขอประชาสัมพันธ์</h3>
                    <a class="btn btn-primary" href="./announce.php"> ส่งคำร้องขอประชาสัมพันธ์</a>
                </div>
                <hr>
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

                                <td><?php $time = date(
                                        'g:i a',
                                        strtotime($row1['timestamp']) + 60 * 60 * 7
                                    );
                                    echo date("เวลา h:i a", strtotime($time)) ?></td>

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

    </div>

    <script src="../backend/script.js"></script>



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