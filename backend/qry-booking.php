<?php
if ($_GET) {
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
}
$count_n = 1;
$result3 = mysqli_query($conn, "SELECT stall.*, zone.* FROM stall JOIN zone ON (stall.z_id = zone.z_id) WHERE (market_id = '$mkr_id' AND `show` = '1')");
$maxrentqry = mysqli_query($conn, "SELECT MAX(`sRent`) AS max FROM `stall` WHERE (market_id = '$mkr_id' AND `show` = '1')");
$maxrent =  mysqli_fetch_array($maxrentqry);
extract($maxrent);

$maxofrange = $maxrent['max'];
@$max = $maxofrange + 100;
$val = $max;
if (isset($_POST['save-range'])) {
    $val = $_POST['rangeinput'];
}
$range = $val;
$count_zone = 1;
$zone = mysqli_query($conn, "SELECT * FROM `zone`");