<?php
// corusel query
$query = "SELECT * FROM banner ORDER BY bn_id DESC";
$result = mysqli_query($conn, $query);

// mkr query
$querymkr = "SELECT market_detail.*,
users.username ,
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
ORDER BY mkr_id DESC LIMIT 4";
$resultmkr = mysqli_query($conn, $querymkr);
mysqli_close($conn);
