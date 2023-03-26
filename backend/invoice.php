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

// if ($row['opening'] == 'เปิดทำการทุกวัน') {

//     $query = mysqli_query($conn, "SELECT * FROM `booking_range`JOIN `stall` ON (booking_range.stall_id = stall.sKey) WHERE `stall`.market_id = $mkr_id ORDER BY `start` DESC");
// } else {

//     $query = mysqli_query($conn, "SELECT * FROM `booking_period`JOIN `stall` ON (booking_period.stall_id = stall.sKey)JOIN `opening_period` ON (booking_period.op_id = opening_period.id) WHERE `stall`.market_id = $mkr_id ORDER BY `start` DESC");
// }

$query = mysqli_query($conn, "SELECT * FROM `booking`JOIN `stall` ON (booking.stall_id = stall.sKey) WHERE `stall`.market_id = $mkr_id ORDER BY `b_start` DESC");

if (isset($_POST['submit-inv'])) {


    $INV_expired = $_POST['INV_expired'];



    $numcost = $_POST['numcost'] + 1;

    $numtbrow = $_POST['numtbrow'];

    $mkr_id = $_POST['mkr_id'];



    for ($i = 0; $i < $numtbrow; $i++) {

        $b_id_i = "b_id$i";

        $rentprice_i = "rentprice$i";

        $discount_i = "discount$i";
        $sID_i = "sid$i";
        $usersb_id_i = "usersb_id$i";



        $b_id = $_POST[$b_id_i];

        $rentprice = $_POST[$rentprice_i];

        $discount = $_POST[$discount_i];

        $sID = $_POST[$sID_i];
        $usersb_id = $_POST[$usersb_id_i];



        $inset_inv = mysqli_query($conn, "INSERT INTO `invoice`(`INV_rentprice`, `INV_discount`, `INV_expired`, `b_id`, `mkr_id`) VALUES ('$rentprice',' $discount',' $INV_expired','$b_id','$mkr_id')");



        $last_id = mysqli_query($conn, "SELECT MAX(INV_id) AS maxid, market_detail.mkr_name FROM invoice JOIN market_detail ON (market_detail.mkr_id = invoice.mkr_id) LIMIT 1");
        $mid = mysqli_fetch_array($last_id);
        extract($mid);

        $inv_id = $mid['maxid'];
        $mkrname = $mid['mkr_name'];

        $sub = $mkrname . " แผงค้า: " . $sID;
        $insertnoti = mysqli_query($conn, "INSERT INTO `notification`(`n_sub`, `n_detail`,`status`, `type`, `fk_id`, `users_id`)
        VALUES ('$sub','คุณได้รับใบเรียกเก็บค่าเช่า กรุณาชำระภายในวันที่กำหนด','1','6','$inv_id','$usersb_id')");

        if ($numcost != '0') {

            for ($x = 1; $x < $numcost; $x++) {

                $cost_name_i = "costname$x";

                $priceunit_i = "price$x";

                $unit_i = "unit$x";

                $price_i = "bill$i" . "price$x";



                $cost_name = $_POST[$cost_name_i];

                $priceunit = $_POST[$priceunit_i];

                $unit = $_POST[$unit_i];

                $price = $_POST[$price_i];

                $insert_cost = mysqli_query($conn, "INSERT INTO `inv_cost`(`INV_id`, `cost_name`, `price/unit`, `unit`, `price`) 

                VALUES ('$inv_id','$cost_name','$priceunit','$unit','$price')");
            }
        } else {
        }
    }

    echo "<script>";

    echo "

                  Swal.fire({

                      title: 'สร้างและส่งใบแจ้งค่าเช่าสำเร็จ',

                      icon: 'success',

                      showConfirmButton: false,

                      timer: 2500

                  });";

    echo "</script>";

    echo '<meta http-equiv="refresh" content="1"; />';
}
