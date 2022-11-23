<?php
$perpage = 12;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start = ($page - 1) * $perpage;

$query_province = "SELECT * FROM provinces";
$result_province = mysqli_query($conn, $query_province);
$query_mkrType = "SELECT * FROM market_type ORDER BY market_type_id";
$result_mkrType = mysqli_query($conn, $query_mkrType);

// mkr query
$data = "SELECT market_detail.*,users.username ,
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
WHERE (a_id='1') ORDER BY mkr_id DESC limit {$start} , {$perpage} ";
$result = mysqli_query($conn, $data);

// if (isset($_POST["searchsubmit"])) {
//     $searchkey = $_POST['search'];
//     $data = "SELECT market_detail.*,users.username ,
//     provinces.province_name,
//     amphures.amphure_name,
//     districts.district_name , 
//     market_type.market_type
//     FROM market_detail 
//         JOIN users ON (market_detail.users_id = users.users_id)
//         JOIN provinces ON (market_detail.province_id = provinces.id)
//         JOIN amphures ON (market_detail.	amphure_id = amphures.id)
//         JOIN districts ON (market_detail.district_id = districts.id)
//         JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)
//     WHERE (a_id='1' AND mkr_name LIKE '%" . $searchkey . "%' or mkr_name LIKE '%" . $searchkey . "%' or province_name LIKE '%" . $searchkey . "%' or market_type LIKE '%" . $searchkey . "%')";
//     $result = mysqli_query($conn, $data);
// }
// if (isset($_POST["reset"])) {
//     $data = "SELECT market_detail.*,users.username ,
//     provinces.province_name,
//     amphures.amphure_name,
//     districts.district_name , 
//     market_type.market_type
//     FROM market_detail 
//         JOIN users ON (market_detail.users_id = users.users_id)
//         JOIN provinces ON (market_detail.province_id = provinces.id)
//         JOIN amphures ON (market_detail.	amphure_id = amphures.id)
//         JOIN districts ON (market_detail.district_id = districts.id)
//         JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)
//     WHERE (a_id='1') ORDER BY mkr_id DESC limit {$start} , {$perpage} ";
//     $result = mysqli_query($conn, $data);
// }
// top mkr query
$topquerymkr = "SELECT market_detail.*,users.username ,
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
    WHERE (a_id='1')
ORDER BY mkr_id DESC LIMIT 4 ";
$topresultmkr = mysqli_query($conn, $topquerymkr);
