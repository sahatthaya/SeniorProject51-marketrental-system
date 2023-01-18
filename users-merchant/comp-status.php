<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - ติดตามสถานะคำร้องเรียน</title>
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
   
</head>
<?php
include "profilebar.php";
?>
<?php
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";

// req status
$count_n = 1;
$userid = $_SESSION['users_id'];
$count_n = 1;
$data = "SELECT complain.*, toppic.toppic , comp_status.* FROM complain 
JOIN toppic ON (complain.toppic_id = toppic.toppic_id)
JOIN comp_status ON (complain.status = comp_status.cs_id)
 WHERE (users_id = '$userid') ";
$result = mysqli_query($conn, $data);
?>

<body>
    <div class="content">
        <h1 id="headline">ติดตามสถานะคำร้องเรียน</h1>
        <div>
            <div id="table" class="bannertb border p-3 shadow-sm rounded mt-3">
                <table id="myTable" class="display table table-striped dt-responsive" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">วันที่ร้องเรียน</th>
                            <th scope="col">เวลาที่ร้องเรียน</th>
                            <th scope="col">ประเภทการร้องเรียน</th>
                            <th scope="col">หัวข้อการร้องเรียน</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">ดูรายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $count_n; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($row['timestamp'])) ?></td>
                                <td><?php echo date("h:i a", strtotime($row['timestamp'])) ?></td>
                                <td><?php echo $row['toppic'] ?></td>
                                <td><?php echo $row['comp_subject'] ?></td>
                                <td>
                                    <div style="background-color: <?php echo $row['cs_color']; ?>;" class="p-1 rounded text-center"><?php echo $row['cs_name']; ?></div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary modal_data1" id="<?php echo $row['comp_id']; ?>">
                                        ดูรายละเอียด
                                    </button>
                                </td>
                            </tr>
                        <?php $count_n++;
                        endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="../backend/script.js"></script>
<?php require '../backend/modal-seecomplain.php' ?>

<script>
    // apply detail popup
    $(document).ready(function() {
        $("body").on("click", ".modal_data1", function(event) {
            var seeid = $(this).attr("id");
            $.ajax({
                url: "../backend/manage-complain.php",
                method: "POST",
                data: {
                    seeid: seeid
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