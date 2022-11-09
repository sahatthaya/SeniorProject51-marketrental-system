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
    $querystatusinv = mysqli_query($conn, "SELECT
    *
FROM
    inv_cost,
    invoice,
    cost,
    `cost/unit`,
    booking_period,
    stall
WHERE
    invoice.INV_id = inv_cost.INV_id AND inv_cost.c_id = cost.c_id AND cost.cu_id = `cost/unit`.`cu_id` AND invoice.b_id = booking_period.b_id AND stall.sKey = booking_period.stall_id AND `cost/unit`.mkr_id = '$mkr_id' GROUP BY invoice.INV_id");
}

if (isset($_POST['save-table'])) {
    $data_chk = serialize($_POST['chk']);
    $rev_data = unserialize($data_chk);
    $data_c = count($rev_data);
    $curr_date = date('Y-m-d');
    $INV_expired1 = strtr($_POST['INV_expired'], '/', '-');
    $INV_expired = date('Y-m-d', strtotime($INV_expired1));
    if ($open == 'เปิดทำการทุกวัน') {
        // echo 'all';
        for ($i = 0; $i < $data_c; $i++) {
            // echo $i + 1 . ' = ' . $rev_data[$i] . '<br />';
            // $rev_data[$i] 
            $query = mysqli_query($conn, "SELECT * FROM `booking_range` WHERE b_id = $rev_data[$i]");
            $row = mysqli_fetch_array($query);
            extract($row);
            $end = $row['end'];
            // คำนวนจำนวนวัน
            // $endcal  = date('Y-m-d', strtotime($end));
            $day = floor((strtotime($curr_date) - strtotime($end)) /  (60 * 60 * 24) + 1);
            echo $day;
            // if ($row['end'] >= $date) {
            //     echo '<button class="btn btn-info w-100" disabled>อยู่ในระหว่างการเช่า</button>';
            // } else {
            //     echo '<button class="btn btn-secondary w-100" disabled>การเช่าสิ้นสุดแล้ว</button>';
            // }
        }
    } else {
        for ($i = 0; $i < $data_c; $i++) {
            $query = mysqli_query($conn, "SELECT * FROM `booking_period` JOIN opening_period ON (booking_period.op_id = opening_period.id) JOIN stall ON (stall.sKey = booking_period.stall_id) WHERE b_id = $rev_data[$i]");
            $row = mysqli_fetch_array($query);
            extract($row);
            $sKey = $row['sKey'];
            $curr_mY = date('m/Y');
            $check = mysqli_query($conn, "SELECT * FROM `invoice` WHERE b_id = $rev_data[$i]");
            $numRows = mysqli_num_rows($check);
            if ($numRows > 0) {
                // เช็ค numrow ของตาราง invoice
                $checknr = mysqli_query($conn, "SELECT * FROM `invoice`");
                $numRowsinv = mysqli_num_rows($checknr);
                // set pk inv
                $INV_id = 'INV' . date('Ymd') . $numRowsinv;
                // cal rentprice (+ set value) 
                $INV_rentprice = $row['sRent'] * $row['day'];
                $INV_discount =  '0';
                $INV_days = $row['day'];
                $b_id = $rev_data[$i];
                // qry cost from stallkey + current m/y
                $querycost = mysqli_query($conn, "SELECT * FROM `cost` WHERE `sKey` = '$sKey'  AND `cost_period` = '$curr_mY' ");
                // loop insert inv_cost
                while ($costrow = $querycost->fetch_assoc()) {
                    $c_id = $costrow['c_id'];
                    $insertcost = mysqli_query($conn, "INSERT INTO `inv_cost`( `INV_id`, `c_id`)
                     VALUES( '$INV_id', '$c_id')");
                }

                // qry sumcost 
                $querycostinv = mysqli_query($conn, "SELECT SUM(`c_totalbath`) as sumcost FROM inv_cost,invoice,cost WHERE inv_cost.INV_id = invoice.INV_id and inv_cost.c_id=cost.c_id and inv_cost.INV_id = '$INV_id'");
                $rowcostinv = mysqli_fetch_array($querycostinv);
                extract($rowcostinv);
                $INV_cost = ($rowcostinv['sumcost'] = 'null') ? '0' : $rowcostinv['sumcost'];
                //  cal total price
                $INV_total = $INV_rentprice + $INV_cost - $INV_discount;

                $insertinv = mysqli_query($conn, "INSERT INTO `invoice`(`INV_id`,`INV_rentprice`,`INV_discount`,`INV_cost`,`INV_total`,`INV_days`,`INV_expired`,`b_id`,`mkr_id`)
                     VALUES('$INV_id','$INV_rentprice','$INV_discount','$INV_cost','$INV_total','$INV_days','$INV_expired','$b_id','$mkr_id')");
                echo "<script>";
                echo "
                  Swal.fire({
                      title: 'ส่งใบแจ้งค่าเช่าสำเร็จ',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 2500
                  });";
                echo "</script>";
                echo '<meta http-equiv="refresh" content="1"; />';
            } else {
                // เช็ค numrow ของตาราง invoice
                $checknr = mysqli_query($conn, "SELECT * FROM `invoice`");
                $numRowsinv = mysqli_num_rows($checknr);
                $nr = ($numRowsinv = 'null') ? '0' : $numRowsinv;
                // set pk inv
                $INV_id = 'INV' . date('Ymd') . $nr;
                // cal rentprice (+ set value) 
                $INV_rentprice = $row['sRent'] * $row['day'];
                $INV_discount =  $row['sDept'];
                $INV_days = $row['day'];
                $b_id = $rev_data[$i];
                // qry cost from stallkey + current m/y
                $querycost = mysqli_query($conn, "SELECT * FROM `cost` WHERE `sKey` = '$sKey'  AND `cost_period` = '$curr_mY' ");
                // loop insert inv_cost
                while ($costrow = $querycost->fetch_assoc()) {
                    $c_id = $costrow['c_id'];
                    $insertcost = mysqli_query($conn, "INSERT INTO `inv_cost`( `INV_id`, `c_id`)
                    VALUES( '$INV_id', '$c_id')");
                }

                // qry sumcost 
                $querycostinv = mysqli_query($conn, "SELECT SUM(`c_totalbath`) as sumcost FROM inv_cost,invoice,cost WHERE inv_cost.INV_id = invoice.INV_id and inv_cost.c_id=cost.c_id and inv_cost.INV_id = '$INV_id'");
                $rowcostinv = mysqli_fetch_array($querycostinv);
                extract($rowcostinv);
                $INV_cost = ($rowcostinv['sumcost'] = 'null') ? '0' : $rowcostinv['sumcost'];
                //  cal total price
                $INV_total = $INV_rentprice + $INV_cost - $INV_discount;

                $insertinv = mysqli_query($conn, "INSERT INTO `invoice`(`INV_id`,`INV_rentprice`,`INV_discount`,`INV_cost`,`INV_total`,`INV_days`,`INV_expired`,`b_id`,`mkr_id`)
                    VALUES('$INV_id','$INV_rentprice','$INV_discount','$INV_cost','$INV_total','$INV_days','$INV_expired','$b_id','$mkr_id')");
                if ($insertinv) {
                    echo "<script>";
                    echo "
                    Swal.fire({
                        title: 'ส่งใบแจ้งค่าเช่าสำเร็จ',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500
                    });";
                    echo "</script>";
                    echo '<meta http-equiv="refresh" content="1"; />';
                } else {
                    echo '<script>error();</script>';
                }
            }
        }
    }
}
