<?php
// qry market
$mkr_id = $_GET['mkr_id'];
$count_n = 1;
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

// qry stall
$data2 = "SELECT stall.*, zone.* FROM stall JOIN zone ON (stall.z_id = zone.z_id) WHERE (market_id = '$mkr_id')";
$result3 = mysqli_query($conn, $data2);

// qry cost/unit
$costunit = "SELECT * FROM `cost/unit` WHERE mkr_id = '$mkr_id'";
$resultCU = mysqli_query($conn, $costunit);
$numCU = mysqli_num_rows($resultCU);

// qry zone
$z_qry = "SELECT * FROM `zone`";
$z = mysqli_query($conn, $z_qry);

// qry calendar
$qrycalendar = mysqli_query($conn, "SELECT * FROM `opening_period` WHERE mkr_id = $mkr_id");

$qryperiod = mysqli_query($conn, "SELECT * FROM `opening_period` WHERE (mkr_id = $mkr_id) ORDER BY `start` ASC");
if ($row['opening'] == "เปิดทำการเป็นรอบ") {
    $opening_period = '    <div class="border rounded shadow-sm mt-4 p-3">
    <div class="d-flex justify-content-between ">
        <h4 class="mt-2 mb-0">ปฏิทินรอบการเปิดทำการของตลาด</h4>
        <a href="opening_period.php?mkr_id=' . $row['mkr_id'] . '" type="button" class="btn btn-primary " style="height: fit-content;"><i class="bx bxs-edit-alt"></i> จัดการรอบการเปิดทำการ</a>
    </div>
    <div class="w-100">
        <div class="mbsc-form-group">
            <div id="demo-colored"></div>
        </div>
    </div>
</div>';
} else {
    $opening_period = '';
}


// update opning period
if (isset($_POST['sdate'])) {
    date_default_timezone_set('Asia/Bangkok'); // Set UTC timezo
    $date = $_POST['daterange'];
    $e = explode("-", $date);
    // $start =  date("Y/m/d", strtotime($e[0]));
    $date2 = strtr($e[0], '/', '-');
    $start  = date('Y-m-d', strtotime($date2));
    $date1 = strtr($e[1], '/', '-');
    $end  = date('Y-m-d', strtotime($date1));
    $addperiod = mysqli_query($conn, "INSERT INTO `opening_period`(`start`, `end`, `mkr_id`) VALUES ('$start','$end','$mkr_id')");
    if ($addperiod) {
        echo '<meta http-equiv="refresh" content="1";/>';
        echo "<script type='text/javascript'> success(); </script>";
    } else {
        echo "<script>error();</script>";
    }
}
