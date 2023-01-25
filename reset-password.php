

<?php



include("./backend/1-connectDB.php");

include("./backend/1-import-link.php");



if (isset($_POST['submit-resetpsw'])) {



    $email = $_POST['email'];

    $password = $_POST['password'];

    $cfpassword = $_POST['cfpassword'];



    $hashed = md5($password);

    $query = "UPDATE users SET password = '$hashed' WHERE email = '$email' ";

    $res = mysqli_query($conn, $query);



    $query_dlt = "DELETE FROM forgot_password WHERE email = '$email' ";

    $res_dlt = mysqli_query($conn, $query_dlt);

    if($res && $res_dlt){

    echo "<script>resetpws_success()</script>";

    }else{

    }

}

?>