<?php
include "profilebar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/password.css" type="text/css">
    <title>แก้ไขข้อมูลบัญชีผู้ใช้</title>
</head>
<script type="text/javascript">
    function success() {
        Swal.fire({
            title: 'แก้ไขข้อมูลสำเร็จ',
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
include "nav.php";
include "../backend/connectDB.php";
include "../backend/import-link.php";
$username = $_SESSION['username'];
require "../backend/edit-profile.php";
?>

<body>
    <h1 id="headline">แก้ไขโปรไฟล์</h1>
    <form id="signin" method="POST">
        <div class="des_input">ชื่อบัญชีผู้ใช้</div>
        <input class="input inputcolor" placeholder="ชื่อบัญชีผู้ใช้" type="text" name="username-reg" value="<?php echo $row['username'] ?>" disabled>
        <br>
        <div class="des_input">ชื่อ-นามสกุล</div>
        <div class="hstack gap-5">
            <input class="input inputcolor" placeholder="ชื่อ" style="width: 48%;" type="text" name="firstName-reg" value="<?php echo $row['firstName'] ?>">
            <input class="input inputcolor" placeholder="ชื่อนามสกุล" style="width: 48%;" type="text" name="lastName-reg" value="<?php echo $row['lastName'] ?>">
        </div>
        <div class="des_input">อีเมล</div>
        <input class="input inputcolor" type="email" name="email-reg" placeholder="อีเมล" value="<?php echo $row['email'] ?>">
        <br>
        <div class="des_input">เบอร์โทรศัพท์</div>
        <input class="input inputcolor" type="tel" name="tel-reg" placeholder="เบอร์โทรศัพท์" pattern="[0-9]{10}" title="กรุณากรอกเบอร์โทรศัพท์ หมายเลข (0-9) จำนวน 10 ตัว" value="<?php echo $row['tel'] ?>">
        <br>
        <input class="input submit" type="submit" name="submit-edt" value="บันทึกการแก้ไข">
    </form>
</body>

</html>