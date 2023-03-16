<?php
include "../backend/1-connectDB.php";
if (isset($_POST["userid"])) {

    $users_id = $_POST["userid"];

    $data = "UPDATE `notification` SET `status`='2' WHERE `users_id` = $users_id";

    $resultdata = mysqli_query($conn, $data);
}
?>