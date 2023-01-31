<?php
ob_start();
session_start();
include "backend/1-connectDB.php";
include "backend/1-import-link.php";
require "backend/auth-auth.php";
require "backend/auth-signup.php";
$sqllg = "SELECT * FROM contact ";
$resultlg = mysqli_query($conn, $sqllg);
$lg = mysqli_fetch_array($resultlg);
extract($lg);

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $query = "SELECT * FROM forgot_password WHERE token = '$token' ";
    $r = mysqli_query($conn, $query);
    if (mysqli_num_rows($r) > 0) {
        $row = mysqli_fetch_array($r);
        $email = $row['email'];
    }
} else {
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> MarketRental - user-profile</title>
    <link rel="stylesheet" href="./css/profilebar.css" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="./<?php echo $lg['ct_logo'] ?>" />
</head>

<body>

    <div class="profileicon prevent-select" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
        <p>เข้าสู่ระบบ/สมัครสมาชิก</p>
        <i id="profileicon" class='bx bxs-user-circle bx-md'></i>
    </div>

    <div class="profilebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight">
        <button type="button" id="close-profile-btn" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>

        <!-- เข้าสู่ระบบ -->
        <div id="signIn">
            <h1>เข้าสู่ระบบ</h1>
            <form method="POST" class="was-validated">
                <div class="mb-1">ชื่อบัญชีผู้ใช้</div>
                <input class="form-control mb-2" type="text" name="username-login" placeholder="ชื่อบัญชีผู้ใช้" pattern="^[a-zA-Z0-9]+$" title="กรุณากรอกชื่อผู้ใช้ให้ถูกต้อง" required>
                <div class="mb-1">รหัสผ่าน</div>
                <input class="form-control mb-1" type="password" name="password-login" placeholder="รหัสผ่าน" pattern=".{8,}" title="กรุณากรอกรหัสผ่านให้ถูกต้อง" required>
                <div class="text-end">
                    <a href="#" onclick="showforgotpsw()" class="btn btn-link p-0">ลืมรหัสผ่าน?</a>
                </div>
                <button class="btn btn-primary w-100 mt-2" type="submit" name="login-btn">เข้าสู่ระบบ</button>
            </form>
            <hr class="mx-5 mb-0">
            <div class="center">ยังไม่ได้เป็นสมาชิก?<button href="#" onclick="showsignup()" class="btn btn-link">สมัครสมาชิก</button> </div>
        </div>

        <!-- ลืมรหัสผ่าน -->
        <div id="forgotpsw">
            <h1>ลืมรหัสผ่าน</h1>
            <div class="form-message" id="msg"></div>
            <form method="POST" class="was-validated">
                <div class="mb-1">อีเมล</div>
                <input class="form-control mb-2" type="email" name="email" id="email" pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$"  title="กรุณากรอกอีเมลให้ถูกต้อง" required>
                <button class="btn btn-primary w-100 mt-2" onclick="sendEmail(),send_email()" type="submit" name="login-btn">ส่งรหัสผ่านไปยังอีเมล</button>
            </form>
            <hr class="mx-5 mb-0">
            <div class="center"><button href="#" onclick="showsignIn()" class="btn btn-link">ย้อนกลับไปเข้าสู่ระบบ</button> </div>
        </div>

        <!-- สมัครสมาชิก -->
        <div id="signUp">
            <h1>สมัครสมาชิก</h1>
            <form method="POST">
                <div class="mb-2">
                    <div class="mb-1">ประเภทผู้ใช้</div>
                    <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1" value="1" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                        พ่อค้า/แม่ค้า
                    </label>
                    <input class="form-check-input" type="radio" name="type" id="flexRadioDefault2" value="2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        เจ้าของตลาด
                    </label>
                </div>
                <div class="was-validated">
                    <div class="des_input mb-1">ชื่อบัญชีผู้ใช้</div>
                    <input class="form-control mb-2" placeholder="ชื่อบัญชีผู้ใช้" type="text" name="username-reg" pattern="^[a-zA-Z0-9]+$"  title="กรุณากรอกชื่อผู้ใช้เป็นภาษาอังกฤษ หรือ ตัวเลข 0-9" required>
                    <div class="mb-1">ชื่อ-นามสกุล <span class="text-secondary">(ภาษาไทย)</span></div>
                    <div class="hstack gap-2 mb-2">
                        <input class="form-control" pattern="^[ก-๏\s]+$" placeholder="ชื่อ" style="width: 48%;" type="text" name="firstName-reg"  title="กรุณากรอกชื่อเป็นภาษาไทย" required>
                        <input class="form-control" pattern="^[ก-๏\s]+$" placeholder="ชื่อนามสกุล" style="width: 48%;" type="text" name="lastName-reg" title="กรุณากรอกนามสกุลเป็นภาษาไทย" required>
                    </div>
                    <div class="mb-1">อีเมล</div>
                    <input class="form-control mb-2" type="email" name="email-reg" placeholder="อีเมล" required>
                    <div class="mb-1">เบอร์โทรศัพท์</div>
                    <input class="form-control mb-2" id="tel" type="tel" name="tel-reg" placeholder="เบอร์โทรศัพท์" pattern="[0-9]{10}" title="กรุณากรอกเบอร์โทรศัพท์ หมายเลข (0-9) จำนวน 10 ตัว" required>
                    <div class="mb-1">รหัสผ่าน</div>
                    <input class="form-control mb-2" type="password" id="password" name="password" placeholder="รหัสผ่าน" pattern=".{8,}" title="กรุณากรอกรหัสผ่านให้ถูกต้อง" required>
                    <span class="note">**กรุณาตั้งรหัสผ่านอย่างน้อย 8 ตัวอักษร</span>
                    <div class="mb-1">ยืนยันรหัสผ่าน</div>
                    <input class="form-control mb-2" type="password" id="confirm_password" name="confirm_password" placeholder="ยืนยันรหัสผ่าน" pattern=".{8,}" title="กรุณากรอกรหัสผ่านให้ถูกต้อง" required>
                    <button class="btn btn-primary w-100 mt-2" type="submit" name="reg-btn">สมัครสมาชิก</button>
                </div>
            </form>
            <hr class="mx-5 mb-0">
            <div class="center">มีบัญชีอยู่แล้ว?<button href="#" onclick="showsignIn()" class="btn btn-link">เข้าสู่ระบบ</button> </div>
        </div>
    </div>
</body>





<script src="backend/script.js" type="text/javascript"></script>

<script>

    // no spaces
    $(function() {
        $(":input").on({
            keydown: function(e) {
                if (e.which === 32 && e.target.selectionStart === 0) {
                    return false;
                }
            }
        });
    })

    // tel input mask
    $(":input").inputmask();
    $("#tel").inputmask({
        "mask": "9999999999"
    });

    // sendEmail
    function sendEmail() {
        var email = $("#email");
        if (isNotEmpty(email)) {
            $.ajax({
                url: 'sendEmail.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    email: email.val()
                },
                success: function(response) {
                    $('#resetpsw')[0].reset();
                    $('.msg').text("Message send successfully");
                }
            });
        }
    }



    function isNotEmpty(caller) {
        if (caller.val() == "") {
            caller.css('border', '1px solid red');
            return false;
        } else caller.css('border', '');
        return true;
    }



    $(document).ready(function() {
        $("#resetpsw").on('submit', function(c) {
            c.preventDefault();
            var email = $("#email").val();
            var password = $("#password").val();
            var confirmpassword = $("#confirmpassword").val();
            $.ajax({
                type: "POST",
                url: "reset-password.php",
                data: {
                    email: email,
                    password: password,
                    confirmpassword: confirmpassword
                },
                success: function(date) {
                    $(".form-message").css("display", "block");
                    $(".form-message").html(date);
                }

            });

        });



    });
</script>



</html>