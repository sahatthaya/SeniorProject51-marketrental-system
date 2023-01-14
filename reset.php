<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset password</title>
</head>
<?php 
require "./reset-password.php"
?>
<body>

    <?php
    include("./backend/1-connectDB.php");
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        $query = "SELECT * FROM forgot_password WHERE token = '$token' ";
        $r = mysqli_query($conn, $query);

        if (mysqli_num_rows($r) > 0) {

            $row = mysqli_fetch_array($r);
            $email = $row['email'];
        }
    }

    ?>
    <!-- รีเซตรหัสผ่าน -->
    <div id="resetpsw">
        <i class='bx bxs-user-circle authicon'></i>
        <h1>รีเซ็ตรหัสผ่าน</h1>
        <div class="form-message" id="msg">
            <form method="POST">
                <div class="des_input">อีเมล</div>
                <input class="input inputcolor" type="email" name="email" id="email" value=" <?php echo $email;  ?>">
                <br>

                <div class="des_input">สร้างรหัสผ่านใหม่</div>
                <input class="input inputcolor" type="password" name="password" id="password" required>
                <br>

                <div class="des_input">ยืนยันรหัสผ่านใหม่อีกครั้ง</div>
                <input class="input inputcolor" type="password" name="confirmpassword" id="confirmpassword" required>
                <br>
                <input class="input submit" type="submit" name="submit-resetpsw" value="รีเซตรหัสผ่าน">
            </form>
            <div class="center"><a href="#" onclick="showsignIn()" class="link"> ย้อนกลับไปเข้าสู่ระบบ</a> </div>
        </div>

        <script src="backend/script.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $("#resetpsw").on('submit', function(e) {

                    e.preventDefault();
                    var email = $("#email").val();
                    var password = $("#password").val();
                    var confirmpassword = $("#confirmpassword").val();
                    // alert(email + password + confirmpassword);

                    $.ajax({

                        method: "POST",
                        url: "reset-password.php",
                        data: {
                            email: email,
                            password: password,
                            confirmpassword: confirmpassword
                        },
                        success: function(data) {
                            $(".form-message").css("display", "block");
                            $(".form-message").html(data);
                            $("#resetpsw")[0].reset();
                        }
                    });
                });

            });
        </script>

</html>