<?php
include "../backend/1-connectDB.php";
// qry-------------------------------------------------------------------------------------------------------------------

if (isset($_GET['mkr_id'])) {
    $mkr_id = $_GET['mkr_id'];
    //qry
    $count_n = 1;
    $data2 = "SELECT * FROM news WHERE mkr_id = '$mkr_id'";
    $result3 = mysqli_query($conn, $data2);
}
if (isset($_GET['n_id'])) {
    $n_id = $_GET['n_id'];
    $mkr_id = $_GET['mkr_id'];
    //qry
    $count_n = 1;
    $data2 = "SELECT * FROM news WHERE n_id = '$n_id'";
    $result3 = mysqli_query($conn, $data2);
    $edit = mysqli_fetch_array($result3);
    extract($edit);
}
// add-------------------------------------------------------------------------------------------------------------------

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
    if (isset($_POST["n_sub"]) != "" && isset($_POST["n_detail"]) != "" && isset($_POST["n_file"]) != "") {
        move_uploaded_file($n_tmp, $npath);
        $sqlInsert = "INSERT INTO news(n_sub, n_detail, n_file,mkr_id) VALUES ('$n_sub', '$n_detail', '$n_file', $mkr_id)";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1" ; />';
        } else {
            echo "<script>error();</script>";
        }
    } else {
        $sqlInsert = "INSERT INTO news(n_sub, n_detail, n_file,mkr_id) VALUES ('$n_sub', '$n_detail', 'asset/news/nopicture.png	', $mkr_id)";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1" ; />';
        } else {
            echo "<script>error();</script>";
        }
    }
}
// delete-------------------------------------------------------------------------------------------------------------------
if (isset($_GET['del'])) {
    $del = $_GET['del'];
    $mkr_id = $_GET['mkr_id'];
    $sqldel = "DELETE FROM `news` WHERE n_id='$del'";
    if (mysqli_query($conn, $sqldel)) {
        echo "<script type='text/javascript'> delsuccess(); </script>";
    } else {
        echo "<script>error();</script>";
    }
}
// see detail (modal)-------------------------------------------------------------------------------------------------------------------

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
               <td width="30%"><label>รูปภาพที่เกี่ยวข้อง</label></td>  
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

// edit news qry----------------------------------------------------------------------------------------------------
if (isset($_GET['edit-news'])) {
    $n_id = $_GET['edit-news'];
    $mkr_id = $_GET['mkr_id'];
    //qry
    $count_n = 1;
    $data2 = "SELECT * FROM news WHERE n_id = '$n_id'";
    $result3 = mysqli_query($conn, $data2);
    $edit = mysqli_fetch_array($result3);
    extract($edit);
}
// edit news-------------------------------------------------------------------------------------------------------------------

if (isset($_POST['edit-news-submit'])) {
    $n_sub = $_POST['n_sub'];
    $n_detail = $_POST['n_detail'];
    $n_file_post = '';
    $n_file_post = isset($_FILES['n_file']);


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

    if (isset($_POST["n_sub"]) != "" && isset($_POST["n_detail"]) != "" && isset($_FILES["n_file"]) != "") {
        $sqlupdatewithfile = "UPDATE `news` SET `n_file`='$n_file',`n_sub`='$n_sub',`n_detail`='$n_detail' WHERE n_id = '$n_id'";
        $updatewithfile = mysqli_query($conn, $sqlupdatewithfile);
        if ($updatewithfile) {
            move_uploaded_file($n_tmp, $npath);
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1" ; />';
        } else {
            echo "<script>error();</script>";
        }
    } else {
        $sqlupdate = "UPDATE `news` SET `n_sub`='$n_sub',`n_detail`='$n_detail' WHERE n_id = '$n_id'";
        $update = mysqli_query($conn, $sqlupdate);
        if ($update) {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1" ; />';
        } else {
            echo "<script>error();</script>";
        }
    }
}
