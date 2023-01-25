<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/applicant.css">
  <title> MarketRental - แก้ไขข้อมูลตลาด</title>

</head>

<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
require "../backend/edit-matketinfo.php";
$query_mkrType = "SELECT * FROM market_type ORDER BY market_type_id";
$result_mkrType = mysqli_query($conn, $query_mkrType);
$query_province = "SELECT * FROM provinces";
$result_province = mysqli_query($conn, $query_province);
?>


<body>
  <nav aria-label="breadcrumb mb-3">
    <ol class="breadcrumb ">
      <li class="breadcrumb-item fs-5 "><a href="./index.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none">หน้าหลัก</a></li>
      <li class="breadcrumb-item active fs-5" aria-current="page">แก้ไขข้อมูล <?php echo $row['mkr_name']; ?></li>
    </ol>
  </nav>
  <form id="applyform" method="POST" enctype="multipart/form-data"  class="was-validated">
    <div class="form-outer" style="overflow: visible;">
      <h1>แก้ไขข้อมูล <?php echo $row['mkr_name']; ?></h1>
      <!-- form--1 -->
      <div id="stepOne" class="row border shadow-sm pt-5 pb-3 px-5 mt-3 mb-3 rounded">
        <div class="des_input">ชื่อตลาด</div>
        <input class="form-control col-6" type="text" value="<?php echo $row['mkr_name']; ?>" name="mkr_name" required>
        <div id="mkrtype" class="mb-3">
          <div class="des_input">ประเภทตลาด</div>
          <div class="search_select_box">
            <select class="selectpicker " title="เลือกประเภท" name="mkrtype" data-width="100%" data-size="5" required>
              <option value="<?php echo $row['market_type_id']; ?>" selected="selected"><?php echo $row['market_type']; ?></option>
              <?php while ($row1 = mysqli_fetch_array($result_mkrType)) :; ?>
                <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
              <?php endwhile; ?>
            </select>
          </div>
        </div>
        <div class="des_input mt-3 hstack gap-2">สถานที่ตั้ง
          <div data-toggle="tooltip" title="หากต้องการเปลี่ยนแปลงจังหวัด อำเภอ หรือ ตำบลใหม่ ต้องทำการเลือก จังหวัด อำเภอ และตำบลใหม่" class="mt-1">
            <i class='bx bx-info-circle'></i>
          </div>
        </div>
        <div class="row p-0 m-0 mt-2">
          <div class="col-md-2 p-0 pt-2">บ้านเลขที่ :</div>
          <div class="col-md-4 p-0">
            <input class="form-control" type="text" placeholder="บ้านเลขที่" name="HouseNo" required value="<?php echo $row['house_no']; ?>" required>
          </div>
          <div class="col-md-2 pt-2">ซอย :</div>
          <div class="col-md-4 p-0">
            <input class="form-control" type="text" placeholder="ซอย" name="Soi" required value="<?php echo $row['soi']; ?>" required>
          </div>
        </div>
        <div class="row p-0 m-0 mt-2">
          <div class="col-md-2 p-0 pt-2">หมู่ :</div>
          <div class="col-md-4 p-0">
            <input class="form-control" type="text" placeholder="หมู่" name="Moo" required value="<?php echo $row['moo']; ?>" required>
          </div>
          <div class="col-md-2 pt-2">ถนน :</div>
          <div class="col-md-4 p-0">
            <input class="form-control" type="text" placeholder="ถนน" name="Road" required value="<?php echo $row['road']; ?>" required>
          </div>
        </div>
        <div class="row p-0 m-0 mt-2">
          <div class="col-md-2 p-0 pt-2">จังหวัด :</div>
          <div class="col-md-4 p-0">
            <select name="province_id" id="province" class="form-control selectpicker" data-live-search="true" data-width="100%" data-size="5" title="เลือกจังหวัด" required>
              <option value="<?php echo $row['province_id']; ?>" selected><?php echo $row['province_name']; ?></option>
              <?php while ($result = mysqli_fetch_assoc($result_province)) : ?>
                <option value="<?= $result['id'] ?>"><?= $result['province_name'] ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-md-2 pt-2">อำเภอ/เขต :</div>
          <div class="col-md-4 p-0">
            <select name="amphure_id" id="amphure" class="form-control selectpicker" data-live-search="true" data-width="100%" data-size="5" title="เลือกอำเภอ/เขต" required>
              <option value="<?php echo $row['amphure_id']; ?>" selected><?php echo $row['amphure_name']; ?></option>
            </select>
          </div>
        </div>
        <div class="row p-0 m-0 mt-2">
          <div class="col-md-2 p-0 pt-2">ตำบล/แขวง :</div>
          <div class="col-md-4 p-0">
            <select name="district_id" id="district" class="form-control selectpicker" data-live-search="true" data-width="100%" data-size="5" title="เลือกตำบล/แขวง" required>
              <option value="<?php echo $row['district_id']; ?>" selected><?php echo $row['district_name']; ?></option>
            </select>
          </div>
          <div class="col-md-2 pt-2">รหัสไปรษณีย์ :</div>
          <div class="col-md-4 p-0">
            <input name="PostalCode" id="zipcode" class="form-control" style="height:45px ;" value="<?php echo $row['postalcode']; ?>" placeholder="รหัสไปรษณีย์" required>
            </input>
          </div>
          <div class="des_input hstack gap-2">วันที่เปิดทำการ</div>
          <select class="form-select" name="opening" aria-label="Default select example" required>
            <option value="<?php echo $row['opening'] ?>" selected hidden><?php echo $row['opening'] ?></option>
            <option value="เปิดทำการทุกวัน">เปิดทำการทุกวัน</option>
            <option value="เปิดทำการเป็นรอบ">เปิดทำการเป็นรอบ</option>
          </select>
        
        </div>
        <div class="des_input hstack gap-2">รายละเอียดตลาดโดยสังเขป
          <div data-toggle="tooltip" title="เช่น ตลาดค้าส่ง ทำเลดี ติดถนนใหญ่ใกล้สี่แยกไฟแดง" class="mt-1">
            <i class='bx bx-info-circle'></i>
          </div>
        </div>
        <textarea type="text" class="form-control" name="mkr_descrip" required><?php echo $row["mkr_descrip"] ?></textarea>
        <div class="des_input">อีเมล</div>
        <input type="text" class="form-control" name="email" value="<?php echo $row["email"] ?>" required>
        <div class="des_input">เบอร์โทรศัพท์</div>
        <input type="text" id="tel" class="form-control" name="tel" value="<?php echo $row["tel"] ?>" pattern="[0-9]{10}" required>
        <div class="des_input">รูปภาพตลาด</div>
        <input type="file" class="form-control" name="ct_logo" id="mkr"  accept="image/jpeg,image/gif,image/png">
        <div class="p-0">
          <img style="width:750px;margin-top:10px;" class="img-fluid rounded" src='../<?php echo $row["mkr_pic"] ?>' id="mkrpic">
        </div>
        <input type="submit" class="btn btn-primary mt-3" id="add-data" name="bn-submit" value="บันทึกข้อมูล">
      </div>
    </div>
  </form>
  <script src="script.js"></script>

</body>
<script>
  $(document).ready(function() {
    $("body").tooltip({
      selector: '[data-toggle=tooltip]',
      placement: 'right'
    });
  });
  $(":input").inputmask();

  $("#tel").inputmask({
    "mask": "9999999999"
  });
  $("#zipcode").inputmask({
    "mask": "99999"
  });

  mkr.onchange = evt => {
    const [file] = mkr.files
    if (file) {
      mkrpic.src = URL.createObjectURL(file)
    }
  }
</script>

</html>