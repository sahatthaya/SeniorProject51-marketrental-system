<? session_start(); ?>

<?php
// signUp
if (isset($_POST['reg-btn'])) {
    $username_reg = $_POST['username-reg'];
    $psw = $_POST['password'];
    $cf_psw = $_POST['confirm_password'];
    $password_reg = md5($_POST['password']);
    $firstName = $_POST['firstName-reg'];
    $lastName = $_POST['lastName-reg'];
    $email = strtoupper($_POST['email-reg']);
    $tel = $_POST['tel-reg'];
    $type = $_POST['type'];

    if ($psw == $cf_psw) {
        if (isset($_POST["email-reg"]) != "" && isset($_POST["tel-reg"]) != "" && isset($_POST["username-reg"]) != "" && isset($_POST["password"]) != "" && isset($_POST["firstName-reg"]) != "" && isset($_POST["lastName-reg"]) != "") {
            $sqlCheck = "SELECT username FROM users WHERE username='$username_reg' OR email = '$email'";
            $rsCheck = mysqli_query($conn, $sqlCheck);
            $rowCheck = mysqli_num_rows($rsCheck);
            if ($rowCheck > 0) {
                echo "<script>username_doubly();</script>";
            } else {
                $sqlInsert = "INSERT INTO users (username, password, email, tel ,type,firstName,lastName) VALUES ('$username_reg', '$password_reg',  '$email', '$tel','$type','$firstName','$lastName')";
                if (mysqli_query($conn, $sqlInsert)) {
                    echo "<script>signUPsuccess();</script>";
                } else {
                    echo "<script>error();</script>";
                }
            }
        } else {
            echo "<script>errorpsw();</script>";
        }
    }else{

    }
}
?>