<?php

// qry market info

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



//qry news

$data2 = "SELECT * FROM news WHERE mkr_id = '$mkr_id'";

$result3 = mysqli_query($conn, $data2);



// qrycalendar

$qrycalendar = mysqli_query($conn, "SELECT * FROM `opening_period` WHERE mkr_id = $mkr_id ");



$qryperiod = mysqli_query($conn, "SELECT * FROM `opening_period` WHERE (mkr_id = $mkr_id) ORDER BY `start` ASC");

if ($row['opening'] == "เปิดทำการเป็นรอบ") {

    $opening_period = '    <div class="mrk_news border rounded shadow-sm mb-4 mt-3">

    <div class="d-flex justify-content-between ">

        <h4 class="mt-2 mb-0">ปฏิทินรอบการเปิดทำการของตลาด <span class="text-secondary fs-6">(วันที่มีแถบสีคือวันที่มีรอบการเปิดทำการ)</span></h4>

    </div>

    <div class="w-100">

        <div class="mbsc-form-group">

            <div id="demo-colored"></div>

        </div>

    </div>

</div>';

    $pathbook = "booking-period.php";

} else {

    $opening_period = '';

    $pathbook = "booking.php";

}



mysqli_close($conn);

