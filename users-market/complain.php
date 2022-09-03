<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/banner.css">
    <link rel="stylesheet" href="../css/complain.css">

</head>
<script type="text/javascript">
    function success() {
        Swal.fire({
            title: 'ส่งข้อมูลสำเร็จ',
            icon: 'success',
            showConfirmButton: false,
            timer: 2500
        })
    }

    function error() {
        Swal.fire({
            title: 'ผิดพลาด',
            text: 'เกิดข้อผิดพลาดกรุณาลองอีกครั้ง',
            icon: 'error',
            showConfirmButton: false,
            timer: 2500
        })
    }
</script>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
require "../backend/manage-complain.php";
if (isset($_GET['mkr_id'])) {
    $mkr_id = $_GET['mkr_id'];
    $sql = "SELECT * FROM market_detail WHERE (mkr_id = '$mkr_id') ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    extract($row);


    $query_toppic = "SELECT * FROM toppic";
    $result_toppic = mysqli_query($conn, $query_toppic);

    //qry
    $count_n = 1;
    $data = "SELECT complain.*, toppic.toppic,users.username FROM complain 
JOIN toppic ON (complain.toppic_id = toppic.toppic_id)
JOIN users ON (complain.users_id = users.users_id)
 WHERE (mkr_id = '$mkr_id') ";
    $result = mysqli_query($conn, $data);
}
?>

<body>
    <div>
        <h1 id="headline">จัดการคำร้องเรียน <?php echo $row['mkr_name'] ?></h1>
        <div id="content">
            <div id="table" class="bannertb border p-3 shadow-sm rounded mt-3">
                <table id="myTable" class="display " style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">วันที่ร้องเรียน</th>
                            <th scope="col">ประเภทการร้องเรียน</th>
                            <th scope="col">หัวข้อการร้องเรียน</th>
                            <th scope="col">ผู้ร้องเรียน</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $count_n; ?></td>
                                <td><?php echo $row['timestamp'] ?></td>
                                <td><?php echo $row['toppic'] ?></td>
                                <td><?php echo $row['comp_subject'] ?></td>
                                <td><?php echo $row['username'] ?></td>
                                <td><?php echo $row['status'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary modal_data1" id="<?php echo $row['comp_id']; ?>">
                                        ตอบกลับ
                                    </button>
                                </td>
                            </tr>
                        <?php $count_n++;
                        endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>

</body>
<?php require '../backend/modal-complain.php' ?>
<script src="../backend/script.js"></script>
<script>
    // apply detail popup
    $(document).ready(function() {
        $('.modal_data1').click(function() {
            var id = $(this).attr("id");
            $.ajax({
                url: "../backend/manage-complain.php",
                method: "POST",
                data: {
                    id: id
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