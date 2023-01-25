<?php
if ($_GET) {
    $mkr_id = $_GET['mkr_id'];
    $s_id = $_GET['s_id'];
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
    $qrystallinfo = mysqli_query($conn,"SELECT * FROM `stall` WHERE sKey = $s_id");
    $rowstall = mysqli_fetch_array($qrystallinfo);
    extract($rowstall);
}
$curr_date = date("Y-m-d");
// ตลาดที่เป็นรอบ
$qryrentperiod= mysqli_query($conn,"SELECT * FROM opening_period WHERE mkr_id = $mkr_id AND '$curr_date' <= `start` ORDER BY `start` ASC");

// วันที่ถูกจองไปแล้ว
$qryinvalid = mysqli_query($conn,"SELECT * FROM `booking_range` WHERE `stall_id`= $s_id");

if ($row['opening'] == "เปิดทำการเป็นรอบ") {
    $display = "block";
    $opening_period = '';
    $opentype = 'period';
} else {
    $display = "none";
    $opening_period = '
    <div class="des_input ">วันที่ต้องการเช่า</div>
        <div class="w-100 mb-2 p-0">
            <div id="demo-range-selection" name="daterange"></div>
                <input id="datestart"  hidden/>
                <input id="dateend"  hidden />
        </div>';
    $opentype = 'range';
}


