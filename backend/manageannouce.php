<?php
include "../backend/connectDB.php";
// tb rqan query
$count_n = 1;
$data2 = "SELECT req_annouce.*, users.username FROM req_annouce JOIN users ON (req_annouce.users_id = users.users_id) WHERE (req_status_id = '1')";
$result3 = mysqli_query($conn, $data2);

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
if (isset($_GET['approve'])) {
    $approveid = $_GET['approve'];
    $sqlqry = "SELECT * FROM req_annouce WHERE (req_an_id = '$approveid') ";
    $qry = mysqli_query($conn, $sqlqry);
    $row = mysqli_fetch_array($qry);
    extract($row);
    $bn_toppic = $row['bn_toppic'];
    $bn_detail = $row['bn_detail'];
    $bn_pic = $row['bn_pic'];

    $approve = "UPDATE req_annouce SET req_status_id = '2' WHERE (req_an_id = $approveid)";
    $insert = "INSERT INTO banner (bn_toppic,bn_detail,bn_pic) VALUES ('$bn_toppic','$bn_detail','$bn_pic')";

    if ($ql = mysqli_query($conn, $approve)&&$isql = mysqli_query($conn, $insert)) {
        echo "<script>alert('อนุมัติคำร้องเสร็จสิ้น');window.location = '../users-admin/annouce.php';</script></script>";
    } else {
        echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง');window.location='../users-admin/annouce.php';</script>";
    }
}

if (isset($_GET['denied']) ){
    $deniedid = $_GET['denied'];
    $denied = "UPDATE req_annouce SET req_status_id = '3' WHERE (req_an_id = $deniedid)";
    if (mysqli_query($conn, $denied)) {
        echo "<script>alert('ยกเลิกคำร้องเสร็จสิ้น');window.location = '../users-admin/annouce.php';</script>";

    } else {
        echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง');window.location='../users-admin/annouce.php';</script>";
    }
}
mysqli_close($conn);
