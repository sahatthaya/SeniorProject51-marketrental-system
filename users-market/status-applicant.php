<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - ติดตามสถานะคำร้องขอเพิ่มตลาด</title>

    <link rel="stylesheet" href="../css/banner.css" type="text/css">

</head>

<?php

include "profilebar.php";

?>

<?php

include "nav.php";

include "../backend/1-connectDB.php";



// req status

$count_n = 1;

$userid = $_SESSION['users_id'];

$data = "SELECT req_partner.*, 

 users.username ,

    provinces.province_name,

    amphures.amphure_name,

    districts.district_name , 

    market_type.market_type,

    req_status.*

FROM req_partner 

    JOIN users ON (req_partner.users_id = users.users_id)

    JOIN provinces ON (req_partner.province_id = provinces.id)

    JOIN amphures ON (req_partner.	amphure_id = amphures.id)

    JOIN districts ON (req_partner.district_id = districts.id)

    JOIN market_type ON (req_partner.market_type_id = market_type.market_type_id)

    JOIN req_status ON (req_partner.req_status_id = req_status.req_status_id)

    WHERE (req_partner.users_id = '$userid') ORDER BY `timestamp` DESC";

$result = mysqli_query($conn, $data);

if (isset($_GET['fk_id'])) {
    $an_id = $_GET['fk_id'];
} else {
    $an_id = '';
}
?>



<body>

    <div class="content">

        <h1 id="headline">คำร้องขอเพิ่มตลาด</h1>

        <div>

            <div id="table" class="bannertb border p-3 shadow-sm rounded mt-3">
                <div class="d-flex justify-content-between">
                    <h3>ประวัติคำร้องขอเพิ่มตลาด</h3>
                    <a class="btn btn-primary" href="./applicant.php"> ส่งคำร้องขอเพิ่มตลาดใหม่</a>
                </div>
                <hr>
                <table id="myTable" class="display table table-striped dt-responsive" style="width: 100%;">

                    <thead>

                        <tr>

                            <th scope="col">ลำดับ</th>

                            <th scope="col">วันที่ส่งคำร้อง</th>

                            <th scope="col">เวลาที่ส่งคำร้อง</th>

                            <th scope="col">ชื่อ-นามสกุล</th>

                            <th scope="col">ชื่อตลาด</th>

                            <th scope="col">รายละเอียด</th>

                            <th scope="col">สถานะ</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($row = $result->fetch_assoc()) :
                            if ($an_id == $row['req_partner_id']) {
                                $bg = 'bg-info bg-opacity-10';
                            } else {
                                $bg = '';
                            }
                        ?>

                            <tr class="<?php echo $bg ?>">

                                <td class="<?php echo $bg ?>"><?php echo $count_n; ?></td>

                                <td><?php echo date("d/m/Y", strtotime($row['timestamp'])) ?></td>

                                <td><?php echo date("h:i a", strtotime($row['timestamp'])) ?></td>

                                <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>

                                <td><?php echo $row['market_name']; ?></td>

                                <td><button name="view" type="button" class="modal_data1 btn btn-outline-primary " id="<?php echo $row['req_partner_id']; ?>">ดูรายละเอียด</button>

                                </td>

                                <td>

                                    <div style="color: <?php echo $row['color']; ?>;" class="p-1 text-center"><?php echo $row['req_status']; ?></div>

                                </td>

                            </tr>

                        <?php $count_n++;

                        endwhile ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

<script src="../backend/script.js"></script>

<?php require '../backend/modal-applicant.php' ?>

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