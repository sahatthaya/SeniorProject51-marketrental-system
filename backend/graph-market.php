<?php


$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row1 = mysqli_fetch_array($result);
extract($row1);
$users_id = $row1['users_id'];

$data = "SELECT * FROM  market_detail WHERE (a_id='1' AND users_id = '$users_id') ";
$result = mysqli_query($conn, $data);
