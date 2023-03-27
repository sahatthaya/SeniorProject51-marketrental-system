<?php



use PHPMailer\PHPMailer\PHPMailer;



include("./backend/1-connectDB.php");

require_once("./backend/1-import-link.php");



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

            $mail->Username = "marketrentalpj@gmail.com"; // enter your email address
            $mail->Password = "cgibacnujbfwtgyz"; // enter your password

            $mail->Port = 465;

            $mail->SMTPSecure = "ssl";



            //Email Settings

            $mail->isHTML(true);

            $mail->setFrom($email);

            $mail->addAddress($email); // Send to mail

            $mail->Subject = "Forgot password";




            $Body = '<!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta content="width=device-width, initial-scale=1" name="viewport">
                <meta name="x-apple-disable-message-reformatting">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta content="telephone=no" name="format-detection">
                <title>New message</title>
                <link href="https://fonts.googleapis.com/css2?family=Imprima&display=swap" rel="stylesheet">
                <style type="text/css">
                    #outlook a {
                        padding: 0;
                    }

                    .es-button {
                        mso-style-priority: 100 !important;
                        text-decoration: none !important;
                    }

                    a[x-apple-data-detectors] {
                        color: inherit !important;
                        text-decoration: none !important;
                        font-size: inherit !important;
                        font-family: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                    }

                    .es-desk-hidden {
                        display: none;
                        float: left;
                        overflow: hidden;
                        width: 0;
                        max-height: 0;
                        line-height: 0;
                        mso-hide: all;
                    }

                    [data-ogsb] .es-button {
                        border-width: 0 !important;
                        padding: 15px 20px 15px 20px !important;
                    }

                    @media only screen and (max-width:600px) {

                        p,
                        ul li,
                        ol li,
                        a {
                            line-height: 150% !important
                        }

                        h1,
                        h2,
                        h3,
                        h1 a,
                        h2 a,
                        h3 a {
                            line-height: 120%
                        }

                        h1 {
                            font-size: 30px !important;
                            text-align: left
                        }

                        h2 {
                            font-size: 24px !important;
                            text-align: left
                        }

                        h3 {
                            font-size: 20px !important;
                            text-align: left
                        }

                        .es-header-body h1 a,
                        .es-content-body h1 a,
                        .es-footer-body h1 a {
                            font-size: 30px !important;
                            text-align: left
                        }

                        .es-header-body h2 a,
                        .es-content-body h2 a,
                        .es-footer-body h2 a {
                            font-size: 24px !important;
                            text-align: left
                        }

                        .es-header-body h3 a,
                        .es-content-body h3 a,
                        .es-footer-body h3 a {
                            font-size: 20px !important;
                            text-align: left
                        }

                        .es-menu td a {
                            font-size: 14px !important
                        }

                        .es-header-body p,
                        .es-header-body ul li,
                        .es-header-body ol li,
                        .es-header-body a {
                            font-size: 14px !important
                        }

                        .es-content-body p,
                        .es-content-body ul li,
                        .es-content-body ol li,
                        .es-content-body a {
                            font-size: 14px !important
                        }

                        .es-footer-body p,
                        .es-footer-body ul li,
                        .es-footer-body ol li,
                        .es-footer-body a {
                            font-size: 14px !important
                        }

                        .es-infoblock p,
                        .es-infoblock ul li,
                        .es-infoblock ol li,
                        .es-infoblock a {
                            font-size: 12px !important
                        }

                        *[class="gmail-fix"] {
                            display: none !important
                        }

                        .es-m-txt-c,
                        .es-m-txt-c h1,
                        .es-m-txt-c h2,
                        .es-m-txt-c h3 {
                            text-align: center !important
                        }

                        .es-m-txt-r,
                        .es-m-txt-r h1,
                        .es-m-txt-r h2,
                        .es-m-txt-r h3 {
                            text-align: right !important
                        }

                        .es-m-txt-l,
                        .es-m-txt-l h1,
                        .es-m-txt-l h2,
                        .es-m-txt-l h3 {
                            text-align: left !important
                        }

                        .es-m-txt-r img,
                        .es-m-txt-c img,
                        .es-m-txt-l img {
                            display: inline !important
                        }

                        .es-button-border {
                            display: block !important
                        }

                        a.es-button,
                        button.es-button {
                            font-size: 18px !important;
                            display: block !important;
                            border-right-width: 0px !important;
                            border-left-width: 0px !important;
                            border-top-width: 15px !important;
                            border-bottom-width: 15px !important
                        }

                        .es-adaptive table,
                        .es-left,
                        .es-right {
                            width: 100% !important
                        }

                        .es-content table,
                        .es-header table,
                        .es-footer table,
                        .es-content,
                        .es-footer,
                        .es-header {
                            width: 100% !important;
                            max-width: 600px !important
                        }

                        .es-adapt-td {
                            display: block !important;
                            width: 100% !important
                        }

                        .adapt-img {
                            width: 100% !important;
                            height: auto !important
                        }

                        .es-m-p0 {
                            padding: 0px !important
                        }

                        .es-m-p0r {
                            padding-right: 0px !important
                        }

                        .es-m-p0l {
                            padding-left: 0px !important
                        }

                        .es-m-p0t {
                            padding-top: 0px !important
                        }

                        .es-m-p0b {
                            padding-bottom: 0 !important
                        }

                        .es-m-p20b {
                            padding-bottom: 20px !important
                        }

                        .es-mobile-hidden,
                        .es-hidden {
                            display: none !important
                        }

                        tr.es-desk-hidden,
                        td.es-desk-hidden,
                        table.es-desk-hidden {
                            width: auto !important;
                            overflow: visible !important;
                            float: none !important;
                            max-height: inherit !important;
                            line-height: inherit !important
                        }

                        tr.es-desk-hidden {
                            display: table-row !important
                        }

                        table.es-desk-hidden {
                            display: table !important
                        }

                        td.es-desk-menu-hidden {
                            display: table-cell !important
                        }

                        .es-menu td {
                            width: 1% !important
                        }

                        table.es-table-not-adapt,
                        .esd-block-html table {
                            width: auto !important
                        }

                        table.es-social {
                            display: inline-block !important
                        }

                        table.es-social td {
                            display: inline-block !important
                        }

                        .es-desk-hidden {
                            display: table-row !important;
                            width: auto !important;
                            overflow: visible !important;
                            max-height: inherit !important
                        }
                    }
                </style>
            </head>

            <body style="width:100%;font-family:arial, " helvetica neue", helvetica,
                sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
                <div class="es-wrapper-color" style="background-color:#FFFFFF">
                    <!--[if gte mso 9]><v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t"> <v:fill type="tile" color="#ffffff"></v:fill> </v:background><![endif]-->
                    <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0"
                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#FFFFFF">
                        <tr>
                            <td valign="top" style="padding:0;Margin:0">
                                <table cellpadding="0" cellspacing="0" class="es-content" align="center"
                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                    <tr>
                                        <td align="center" style="padding:0;Margin:0">
                                            <table bgcolor="#efefef" class="es-content-body" align="center" cellpadding="0"
                                                cellspacing="0"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#EFEFEF;border-radius:20px 20px 0 0;width:600px">
                                                <tr>
                                                    <td align="left"
                                                        style="padding:0;Margin:0;padding-top:40px;padding-left:40px;padding-right:40px">
                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="center" valign="top"
                                                                    style="padding:0;Margin:0;width:520px">
                                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                                        bgcolor="#0108d8"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#0108d8;border-radius:10px"
                                                                        role="presentation">
                                                                        <tr>
                                                                            <td align="center"
                                                                                style="padding:0;Margin:0;font-size:0px"><img
                                                                                    class="adapt-img"
                                                                                    src="https://deatqx.stripocdn.email/content/guids/CABINET_4f9f825f691192b54504023ea72b9328421c3f11d60a1b1fe9a99fbfd7b757c8/images/20230204387070459_NPq.png"
                                                                                    alt
                                                                                    style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic"
                                                                                    width="255"></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="left"
                                                        style="padding:0;Margin:0;padding-top:20px;padding-left:40px;padding-right:40px">
                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="center" valign="top"
                                                                    style="padding:0;Margin:0;width:520px">
                                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                                        bgcolor="#fafafa"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#fafafa;border-radius:10px"
                                                                        role="presentation">
                                                                        <tr>
                                                                            <td align="left" style="padding:20px;Margin:0">
                                                                                <h3
                                                                                    style="Margin:0;line-height:34px;mso-line-height-rule:exactly;font-family:Imprima, Arial, sans-serif;font-size:28px;font-style:normal;font-weight:bold;color:#2D3142">
                                                                                    รีเซ็ตรหัสผ่าน</h3>
                                                                                <p
                                                                                    style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Imprima, Arial, sans-serif;line-height:27px;color:#2D3142;font-size:18px">
                                                                                    &nbsp;
                                                                                    เราได้รับคำขอให้รีเซ็ตรหัสผ่าน&nbsp;หากคุณไม่ได้ขอรหัสผ่านใหม่
                                                                                    ไม่ต้องสนใจอีเมลฉบับนี้และจะไม่มีอะไรเกิดขึ้น<br><br>&nbsp;
                                                                                    &nbsp;หากคุณต้องการเปลี่ยนรหัสผ่านใหม่
                                                                                    คุณสามารถกดที่ปุ่มรีเซ็ตรหัสผ่าน
                                                                                    เพื่อทำการเปลี่ยนรหัสผ่านใหม<br></p>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table cellpadding="0" cellspacing="0" class="es-content" align="center"
                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
                                    <tr>
                                        <td align="center" style="padding:0;Margin:0">
                                            <table bgcolor="#efefef" class="es-content-body" align="center" cellpadding="0"
                                                cellspacing="0"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#EFEFEF;border-radius:0 0 20px 20px;width:600px">
                                                <tr>
                                                    <td class="esdev-adapt-off" align="left"
                                                        style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:40px;padding-right:40px">
                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="center" valign="top"
                                                                    style="padding:0;Margin:0;width:520px">
                                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                                        role="presentation"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr>
                                                                            <td align="center" style="padding:0;Margin:0">
                                                                                <span class="msohide es-button-border"
                                                                                    style="border-style:solid;border-color:#2CB543;background:#7630f3;border-width:0px;display:block;border-radius:30px;width:auto;mso-hide:all"><a
                                                                                    href="marketrental.online/reset.php?token=' . $token . '" class="es-button msohide"
                                                                                        target="_blank"
                                                                                        style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#FFFFFF;font-size:22px;border-style:solid;border-color:#7630f3;border-width:15px 20px 15px 20px;display:block;background:#7630f3;border-radius:30px;font-family:Imprima, Arial, sans-serif;font-weight:bold;font-style:normal;line-height:26px;width:auto;text-align:center;mso-hide:all;border-left-width:5px;border-right-width:5px">รีเซ็ตรหัสผ่าน</a>
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table cellpadding="0" cellspacing="0" class="es-footer" align="center"
                                    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                                    <tr>
                                        <td align="center" style="padding:0;Margin:0">
                                            <table bgcolor="#bcb8b1" class="es-footer-body" align="center" cellpadding="0"
                                                cellspacing="0"
                                                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;width:600px">
                                                <tr>
                                                    <td align="left"
                                                        style="Margin:0;padding-left:20px;padding-right:20px;padding-bottom:30px;padding-top:40px">
                                                        <table cellpadding="0" cellspacing="0" width="100%"
                                                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                            <tr>
                                                                <td align="left" style="padding:0;Margin:0;width:560px">
                                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                                        role="presentation"
                                                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                                                                        <tr>
                                                                            <td align="center" style="padding:0;Margin:0">
                                                                                <p
                                                                                    style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:Imprima, Arial, sans-serif;line-height:21px;color:#2D3142;font-size:14px">
                                                                                    ด้วยความเคารพ ,
                                                                                   <a href="www.marketrental.online"> marketrental.online</a></p>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </body>

            </html>';


            $mail->Body = $Body;


            if ($mail->send()) {
                echo "<script>send_email()</script>";
            } else {
            }
        } else {
            echo "<script>send_email_error()</script>";
        }
    }
}
