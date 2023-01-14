
<?php

include("./backend/1-connectDB.php");

if (isset($_POST['submit-resetpsw']) ) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $cfpassword = $_POST['cfpassword'];

    if (empty($password) || empty($cfpassword)) {

        echo "Empty Fields";
    } else {
        if ($password == $cfpassword) {
            $hashed = md5($password);
            $query = "UPDATE users SET password = '$hashed' WHERE email = '$email' ";
            $res = mysqli_query($conn, $query);

            $query_dlt = "DELETE FROM forgot_password WHERE email = '$email' ";
            $res_dlt = mysqli_query($conn, $query_dlt);

            echo "Password is updated successfully! Click <a href='http://localhost/SeniorProject51/' > here </a> to login again. ";
        } else {
            echo "Passwords do not match";
        }
    }
}
?>