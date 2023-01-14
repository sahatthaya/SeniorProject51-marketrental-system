
<?php

include("./backend/1-connectDB.php");



if (isset($_POST['submit-resetpsw'])) {

    $email = md5 ($_POST['email']);
    $password = md5($_POST['password']);
    $confirmpassword = md5($_POST['confirmpassword']);

    if (empty($password) || empty($confirmpassword)) {

        echo "Empty Fields";
    } else {

        if ($password == $confirmpassword) {
            $hashed = md5($password);
            $query = "UPDATE users SET password = '$hashed' WHERE (email = '$email' )";
            $res = mysqli_query($conn, $query);

            $query_dlt = "DELETE FROM forgot_password WHERE email = '$email' ";
            $res_dlt = mysqli_query($conn, $query_dlt);

            echo "Password is updated successfully! Click <a href='#'  onclick='signIn()' class='link'>here</a> to login again. ";
        } else {
            echo "Passwords do not match";
        }
    }
}

?>