<?php
include "../backend/1-connectDB.php";

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
        JOIN req_status ON (req_partner.req_status_id = req_status.req_status_id) WHERE (req_partner.req_status_id = '1')";
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
        JOIN req_status ON (req_partner.req_status_id = req_status.req_status_id)";
$result2 = mysqli_query($conn, $data1);

if (isset($_POST["mkrdid"])) {
     $id = $_POST["mkrdid"];
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
        JOIN req_status ON (req_partner.req_status_id = req_status.req_status_id)
    WHERE req_partner_id = '$id'";
     $output = '';
     $result = mysqli_query($conn, $data);
     $output .= '<div class="table-responsive">  <table class="table table-bordered">';
     while ($row = mysqli_fetch_array($result)) {
          $output .= '
         <tr> <h5>ข้อมูลตลาด</h5></tr>  
          <tr>  
               <td width="30%"><label>ชื่อตลาด</label></td>  
               <td width="70%">' . $row["market_name"] . '</td>  
          </tr>  
          <tr>  
               <td width="30%"><label>ประเภทตลาด</label></td>  
               <td width="70%">' . $row["market_type"] . '</td>  
          </tr> 
          <tr>  
                <td width="30%"><label>การเปิดทำการ</label></td>  
               <td width="70%">' . $row["opening"] . '</td>  
          </tr>  
          <tr>  
               <td width="30%"><label>สถานที่ตั้ง</label></td>  
               <td width="70%"> บ้านเลขที่ ' . $row["house_no"] . ' ซอย ' . $row["soi"] . ' หมู่ ' . $row["moo"] . 'ถนน ' . $row["road"] . ' ตำบล/แขวง ' . $row["district_name"] . ' อำเภอ/เขต ' . $row["amphure_name"] . ' จังหวัด ' . $row["province_name"] . ' รหัสไปรษณีย์ ' . $row["postalcode"] . '</td>  

          </tr>  
          <tr>  
               <td width="30%"><label>รายละเอียดตลาด</label></td>  
               <td width="70%">' . $row["market_descrip"] . '</td>  
          </tr>  
          <tr>  
          <td width="30%"><label>รูปภาพตลาด</label></td>  
          <td width="70%"><img style="width:300px;" src=../' . $row["market_pic"] . '></td>  
         </tr> </table>  <div class="table-responsive">  <table class="table table-bordered">
           <h5>ข้อมูลผู้ส่งคำร้อง</h5>  
          <tr>  
               <td width="30%"><label>ชื่อ - นามสกุล</label></td>  
               <td width="70%">' . $row["firstName"] . " " . $row["lastName"] . '</td>  
          </tr>  
          <tr>  
               <td width="30%"><label>อีเมล</label></td>  
               <td width="70%">' . $row["email"] . '</td>  
          </tr>  
          <tr>  
               <td width="30%"><label>เบอร์โทรศัพท์</label></td>  
               <td width="70%">' . $row["tel"] . '</td>  
          </tr>  
          <tr>  
               <td width="30%"><label>สำเนาบัตรประจำตัวประชาชน</label></td>  
               <td width="70%"><img style="width:300px;" src=../' . $row["cardIDcpy"] . '></td>  
          </tr>  
         
     ';
     }
     $output .= '  
     </table>  
</div>  
';
     echo $output;
}

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

     $house_no = $row['house_no'];
     $soi = $row['soi'];
     $moo = $row['moo'];
     $road = $row['road'];
     $district_id = $row['district_id'];
     $amphure_id = $row['amphure_id'];
     $province_id = $row['province_id'];
     $postalcode = $row['postalcode'];


     $approve = "UPDATE req_partner SET req_status_id = '2' WHERE (req_partner_id = $approveid)";
     $insert = "INSERT INTO `market_detail`( `mkr_name`, `mkr_descrip`, `mkr_pic`, `market_type_id`, `users_id`, `email`, `tel`, `house_no`, `soi`, `moo`, `road`, `district_id`, `amphure_id`, `province_id`, `postalcode`) 
     VALUES ('$market_name','$market_descrip','$market_pic','$market_type_id','$users_id','$email','$tel','$house_no','$soi','$moo','$road','$district_id','$amphure_id','$province_id','$postalcode')";
     $udusers = "UPDATE users SET type  = '2' WHERE(users_id = $users_id)";

     $isql2 = mysqli_query($conn, $udusers);
     $ql = mysqli_query($conn, $approve);
     $isql = mysqli_query($conn, $insert);
     $mkr_id =  mysqli_insert_id($conn);

     $InsertcostUnit = "INSERT INTO `cost/unit`(`cu_name`, `cu_price`, `mkr_id`) VALUES ('ค่าน้ำ','0','$mkr_id'),('ค่าไฟ','0','$mkr_id'),('ค่าขยะ','0','$mkr_id')";
     $sqlCU = mysqli_query($conn, $InsertcostUnit);

     $user_info = "SELECT * FROM `users` WHERE(users_id = $users_id)";
     $qryuser_info = mysqli_query($conn, $user_info);
     $rowus = mysqli_fetch_array($qryuser_info);
     $p_name = $rowus['firstName'];
     $p_surname = $rowus['lastName'];

     $Insertpayment = "INSERT INTO `payment_info`(`p_name`, `p_surname`, `p_promtpay`, `p_bank`, `p_account`, `mkr_id`) VALUES ('$p_name','$p_surname','-','ธนาคารไทยพาณิชย์ (SCB)','-','$mkr_id')";
     $sqlInsertpayment = mysqli_query($conn, $Insertpayment);


     if ($isql2 && $ql && $isql && $sqlCU && $sqlInsertpayment) {
          echo "<script>Approvesuccess();</script>";
          echo '<meta http-equiv="refresh" content="1"; />';
     } else {
          echo "<script>error();</script>";
     }
}
if (isset($_GET['denied'])) {
     $deniedid = $_GET['denied'];
     $denied = "UPDATE req_partner SET req_status_id = '3' WHERE (req_partner_id = $deniedid)";
     if (mysqli_query($conn, $denied)) {
          echo "<script>Deninedsuccess();</script>";
          echo '<meta http-equiv="refresh" content="1"; />';
     } else {
          echo "<script>error();</script>";
     }
}
mysqli_close($conn);
