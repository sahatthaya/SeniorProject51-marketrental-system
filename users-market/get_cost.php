<?php
include "../backend/1-connectDB.php";

$sql = "SELECT * FROM `stall` WHERE `market_id`={$_GET['cu_id']}";
$query = mysqli_query($conn, $sql);

$json = array();
while($result = mysqli_fetch_assoc($query)) {    
    array_push($json, $result);
}
echo json_encode($json);