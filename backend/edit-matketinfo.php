<?php
if ($_GET) {
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
}


if (isset($_POST['bn-submit'])) {
  $mkr_name = $_POST['mkr_name'];
  $mkrtype = $_POST['mkrtype'];
  $mkr_descrip = $_POST['mkr_descrip'];
  $email = $_POST['email'];
  $tel = $_POST['tel'];

  $house_no = $_POST['HouseNo'];
  $soi = $_POST['Soi'];
  $moo = $_POST['Moo'];
  $road = $_POST['Road'];
  $province_id = $_POST['province_id'];
  $amphure_id = $_POST['amphure_id'];
  $district_id = $_POST['district_id'];
  $postalcode = $_POST['PostalCode'];
  $opening = $_POST['opening'];

  date_default_timezone_set('Asia/Bangkok');
  $date = date("Ymd");
  $numrand = (mt_rand());

  // ไฟล์ภาพตลาด
  $ct_logo_tmp = $_FILES['ct_logo']['tmp_name'];
  $ct_logo_oldname = strrchr($_FILES['ct_logo']['name'], ".");
  $ct_logo_name = $date . $numrand . $ct_logo_oldname;
  $ct_logo_type = $_FILES['ct_logo']['type'];
  $ct_logo = 'asset/img_market/' . $ct_logo_name;
  $path = '../asset/img_market/' . $ct_logo_name;



  if (($mkr_name && $mkrtype && $mkr_descrip && $email && $tel && $house_no && $soi && $moo && $road && $province_id && $amphure_id && $district_id  && $postalcode && $opening ) != '') {

    if ($ct_logo_tmp != "") {
      $udlogo = "UPDATE market_detail  SET mkr_pic='$ct_logo'WHERE (mkr_id = '$mkr_id')";
      $sqlInsert = "UPDATE market_detail  SET mkr_name='$mkr_name',market_type_id='$mkrtype',mkr_descrip='$mkr_descrip',email='$email',tel='$tel', house_no='$house_no',soi='$soi',moo='$moo',road='$road',district_id='$district_id',amphure_id='$amphure_id',province_id='$province_id',postalcode='$postalcode',opening='$opening' WHERE (mkr_id = '$mkr_id') ";
      if (mysqli_query($conn, $sqlInsert) && mysqli_query($conn, $udlogo)) {
        move_uploaded_file($ct_logo_tmp, $path);
        echo '<meta http-equiv="refresh" content="1"; URL=../users-market/edit-market-info.php" />';
        echo "<script type='text/javascript'> success(); </script>";
      } else {
        echo "<script>error();</script>";
      }
    } else {
      $sqlInsert = "UPDATE market_detail  SET mkr_name='$mkr_name',market_type_id='$mkrtype',mkr_descrip='$mkr_descrip',email='$email',tel='$tel', house_no='$house_no',soi='$soi',moo='$moo',road='$road',district_id='$district_id',amphure_id='$amphure_id',province_id='$province_id',postalcode='$postalcode',opening='$opening' WHERE (mkr_id = '$mkr_id') ";
      if (mysqli_query($conn, $sqlInsert)) {
        echo '<meta http-equiv="refresh" content="1"; URL=../users-market/edit-market-info.php" />';
        echo "<script type='text/javascript'> success(); </script>";
      } else {
        echo "<script>error();</script>";
      }
    }
  } else {
    echo "<script>error();</script>";
  }
}
