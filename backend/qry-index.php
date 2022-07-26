<?php
// corusel query
$query = "SELECT * FROM banner ORDER BY bn_id DESC";
$result = mysqli_query($conn, $query);

// mkr query
$querymkr = "SELECT market_detail.*,province.province_name , market_type.market_type FROM market_detail 
JOIN province ON (market_detail.province_id = province.province_id)
JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)
ORDER BY mkr_id DESC LIMIT 4";
$resultmkr = mysqli_query($conn, $querymkr);
mysqli_close($conn);

?>