 
<?php 


include("./backend/1-connectDB.php");
if(isset($_POST['email'])){

    $email = $_POST['email'];

    $query = "SELECT * FROM users WHERE email = '$email' ";
    $r = mysqli_query($conn,$query);

    if(empty($email)){

        echo "Field is empty";
    }else{

        if(mysqli_num_rows($r) > 0){

            $token = uniqid(md5(time()));

            $insert_query = "INSERT INTO forgot_password(email, token) VALUES('$email','$token')  ";
            $res = mysqli_query($conn,$insert_query);

            $to = $email;
            $subject = "Password Reset Link";
            $msg = 'Click <a href="http://localhost/SeniorProject51/reset_password.php?token='.$token.' "onclick="showresetpsw()" class="link" >here</a>  to reset your password';

            $message = "Email: ". $email . "\n\n"." ". $msg;

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $headers .= "From: ".$email;

            if(mail($to,$subject,$message,$headers)){
                echo "Password link is sent to your email";
            }

            
            // echo "Click <a href='#?=token=$token'  onclick='showresetpsw()' class='link'>here</a>  to reset your password";
        }else{
            echo "User not Found";
        }
    }

}


?>

