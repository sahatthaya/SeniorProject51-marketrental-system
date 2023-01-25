
<?php

include("./backend/1-connectDB.php");
include ("./backend/1-import-link.php");

if (isset($_POST['submit-resetpsw'])) {

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

            echo "<script>";
            echo "
        Swal.fire({
            icon: 'success',
            title: 'รีเซ็ตรหัสผ่านเรียบร้อย',
            showConfirmButton: false,
            timer:3000
          })";
            echo "</script>";

        } else {
            echo "<script>";
            echo "
        Swal.fire({
            icon: 'error',
            title: 'Passwords do not match',
            showConfirmButton: false,
            timer:3000
          })";
            echo "</script>";

           
        }
    }
}
?>