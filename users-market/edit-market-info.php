<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/applicant.css">
  <title>แก้ไขข้อมูลตลาด</title>
</head>.
<script type="text/javascript">
  function success() {
    Swal.fire({
      title: 'บันทึกข้อมูลสำเร็จ',
      icon: 'success',
      showConfirmButton: false,
      timer: 2500
    })
  }

  function error() {
    Swal.fire({
      title: 'ผิดพลาด',
      text: 'เกิดข้อผิดพลาดกรุณาลองอีกครั้ง',
      icon: 'error',
      showConfirmButton: false,
      timer: 2500
    })
  }
</script>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
require "../backend/edit-matketinfo.php";
?>


<body>
  <h1>แก้ไขข้อมูลตลาด</h1>
  <form id="applyform" method="POST" enctype="multipart/form-data">
    <div class="form-outer" style="overflow: visible;">
      <!-- form--1 -->
      <div id="stepOne" class="row">
        <div class="des_input">ชื่อตลาด</div>
        <input class="form-control col-6" type="text" value="<?php echo $row['mkr_name']; ?>" name="mkr_name" required>
        <div class="row" id="dropdown">
          <div class="col-md-6" id="mkrtype">
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
          <div class="col-md-6" id="provincebox">
            <div class="des_input">จังหวัด</div>
            <div class="search_select_box">
              <select name="province" id="province" class="selectpicker" data-live-search="true" title="เลือกจังหวัด" data-width="100%" data-size="5" required>
                <option value="<?php echo $row['province_id']; ?>" selected="selected"><?php echo $row['province_name']; ?></option>
                <?php while ($row1 = mysqli_fetch_array($result_province)) :; ?>
                  <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                <?php endwhile; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="des_input">สถานที่ตั้ง</div>
        <input type="text" class="form-control" name="mkr_address" value="<?php echo $row["mkr_address"] ?>">
        <div class="des_input">รายละเอียดตลาด</div>
        <textarea type="text" class="form-control" name="mkr_descrip"><?php echo $row["mkr_descrip"] ?></textarea>
        <div class="des_input">อีเมล</div>
        <input type="text" class="form-control" name="email" value="<?php echo $row["email"] ?>">
        <div class="des_input">เบอร์โทรศัพท์</div>
        <input type="text" class="form-control" name="tel" value="<?php echo $row["tel"] ?>">
        <div class="des_input">รูปภาพตลาด</div>
        <input type="file" class="form-control" name="ct_logo">
        <div class="des_input">รูปภาพตลาดปัจุบัน : </div>
        <div class="text-start">
          <img style="width:500px;margin-top:10px;" class="img-fluid rounded" src='../<?php echo $row["mkr_pic"] ?>'>
        </div>
        <input type="submit" class="btn btn-primary" id="add-data" name="bn-submit" value="บันทึกข้อมูล">
      </div>
    </div>
  </form>
</body>

</html>