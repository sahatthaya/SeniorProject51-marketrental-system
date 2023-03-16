<?php



use PHPMailer\PHPMailer\PHPMailer;



include("./backend/1-connectDB.php");

include("./backend/1-import-link.php");


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

            $subject = "รีเซ็ตรหัสผ่านด้วยลิงก์";

            $msg = 'ไปที่ลิงก์นี้ <a href="http://localhost/SeniorProject51/reset_password.php?token=' . $token . ' "onclick="showresetpsw()" class="link" ></a>  เพื่อรีเซตรหัสผ่านของคุณ';



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

            $mail->Username = "1st.sunghoon@gmail.com"; // enter your email address
            $mail->Password = "zxhxuybfiqwxpzux"; // enter your password

            $mail->Port = 465;

            $mail->SMTPSecure = "ssl";



            //Email Settings

            $mail->isHTML(true);

            $mail->setFrom($email);

            $mail->addAddress($email); // Send to mail

            $mail->Subject = "Forgot password";





            $mail->Body = 'เราได้รับคำขอให้รีเซ็ตรหัสผ่าน บัญชี https://market-rental.000webhostapp.com/ ของคุณ

            <br>หากคุณไม่ได้ขอรหัสผ่านใหม่ ไม่ต้องสนใจอีเมลฉบับนี้และจะไม่มีอะไรเกิดขึ้น

            <br>หากคุณต้องการเปลี่ยนรหัสผ่านใหม่ คุณต้องเข้าที่ลิงก์ต่อไปนี้ <br> 

            <a href="https://market-rental.000webhostapp.com/reset.php?token=' . $token . '"> รีเซ็ตรหัสผ่าน </a>';



            if ($mail->send()) {
                //แก้อเลิ้ท

                $status = "success";

                $response = "Email is sent";

            } else {

                   //แก้อเลิ้ท
                $status = "failed";

                $response = "Something is wrong" . $mail->ErrorInfo;

            }

        }

        exit(json_encode(array("status" => $status, "response" => $response)));

    }

}

