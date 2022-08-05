<?php
// signUp
if (isset($_POST['reg-btn'])) {
    $username_reg = $_POST['username-reg'];
    $password_reg = md5($_POST['password']);
    $firstName = $_POST['firstName-reg'];
    $lastName = $_POST['lastName-reg'];
    $email = $_POST['email-reg'];
    $tel = $_POST['tel-reg'];


    if (isset($_POST["email-reg"]) != "" && isset($_POST["tel-reg"]) != "" && isset($_POST["username-reg"]) != "" && isset($_POST["password"]) != "" && isset($_POST["firstName-reg"]) != "" && isset($_POST["lastName-reg"]) != "") {
        $sqlCheck = "SELECT username FROM users WHERE username='$username_reg'";
        $rsCheck = mysqli_query($conn, $sqlCheck);
        $rowCheck = mysqli_num_rows($rsCheck);
        if ($rowCheck > 0) {
            echo "<script>alert('ชื่อผู้ใข้ซำ กรุณาเปลี่ยนชื่อผู้ใช้');</script>";
        } else {
            $sqlInsert = "INSERT INTO users (username, password, email, tel ,type,firstName,lastName) VALUES ('$username_reg', '$password_reg',  '$email', '$tel','1','$firstName','$lastName')";
            if (mysqli_query($conn, $sqlInsert)) {
                echo "<script>alert('ลงทะเบียนสำเร็จ');</script>";
            } else {
                echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง');</script>";
            }
        }
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง');</script>";
    }
}
?>