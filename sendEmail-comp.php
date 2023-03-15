<?php
    use PHPMailer\PHPMailer\PHPMailer;

    if(isset($_POST['compToppic']) && isset($_POST['email'])) {
        $compToppic = $_POST['compToppic'];
        $compSubject = $_POST['compSubject'];
        $compDetail = $_POST['compDetail'];
        $compUpload = $_POST['compUpload'];
        $email = $_POST['email'];


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
        $mail->setFrom($email, $compToppic);
        $mail->addAddress($email); // Send to mail
        $mail->Subject = $compDetail;
        $mail->Body = $compUpload;

        if($mail->send()) {
            $status = "success";
            $response = "Email is sent";
        } else {
            $status = "failed";
            $response = "Something is wrong" . $mail->ErrorInfo;
        }

        exit(json_encode(array("status" => $status, "response" => $response)));
    }
?>