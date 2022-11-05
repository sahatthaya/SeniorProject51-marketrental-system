<?php
$mkr_id = $_GET['mkr_id'];
$sql = "SELECT market_detail.*,users.username ,
    provinces.province_name,
    amphures.amphure_name,
    districts.district_name , 
    market_type.market_type
    FROM market_detail 
        JOIN users ON (market_detail.users_id = users.users_id)
        JOIN provinces ON (market_detail.province_id = provinces.id)
        JOIN amphures ON (market_detail.	amphure_id = amphures.id)
        JOIN districts ON (market_detail.district_id = districts.id)
        JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)
         WHERE (a_id='1' AND mkr_id = '$mkr_id') ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
extract($row);
$count_n = 1;
$date = date('Y-m-d');
$open = $row['opening'];
if ($open == 'เปิดทำการทุกวัน') {
    $query = mysqli_query($conn, "SELECT * FROM `booking_range`JOIN `stall` ON (booking_range.stall_id = stall.sKey) WHERE `stall`.market_id = $mkr_id and `start` <= '$date'  ORDER BY `start` ASC");
} else {
    $query = mysqli_query($conn, "SELECT * FROM `booking_period`JOIN `stall` ON (booking_period.stall_id = stall.sKey)JOIN `opening_period` ON (booking_period.op_id = opening_period.id) WHERE `stall`.market_id = $mkr_id and `start` <= '$date' ORDER BY `start` ASC");
}
