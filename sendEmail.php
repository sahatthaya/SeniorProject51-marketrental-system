<?php

use PHPMailer\PHPMailer\PHPMailer;

include("./backend/1-connectDB.php");

if (isset($_POST['email'])) {

    $email = $_POST['email'];

    $query = "SELECT * FROM users WHERE email = '$email' ";
    $r = mysqli_query($conn, $query);

    if (empty($email)) {

        echo "Field is empty";
    } else {

        if (mysqli_num_rows($r) > 0) {

            $token = uniqid(md5(time()));

            $insert_query = "INSERT INTO forgot_password(email, token) VALUES('$email','$token')  ";
            $res = mysqli_query($conn, $insert_query);

            $to = $email;
            $subject = "Password Reset Link";
            $msg = 'Click <a href="http://localhost/SeniorProject51/reset_password.php?token=' . $token . ' "onclick="showresetpsw()" class="link" >here</a>  to reset your password';

            $message = "Email: " . $email . "\n\n" . " " . $msg;

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $headers .= "From: " . $email;
            // } else {

            require_once "PHPMailer/PHPMailer.php";
            require_once "PHPMailer/SMTP.php";
            require_once "PHPMailer/Exception.php";

            $mail = new PHPMailer();

            // SMTP Settings
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "sunisa.pampam@gmail.com"; // enter your email address
            $mail->Password = "ukafrmijmluowpns"; // enter your password
            $mail->Port = 465;
            $mail->SMTPSecure = "ssl";

            //Email Settings
            $mail->isHTML(true);
            $mail->setFrom($email);
            $mail->addAddress($email); // Send to mail
            $mail->Subject = "Forgot password";
        

            $mail->Body = 'A request for forgot password has been made. If you have not made this request, please ignore this email. 
            If you have made this request, please click on the link below to reset your password. <br> 
            <a href="http://localhost/SeniorProject51/reset.php/?token=' . $token . '"  > Reset Password </a>';

            if ($mail->send()) {
                // $status = "success";
                // $response = "Email is sent";

                echo "<script>";
                echo "
                title: 'Send Email success',
                icon: 'success',
                showConfirmButton: false,
                timer: 5000
                })";
                echo "</script>";
            } else {
                $status = "failed";
                $response = "Something is wrong" . $mail->ErrorInfo;
            }
        }
        exit(json_encode(array("status" => $status, "response" => $response)));
    }
}
