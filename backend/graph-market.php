<?php


$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row1 = mysqli_fetch_array($result);
extract($row1);
$users_id = $row1['users_id'];

$data = "SELECT market_detail.*,province.province_name , market_type.market_type FROM market_detail 
JOIN province ON (market_detail.province_id = province.province_id)
JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id) WHERE (users_id = '$users_id') ";
$result = mysqli_query($conn, $data);
$num = mysqli_num_rows($result);
