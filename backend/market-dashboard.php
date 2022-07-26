<?php
$dataPoints = array(
    array("y" => 25, "label" => "จันทร์"),
    array("y" => 15, "label" => "อังคาร"),
    array("y" => 25, "label" => "พุธ"),
    array("y" => 5, "label" => "พฤหัสบดี"),
    array("y" => 10, "label" => "ศุกร์"),
    array("y" => 0, "label" => "เสาร์"),
    array("y" => 20, "label" => "อาทิตย์")
);

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
