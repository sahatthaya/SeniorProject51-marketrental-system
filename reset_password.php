<?php 

include("./backend/1-connectDB.php");

if(isset($_POST['email']) || ($_POST['passwordforgot']) || ($_POST['cfpasswordforgot']) ){

    $email = $_POST['email'];
    $passwordforgot = $_POST['passwordforgot'];
    $cfpasswordforgot = $_POST['cfpasswordforgot'];

    if(empty($passwordforgot) || empty($cfpasswordforgot)){

        echo "Empty Fields";
    }else{      
        if($passwordforgot == $cfpasswordforgot){
            $hashed = md5($passwordforgot);
            $query = "UPDATE users SET password = '$hashed' WHERE email = '$email' ";
            $res = mysqli_query($conn,$query);

            $query_dlt = "DELETE FROM forgot_password WHERE email = '$email' ";
            $res_dlt = mysqli_query($conn,$query_dlt);
            
            echo "Password is updated successfully! Click <a href='#'  onclick='signIn()' class='link'>here</a> to login again. ";
        }else{
            echo "Passwords do not match";
        }
    }
}
