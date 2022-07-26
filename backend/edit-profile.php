<?php
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if (isset($_POST['submit-edt'])) {
    $firstName = $_POST['firstName-reg'];
    $lastName = $_POST['lastName-reg'];
    $email = $_POST['email-reg'];
    $tel = $_POST['tel-reg'];


    if (isset($_POST["email-reg"]) != "" && isset($_POST["tel-reg"]) != "" && isset($_POST["firstName-reg"]) != "" && isset($_POST["lastName-reg"]) != "") {
        $sqlInsert = "UPDATE users SET email='$email',tel='$tel',firstName='$firstName',lastName='$lastName' WHERE (username = '$username') ";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script type='text/javascript'> success(); </script>";
        } else {
            echo "<script type='text/javascript'> error(); </script>";
        }
    } else {
        echo "<script type='text/javascript'> error(); </script>";
    }
} 
mysqli_close($conn);

?>