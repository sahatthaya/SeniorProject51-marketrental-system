<?php
include "../backend/connectDB.php";

// corusel query
$query = "SELECT * FROM banner ORDER BY bn_id DESC";
$result = mysqli_query($conn, $query);

// tb query
$count_n = 1;
$datatb = "SELECT * FROM banner  ORDER BY bn_id DESC";
$result2 = mysqli_query($conn, $datatb);

if (isset($_POST['bn-submit'])) {
    $bn_toppic = $_POST['bn_toppic'];
    $bn_detail = $_POST['bn_detail'];
    // ไฟล์ภาพ
    date_default_timezone_set('Asia/Bangkok');
    $date = date("Ymd");
    $numrand = (mt_rand());
    $bn_tmp = $_FILES['bn_img']['tmp_name'];
    $oldname = strrchr($_FILES['bn_img']['name'], ".");
    $bn_name = $date . $numrand . $oldname;
    $bn_type = $_FILES['bn_img']['type'];
    $bn_img = '../asset/banner/' . $bn_name;
    $path = 'asset/banner/' . $bn_name;
    if (isset($_POST["bn_toppic"]) != "" && isset($_POST["bn_detail"]) != "" && isset($_POST["bn_toppic"]) != "" && isset($bn_img) != "") {
        move_uploaded_file($bn_tmp, $bn_img);
        $sqlInsert = "INSERT INTO banner (bn_toppic,bn_detail,bn_pic) VALUES ('$bn_toppic','$bn_detail','$path') ";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script>alert('ลงทะเบียนสำเร็จ');</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง');</script>";
        }
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง);</script>";
    }
}

if (isset($_POST["bannerid"])) {
    $id = $_POST["bannerid"];
    $data = "SELECT * FROM banner WHERE bn_id = '$id'";
    $output = '';
    $resultdata = mysqli_query($conn, $data);
    $output .= '<div class="table-responsive">  <table class="table table-bordered">';
    while ($row = mysqli_fetch_array($resultdata)) {
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
}



if ($_GET) {
    $bn_id = $_GET['bn_id'];

    $sqlDelUsers = "DELETE FROM banner WHERE bn_id = '$bn_id'";
    if ($rsDelUsers = mysqli_query($conn, $sqlDelUsers)) {
        echo "<script>alert('ลบข้อมูลเสร็จสิ้น');window.location = '../users-admin/banner.php';</script>";
        mysqli_close($conn);
    } else {
        echo "<script>alert ('ผิดพลาด ไม่สามารถลบข้อมูลได้');window.location = '../users-admin/banner.php';</script>";
    }
}

mysqli_close($conn);
