<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/applicant.css" type="text/css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
include "../backend/connectDB.php";
include "../backend/import-link.php";
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row1 = mysqli_fetch_array($result);
extract($row1);
$users_id = $row1['users_id'];

$count_n = 1;
require "../backend/add-applicant.php";

?>

<body>
<div class="applybox">
        <h1 id="headline">กรอกข้อมูลเพื่อสร้างคำร้องขอประชาสัมพันธ์</h1>
        <form id="applyform" method="POST" enctype="multipart/form-data">
            <div class="form-outer" style="overflow: visible;">
                <!-- form--1 -->
                <div id="stepOne" class="row">
                    <div class="des_input">หัวข้อ</div>
                    <input class="form-control col-6" type="text" placeholder="หัวข้อ" name="bn_toppic" required>
                
                    <div class="des_input">รายละเอียด</div>
                    <textarea name="bn_detail" placeholder="รายละเอียด" id="" cols="30" rows="5" style="border-radius: 15px;resize: none;" required></textarea>
            
                    <div class="des_input">รูปภาพ</div>
                    <input class="sqr-input col-12 form-control" type="file" aria-label="แนบรูปภาพ" name="bn_img" required>
                    <input type="submit" class="btn btn-primary" id="add-data" name="bn-submit" value="ยืนยันคำร้อง">
                </div>
            </div>
        </form>
    </div>
</body>

</html>