<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketRental - รีเซ็ตรหัสผ่าน</title>
    <link rel="stylesheet" href="../css/password.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap');
    </style>
</head>
<?php
require "./reset-password.php";
include "./backend/1-import-link.php";
?>

<body style="margin: 0px !important;background-color: #0032b5;">

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
    <center>
        <div class="reset m-4 p-5">
            <img class="img-resetpws" src="../asset/contact/logo-with-bg.png">
            <div id="resetpsw">
                <h1>รีเซ็ตรหัสผ่าน</h1>
                <div class="form-message" id="msg"></div>
                <div class="reset-psw px-5">
                    <form method="POST">
                        <div class="mb-3">
                            <input class="input inputcolor form-control" type="email" name="email" id="email" value="<?php echo $email; ?>">
                        </div>
                        <div class="mb-3">
                            <input class="input inputcolor form-control" type="password" name="password" id="password" required placeholder="สร้างรหัสผ่านใหม่">
                        </div>
                        <div class="mb-3">
                            <input class="input inputcolor form-control" type="password" name="cfpassword" id="cfpassword" required placeholder="ยืนยันรหัสผ่านใหม่อีกครั้ง">
                        </div>
                        <input class="input submit btn btn-primary w-100" type="submit" name="submit-resetpsw" value="รีเซตรหัสผ่าน">
                    </form>
                    <hr>
                    <div class="center reset-btn mt-2 pb-3"><a href="http://localhost/SeniorProject51/index.php#" class="link"> ย้อนกลับไปเข้าสู่ระบบ</a> </div>
                </div>
            </div>
        </div>
    </center>

    <script src="./backend/script.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            ("#resetpsw").on('submit', function(c) {

                c.preventDefault();
                var email = $("#email").val();
                var password = $("#password").val();
                var cfpassword = $("#cfpassword").val();

                $.ajax({

                    type: "POST",
                    url: "reset_password.php",
                    data: {
                        email: email,
                        password: password,
                        cfpassword: cfpassword
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