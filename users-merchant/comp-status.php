
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - ติดตามสถานะคำร้องเรียน</title>
    <link rel="shortcut icon" type="image/x-icon" href="../asset/contact/logo.png" />
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
$data = "SELECT complain.*, toppic.toppic FROM complain 
JOIN toppic ON (complain.toppic_id = toppic.toppic_id)
 WHERE (users_id = '$userid') ";
$result = mysqli_query($conn, $data);
?>

<body>
    <div class="content">
        <h1 id="headline">ติดตามสถานะคำร้องเรียน</h1>
        <div>
            <div id="table" class="bannertb border p-3 shadow-sm rounded mt-3">
                <table id="myTable" class="display " style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">วันที่ร้องเรียน</th>
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
                                <td><?php echo $row['timestamp'] ?></td>
                                <td><?php echo $row['toppic'] ?></td>
                                <td><?php echo $row['comp_subject'] ?></td>
                                <td><?php echo $row['status'] ?></td >
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
        $('.modal_data1').click(function() {
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