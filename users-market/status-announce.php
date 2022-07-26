<?php
include "profilebar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
    <title>ติดตามคำร้องพาร์ทเนอร์</title>
</head>

<?php
include "nav.php";
include "../backend/connectDB.php";
include "../backend/import-link.php";

// tb rqan query
$count_n = 1;
$userid = $_SESSION['users_id'];

$data2 = "SELECT req_annouce.*, users.username , req_status.req_status FROM req_annouce 
JOIN users ON (req_annouce.users_id = users.users_id) 
JOIN req_status ON (req_annouce.req_status_id = req_status.req_status_id) WHERE (req_annouce.users_id = '$userid')";
$result3 = mysqli_query($conn, $data2);
?>

<body>
    <div class="content">
        <h1 id="headline">ติดตามสถานะคำร้องขอประชาสัมพันธ์</h1>
        <div>
            <div id="table">
                <table id="myTable" class="display " style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">วันที่ส่งคำร้อง</th>
                            <th scope="col">หัวข้อ</th>
                            <th scope="col">ผู้ส่งคำร้อง</th>
                            <th scope="col">ดูรายละเอียด</th>
                            <th scope="col">สถานะ</th>
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
                                <td><?php echo $row1['req_status']; ?></td>
                            </tr>
                        <?php $count_n++;
                        endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../backend/script.js"></script>
    
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