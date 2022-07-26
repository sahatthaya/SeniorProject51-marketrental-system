<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/password.css" type="text/css">
    <title>เปลี่ยนรหัสผ่าน</title>
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
include "profilebar.php";
include "nav.php";
include "../backend/connectDB.php";
include "../backend/import-link.php";
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if (isset($_POST['submit-edtpsw'])) {
    $password_reg = md5($_POST['password']);
    if (isset($_POST["password"]) != "") {
        $sqlInsert = "UPDATE users SET password='$password_reg'  WHERE (username = '$username') ";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script type='text/javascript'> success(); </script>";
        } else {
            echo "<script type='text/javascript'> error(); </script>";
        }
    }
}
?>

<body>
    <h1 id="headline">เปลี่ยนรหัสผ่าน</h1>
    <form method="POST" id="edtpsw">
        <div class="des_input">รหัสผ่านปัจุบัน</div>
        <input class="input inputcolor" type="password" id="password" name="password" placeholder="รหัสผ่าน" pattern=".{8,}" require>
        <div class="des_input">รหัสผ่านใหม่</div>
        <input class="input inputcolor" type="password" id="password" name="password" placeholder="รหัสผ่าน" pattern=".{8,}" require>
        <span class="note">**กรุณาตั้งรหัสผ่านอย่างน้อย 8 ตัวอักษร</span>
        <br>
        <div class="des_input">ยืนยันรหัสผ่าน</div>
        <input class="input inputcolor" type="password" id="confirm_password" name="confirm_password" placeholder="ยืนยันรหัสผ่าน" require>
        <input class="input submit" type="submit" name="submit-edtpsw" onclick="validatePassword()" value="บันทึกการแก้ไข">
    </form>

</body>
<script>
    // // เชครหัสตรงกัน
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirm_password");

    function validatePassword() {
        if (password.value == confirm_password.value) {
            return true;
        } else {
            alert("กรุณากรอกรหัสผ่านให้ตรงกัน");
            return false;
        }
    }
</script>

</html>