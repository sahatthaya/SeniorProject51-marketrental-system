<?php
$query_mkrType = "SELECT * FROM market_type ORDER BY market_type_id";
$result_mkrType = mysqli_query($conn, $query_mkrType);
$query_province = "SELECT * FROM province";
$result_province = mysqli_query($conn, $query_province);
if ($_GET) {
  $mkr_id = $_GET['mkr_id'];
  $sql = "SELECT market_detail.*,province.province_name , market_type.market_type FROM market_detail 
  JOIN province ON (market_detail.province_id = province.province_id)
  JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id) WHERE (mkr_id = '$mkr_id') ";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  extract($row);
}


if (isset($_POST['bn-submit'])) {

  $mkr_name = $_POST['mkr_name'];
  $mkrtype = $_POST['mkrtype'];
  $province = $_POST['province'];
  $mkr_address = $_POST['mkr_address'];
  $mkr_descrip = $_POST['mkr_descrip'];
  $email = $_POST['email'];
  $tel = $_POST['tel'];


  date_default_timezone_set('Asia/Bangkok');
  $date = date("Ymd");
  $numrand = (mt_rand());

  // ไฟล์ภาพตลาด
  $ct_logo_tmp = $_FILES['ct_logo']['tmp_name'];
  $ct_logo_oldname = strrchr($_FILES['ct_logo']['name'], ".");
  $ct_logo_name = $date . $numrand . $ct_logo_oldname;
  $ct_logo_type = $_FILES['ct_logo']['type'];
  $ct_logo = 'asset/img_market/' . $ct_logo_name;
  $path ='../asset/img_market/'. $ct_logo_name;



  if (isset($ct_logo) != "" && isset($_POST["mkr_name"]) != "" && isset($_POST["mkrtype"]) != "" && isset($_POST["province"]) != "" && isset($_POST["mkr_address"]) != "" && isset($_POST["mkr_descrip"]) != "" && isset($_POST["email"]) != "" && isset($_POST["tel"]) != "") {
    $sqlInsert = "UPDATE market_detail  SET mkr_name='$mkr_name',market_type_id='$mkrtype',province_id='$province',mkr_address='$mkr_address',mkr_descrip='$mkr_descrip',email='$email',tel='$tel'WHERE (mkr_id = '$mkr_id') ";
    mysqli_query($conn, $sqlInsert);
    if ($ct_logo_tmp != "") {
      $udlogo = "UPDATE market_detail  SET mkr_pic='$ct_logo'WHERE (mkr_id = '$mkr_id')";
      mysqli_query($conn, $udlogo);
    }
    move_uploaded_file($ct_logo_tmp, $path);
    echo "<script>alert('แก้ไขข้อมูลสำเร็จ');</script>";
  } else {
    echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง);</script>";
  }
}
?>