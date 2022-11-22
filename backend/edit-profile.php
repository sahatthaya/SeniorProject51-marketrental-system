<?php
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
extract($row);

if (isset($_POST['submit-edt'])) {
    $firstName = $_POST['firstName-reg'];
    $lastName = $_POST['lastName-reg'];
    $email = $_POST['email-reg'];
    $tel = $_POST['tel-reg'];


    if (isset($_POST["email-reg"]) != "" && isset($_POST["tel-reg"]) != "" && isset($_POST["firstName-reg"]) != "" && isset($_POST["lastName-reg"]) != "") {
        $sqlInsert = "UPDATE users SET email='$email',tel='$tel',firstName='$firstName',lastName='$lastName' WHERE (username = '$username') ";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1";/>';
        } else {
            echo "<script type='text/javascript'> error(); </script>";
        }
    } else {
        echo "<script type='text/javascript'> error(); </script>";
    }
}

if (isset($_POST['submit-edtpsw'])) {
    $oldpassword = md5($_POST['oldpassword']);
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    if ($oldpassword == $row['password']) {
        $sqlInsert = "UPDATE users SET password='$password'  WHERE (username = '$username') ";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1";/>';
        } else {
            echo "<script type='text/javascript'> error(); </script>";
        }
    } else {
        echo "<script>";
        echo "
        Swal.fire({
            title: 'กรุณากรอกรหัสผ่านเดิมให้ถูกต้อง',
            icon: 'error',
            showConfirmButton: false,
            timer: 1000
          })";
        echo "</script>";
        echo '<meta http-equiv="refresh" content="1";/>';
    }
}
mysqli_close($conn);
