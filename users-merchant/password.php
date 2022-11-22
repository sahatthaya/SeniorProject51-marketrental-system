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

        <div class="row border shadow-sm pt-5 pb-3 px-4 mt-3 mb-3 rounded">
            <div class="col-12">
                <label for="inputAddress " class="form-label des_input">รหัสผ่านปัจุบัน</label>
                <input class="input inputcolor form-control" type="password" id="password" name="password" placeholder="รหัสผ่าน" pattern=".{8,}" required>
            </div>
            <div class="col-12">
                <label for="inputEmail4" class="form-label des_input">รหัสผ่านใหม่</label>
                <input class="input inputcolor form-control" type="password" id="password" name="password" placeholder="รหัสผ่าน" pattern=".{8,}" required>
                <span class="note">**กรุณาตั้งรหัสผ่านอย่างน้อย 8 ตัวอักษร</span>
            </div>
            <div class="col-12">
                <label for="inputPassword4" class="form-label des_input">ยืนยันรหัสผ่าน</label>
                <input class="input inputcolor form-control" type="password" id="confirm_password" name="confirm_password" placeholder="ยืนยันรหัสผ่าน" required>
            </div>
            <div class="col-12">
            <input class="input submit btn btn-primary" type="submit" name="submit-edtpsw" onclick="validatePassword()" value="บันทึกการแก้ไข">
            </div>
        </div>
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