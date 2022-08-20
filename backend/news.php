<?php
include "../backend/1-connectDB.php";

if (isset($_GET['mkr_id'])) {
    $mkr_id = $_GET['mkr_id'];
    //qry
    $count_n = 1;
    $data2 = "SELECT * FROM news WHERE mkr_id = '$mkr_id'";
    $result3 = mysqli_query($conn, $data2);
}


if (isset($_POST['add-news'])) {
    $n_sub = $_POST['n_sub'];
    $n_detail = $_POST['n_detail'];
    $n_file = '';
    $n_file = isset($_POST['n_file']);


    date_default_timezone_set('Asia/Bangkok');
    $date = date("Ymd");
    $numrand = (mt_rand());
    // ไฟล์ภาพ
    $n_tmp = $_FILES['n_file']['tmp_name'];
    $n_nameoldname = strrchr($_FILES['n_file']['name'], ".");
    $n_name = $date . $numrand . $n_nameoldname;
    $n_type = $_FILES['n_file']['type'];
    $n_file = 'asset/news/' . $n_name;
    $npath = '../asset/news/' . $n_name;
    if (isset($_POST["n_sub"]) != "" && isset($_POST["n_detail"]) != "") {
        move_uploaded_file($n_tmp, $npath);
        $sqlInsert = "INSERT INTO news(n_sub, n_detail, n_file,mkr_id) VALUES ('$n_sub', '$n_detail', '$n_file', $mkr_id)";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1"; />';
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง);</script>";
        }
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง);</script>";
    }
}
// delete
if (isset($_GET['del'])) {
    $del = $_GET['del'];
    $mkr_id = $_GET['mkr_id'];
    $sqldel = "DELETE FROM `news` WHERE n_id='$del'";
    if (mysqli_query($conn, $sqldel)) {
        echo "<script type='text/javascript'> delsuccess(); </script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง);</script>";
    }
}

if (isset($_POST["newsid"])) {
    $id = $_POST["newsid"];
    $data = "SELECT * FROM `news` WHERE  n_id = '$id'";
    $output = '';
    $result = mysqli_query($conn, $data);
    $output .= '<div class="table-responsive">  <table class="table table-bordered">';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
          <tr>  
               <td width="30%"><label>หัวข้อเรื่อง</label></td>  
               <td width="70%">' . $row["n_sub"] . '</td>  
          </tr>  
          <tr>  
          <td width="30%"><label>วันที่เพิ่มข่าวสาร</label></td>  
          <td width="70%">' . $row["timestamp"] . '</td>  
          </tr>  
          <tr>  
               <td width="30%"><label>รายละเอียด</label></td>  
               <td width="70%">' . $row["n_detail"] . '</td>  
          </tr>    
          <tr>  
               <td width="30%"><label>รูปภาพแบนเนอร์</label></td>  
               <td width="70%"><img style="width:300px;" src=../' . $row["n_file"] . '></td>  
          </tr>  
          
     ';
    }
    $output .= '  
     </table>  
</div>  
';
    echo $output;
};
