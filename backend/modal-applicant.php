<?php
include "../backend/1-connectDB.php";

if (isset($_POST["anid"])) {
    $id = $_POST["anid"];
    $data = "SELECT * FROM req_annouce WHERE req_an_id = '$id'";
    $output = '';
    $result = mysqli_query($conn, $data);
    $output .= '<div class="table-responsive">  <table class="table table-bordered">';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
          <tr>  
               <td width="30%"><label>หัวข้อเรื่อง</label></td>  
               <td width="70%">' . $row["bn_toppic"] . '</td>  
          </tr>  
          <tr>  
               <td width="30%"><label>รายละเอียด</label></td>  
               <td width="70%">' . $row["bn_detail"] . '</td>  
          </tr>    
          <tr>  
               <td width="30%"><label>รูปภาพแบนเนอร์</label></td>  
               <td width="70%"><img style="width:300px;" src=../' . $row["bn_pic"] . '></td>  
          </tr>  
          
     ';
    }
    $output .= '  
     </table>  
</div>  
';
    echo $output;
};
// ดูข้อมูลคำร้องเพิ่มตลาด
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

?>

<div id="bannerdataModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รายละเอียดคำร้อง</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="bannerdetail">

            </div>

        </div>
    </div>
</div>