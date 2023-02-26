<?php

include "../backend/1-connectDB.php";

// include "../backend/1-import-link.php";



$count_n = 1;

$data = "SELECT req_partner.*, 

    users.username ,

    provinces.province_name,

    amphures.amphure_name,

    districts.district_name , 

    market_type.market_type,

    req_status.req_status

    FROM req_partner 

        JOIN users ON (req_partner.users_id = users.users_id)

        JOIN provinces ON (req_partner.province_id = provinces.id)

        JOIN amphures ON (req_partner.	amphure_id = amphures.id)

        JOIN districts ON (req_partner.district_id = districts.id)

        JOIN market_type ON (req_partner.market_type_id = market_type.market_type_id)

        JOIN req_status ON (req_partner.req_status_id = req_status.req_status_id) WHERE (req_partner.req_status_id = '1')

        ORDER BY `timestamp` DESC";

$result = mysqli_query($conn, $data);

$data1 = "SELECT req_partner.*, 

    users.username ,

    provinces.province_name,

    amphures.amphure_name,

    districts.district_name , 

    market_type.market_type,

    req_status.*

    FROM req_partner 

        JOIN users ON (req_partner.users_id = users.users_id)

        JOIN provinces ON (req_partner.province_id = provinces.id)

        JOIN amphures ON (req_partner.	amphure_id = amphures.id)

        JOIN districts ON (req_partner.district_id = districts.id)

        JOIN market_type ON (req_partner.market_type_id = market_type.market_type_id)

        JOIN req_status ON (req_partner.req_status_id = req_status.req_status_id)

        ORDER BY `timestamp` DESC";

$result2 = mysqli_query($conn, $data1);





// อนุมัติตลาด



if (isset($_GET['approve'])) {

     $approveid = $_GET['approve'];

     $sqlqry = "SELECT * FROM req_partner WHERE (req_partner_id=$approveid) ";

     $qry = mysqli_query($conn, $sqlqry);

     $row = mysqli_fetch_array($qry);

     extract($row);



     $market_name = $row['market_name'];

     $market_descrip = $row['market_descrip'];

     $market_pic = $row['market_pic'];

     $market_type_id = $row['market_type_id'];

     $users_id = $row['users_id'];

     $email = $row['email'];

     $tel = $row['tel'];

     $opening = $row['opening'];
     



     $house_no = $row['house_no'];

     $soi = $row['soi'];

     $moo = $row['moo'];

     $road = $row['road'];

     $district_id = $row['district_id'];

     $amphure_id = $row['amphure_id'];

     $province_id = $row['province_id'];

     $postalcode = $row['postalcode'];



     $approve = mysqli_query($conn, "UPDATE req_partner SET req_status_id = '2' WHERE (req_partner_id = $approveid)");

     $insert =  mysqli_query($conn, "INSERT INTO `market_detail`( `mkr_name`, `mkr_descrip`, `mkr_pic`, `market_type_id`, `users_id`, `email`, `tel`, `house_no`, `soi`, `moo`, `road`, `district_id`, `amphure_id`, `province_id`, `postalcode`,`opening`) 

     VALUES ('$market_name','$market_descrip','$market_pic','$market_type_id','$users_id','$email','$tel','$house_no','$soi','$moo','$road','$district_id','$amphure_id','$province_id','$postalcode','$opening')");



     $user_info = "SELECT * FROM `users` WHERE(users_id = $users_id)";

     $qryuser_info = mysqli_query($conn, $user_info);

     $rowus = mysqli_fetch_array($qryuser_info);

     $p_name = $rowus['firstName'];

     $p_surname = $rowus['lastName'];



     $last_id = mysqli_query($conn, "SELECT MAX(mkr_id) AS maxid FROM market_detail");

     $mid = mysqli_fetch_array($last_id);

     extract($mid);

     $mkr_id = $mid['maxid'];



     $Insertpayment = "INSERT INTO `payment_info`(`p_name`, `p_surname`, `p_promtpay`, `p_bank`, `p_account`, `mkr_id`) VALUES ('$p_name','$p_surname','-','ธนาคารไทยพาณิชย์ (SCB)','-','$mkr_id')";

     $sqlInsertpayment = mysqli_query($conn, $Insertpayment);



     if ($approve && $insert && $sqlInsertpayment) {

          echo "<script>Approvesuccess();</script>";

     } else {

          echo "<script>error();</script>";

     }

}



// ไม่อนุมัติตลาด

if (isset($_GET['denied'])) {

     $deniedid = $_GET['denied'];

     $denied = "UPDATE req_partner SET req_status_id = '3' WHERE (req_partner_id = $deniedid)";

     if (mysqli_query($conn, $denied)) {

          echo "<script>Deninedsuccess();</script>";

     } else {

          echo "<script>error();</script>";

     }

}

mysqli_close($conn);

