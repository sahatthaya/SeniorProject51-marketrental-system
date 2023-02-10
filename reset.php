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

    <link rel="shortcut icon" type="image/x-icon" href="./<?php echo $lg['ct_logo'] ?>" />

</head>

<?php

require "./reset-password.php";

include "./backend/1-import-link.php";

include "backend/1-connectDB.php";

$sqllg = "SELECT * FROM contact ";

$resultlg = mysqli_query($conn, $sqllg);

$lg = mysqli_fetch_array($resultlg);

extract($lg);

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

        <div class="reset m-4 p-5 ">

            <img class="img-resetpws" src="../asset/contact/logo-with-bg.png">

            <div id="resetpsw">

                <h1>รีเซ็ตรหัสผ่าน</h1>

                <div class="form-message" id="msg"></div>

                <div class="reset-psw ">

                    <form method="POST" class="was-validated">

                        <div class="mb-3">

                            <input class="input inputcolor form-control reset-input " type="email" name="email" id="email" value="<?php echo $email; ?>" readonly>

                        </div>

                        <div class="mb-3">

                            <input class="input inputcolor form-control reset-input" type="password" name="password"  pattern=".{8,}" id="password" required placeholder="สร้างรหัสผ่านใหม่" onchange="validatePassword()">

                        </div>

                        <div class="mb-0">

                            <input class="input inputcolor form-control reset-input" type="password" name="cfpassword"  pattern=".{8,}" id="cfpassword" required placeholder="ยืนยันรหัสผ่านใหม่อีกครั้ง" onchange="validatePassword()">

                        </div>

                        <div id="chkpsw" class="text-end p-0 mb-3"><span class="text-danger fs-6 fw-lighter">กรุณากรอกรหัสผ่านให้ตรงกัน</span></div>

                        <button class="input submit btn btn-primary w-100" id="myBtn" type="submit" name="submit-resetpsw" disabled>รีเซตรหัสผ่าน</button>

                    </form>

                    <hr>

                    <div class="center reset-btn mt-2 pb-3"><a href="https://market-rental.000webhostapp.com/index.php#" class="link" disabled> กลับเข้าสู่ระบบ</a> </div>

                </div>

            </div>

        </div>

    </center>



    <script src="./backend/script.js" type="text/javascript"></script>

    <script type="text/javascript">

        function validatePassword() {

            var password = document.getElementById("password"),

                confirm_password = document.getElementById("cfpassword");

            if (password.value == confirm_password.value) {

                document.getElementById("chkpsw").innerHTML = "";

                document.getElementById("myBtn").disabled = false;

                document.getElementById("chkpsw").innerHTML = "";

                document.getElementById("chkpsw").innerHTML = '<span class="text-light text-end fs-6 fw-lighter"><i class="bx bx-check-double"></i>รหัสผ่านตรงกัน</span>';

                return true;

            } else {

                document.getElementById("chkpsw").innerHTML = "";

                document.getElementById("chkpsw").innerHTML = '<span class="text-light text-end fs-6 fw-lighter">กรุณากรอกรหัสผ่านให้ตรงกัน</span>';

                document.getElementById("myBtn").disabled = true;

                return false;

            }

        }

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