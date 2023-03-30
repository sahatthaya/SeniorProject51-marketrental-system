<? session_start(); ?>

<?php

include "backend/1-connectDB.php";

// signIn

if (isset($_POST['login-btn'])) {

    $username_login = $_POST['username-login'];

    $password_login = MD5($_POST['password-login']);



    $sql = "SELECT * FROM users WHERE BINARY username='$username_login' AND password='$password_login'";

    $rs = mysqli_query($conn, $sql);

    $fRows = mysqli_fetch_row($rs);

    $numRows = mysqli_num_rows($rs);

    if ($numRows > 0) {

        $_SESSION['users_id'] = $fRows[0];

        $_SESSION['username'] = $username_login;

        $_SESSION['userstype'] = $fRows[7];

        if ($fRows[7] == 1) {

            echo "<script>window.location='./users-merchant/index.php';</script>";
        } else {

            if ($fRows[7] == 2) {

                echo "<script>window.location='./users-market/index.php';</script>";
            } else {

                echo "<script>window.location='./users-admin/banner2.php';</script>";
            }
        }
    } else {

        echo "<script>autherror();</script>";
    }
}







?>