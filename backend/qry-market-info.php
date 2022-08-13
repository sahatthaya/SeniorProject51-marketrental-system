<?php
if ($_GET) {
    $mkr_id = $_GET['mkr_id'];
    $sql = "SELECT market_detail.*,province.province_name , market_type.market_type FROM market_detail 
  JOIN province ON (market_detail.province_id = province.province_id)
  JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id) WHERE (mkr_id = '$mkr_id') ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    extract($row);
}
//qry
$data2 = "SELECT * FROM news WHERE mkr_id = '$mkr_id'";
$result3 = mysqli_query($conn, $data2);
mysqli_close($conn);
?>