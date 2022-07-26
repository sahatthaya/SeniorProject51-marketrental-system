<?php
include "../backend/connectDB.php";

$count_n = 1;
$data = "SELECT req_partner.*, users.username FROM req_partner JOIN users ON (req_partner.users_id = users.users_id) WHERE (req_status_id = '1')";
$result = mysqli_query($conn, $data);

if (isset($_POST["mkrdid"])) {
    $id = $_POST["mkrdid"];
    $data = "SELECT req_partner.*, users.username ,province.province_name , market_type.market_type FROM req_partner 
    JOIN users ON (req_partner.users_id = users.users_id)
    JOIN province ON (req_partner.province_id = province.province_id)
    JOIN market_type ON (req_partner.market_type_id = market_type.market_type_id)
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
               <td width="30%"><label>จังหวัด</label></td>  
               <td width="70%">' . $row["province_name"] . '</td>  
          </tr>  
          <tr>  
               <td width="30%"><label>สถานที่ตั้ง</label></td>  
               <td width="70%">' . $row["market_address"] . '</td>  
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
mysqli_close($conn);

