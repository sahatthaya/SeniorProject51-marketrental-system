<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/password.css" type="text/css">
    <title> MarketRental - เปลี่ยนรหัสผ่าน</title>

</head>

<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
include "../backend/edit-profile.php";
?>

<body>
    <h1 id="headline">เปลี่ยนรหัสผ่าน</h1>
    <form method="POST" id="edtpsw">
        <div class="row border shadow-sm pt-5 pb-3 px-5 mt-3 mb-3 rounded" id="StepTwo">
            <div class="des_input">รหัสผ่านปัจุบัน</div>
            <input class="input inputcolor form-control" type="password" id="oldpassword" name="oldpassword" placeholder="รหัสผ่าน" pattern=".{8,}" required>
            <div class="des_input">รหัสผ่านใหม่ <span class="text-danger fs-6 fw-lighter">(กรุณาตั้งรหัสผ่านอย่างน้อย 8 ตัวอักษร)</span></div>
            <input class="input inputcolor form-control" type="password" id="password" name="password" placeholder="รหัสผ่าน" pattern=".{8,}" onchange="validatePassword()" required>
            <br>
            <div class="des_input">ยืนยันรหัสผ่าน</div>
            <input class="input inputcolor form-control" type="password" id="confirm_password" name="confirm_password" placeholder="ยืนยันรหัสผ่าน" onchange="validatePassword()" required>
            <div id="chkpsw" class="text-end p-0"><span class="text-danger fs-6 fw-lighter">กรุณากรอกรหัสผ่านให้ตรงกัน</span></div>
            <button class="input submit btn btn-primary mt-3" id="myBtn" type="submit" name="submit-edtpsw" disabled>บันทึกการแก้ไข</button>
        </div>
    </form>

</body>
<script>
    function validatePassword() {
        var password = document.getElementById("password"),
            confirm_password = document.getElementById("confirm_password");
        if (password.value == confirm_password.value) {
            document.getElementById("chkpsw").innerHTML = "";
            document.getElementById("myBtn").disabled = false;
            document.getElementById("chkpsw").innerHTML = "";
            document.getElementById("chkpsw").innerHTML = '<span class="text-success text-end fs-6 fw-lighter"><i class="bx bx-check-double"></i>รหัสผ่านตรงกัน</span>';
            return true;
        } else {
            document.getElementById("chkpsw").innerHTML = "";
            document.getElementById("chkpsw").innerHTML = '<span class="text-danger text-end fs-6 fw-lighter">กรุณากรอกรหัสผ่านให้ตรงกัน</span>';
            document.getElementById("myBtn").disabled = true;
            return false;
        }
    }
</script>

</html>