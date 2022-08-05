<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/market-info.css">
  <title>ระบบร้องเรียน</title>
</head>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
require "../backend/edit-matketinfo.php";
?>

<body>
    <div class="row">
      <div class="col-5">
        <p id="mkr_name"><?php echo $row['mkr_name']; ?></p>
        <div class="hstack gap-2 info-tag">
          <button class="type_tag"><i class='bx bxs-info-circle'></i> <?php echo $row['market_type']; ?></button>
          <button class="type_tag"><i class='bx bxs-navigation'></i> <?php echo $row['province_name']; ?></button>
        </div>
        <h5>รายละเอียด</h5>
        <p class="text_desc">
          <?php echo $row['mkr_descrip']; ?>
        </p>
        <h5>ข้อมูลติดต่อ</h5>
        <p class="text_desc">
          เบอร์โทร : <?php echo $row['tel']; ?>
          <br>
          อีเมล : <?php echo $row['email']; ?>
          <br>
          ที่อยู่ : <?php echo $row['mkr_address']; ?>
        </p>

      </div>
      <div class="col-7 mkrpic">
        <img src="../<?php echo $row['mkr_pic'] ?>" class="d-block w-100" alt="...">
      </div>
    </div>
    <div id="quick-menu2" class="hstack">
      <a type="button" class="quick-menu2 " id="partner-btn"  href="marketPlan.php?mkr_id=<?php echo $row['mkr_id']; ?>">
        <i class='bx bxs-map-alt'></i>
        <p> จัดการแผนผังตลาด</p>
      </a>
      <a type="button" class="quick-menu2 " id="merchant-btn"data-bs-toggle="modal" data-bs-target="#edtmkrinfo-modal">
        <i class='bx bxs-message-square-edit'></i>
        <p> จัดการข้อมูลตลาด </p>
      </a>
    </div>

    <!-- Modal -->
    <div id="edtmkrinfo-modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <form method="POST" enctype="multipart/form-data" class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">แก้ไขข้อมูลตลาด</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <td width="30%"><label>ชื่อตลาด</label></td>
                  <td width="70%">
                    <input type="text" class="form-control" name="mkr_name" value="<?php echo $row["mkr_name"] ?>">
                  </td>
                </tr>
                <tr>
                  <td width="30%"><label>ประเภทตลาด</label></td>

                  <td width="70%">
                    <div class="search_select_box">
                      <select class="selectpicker " title="<?php echo $row["market_type"] ?>" name="mkrtype" data-width="100%"  data-size="5">
                        <option value="<?php echo $row['market_type_id']; ?>" selected="selected"><?php echo $row['market_type']; ?></option>
                        <?php while ($row1 = mysqli_fetch_array($result_mkrType)) :; ?>
                          <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                        <?php endwhile; ?>
                      </select>
                    </div>

                  </td>
                </tr>
                <tr>
                  <td width="30%"><label>จังหวัด</label></td>
                  <td width="70%">
                    <div class="search_select_box">
                      <select name="province" id="province" class="selectpicker" data-live-search="true"  title="<?php echo $row["province_name"] ?>" data-width="100%" data-size="5">
                        <option value="<?php echo $row['province_id']; ?>" selected="selected"><?php echo $row['province_name']; ?></option>
                        <?php while ($row1 = mysqli_fetch_array($result_province)) :; ?>
                          <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                        <?php endwhile; ?>
                      </select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td width="30%"><label>สถานที่ตั้ง</label></td>
                  <td width="70%">
                    <input type="text" class="form-control" name="mkr_address" value="<?php echo $row["mkr_address"] ?>">
                  </td>
                </tr>
                <tr>
                  <td width="30%"><label>รายละเอียดตลาด</label></td>
                  <td width="70%">
                    <textarea type="text" class="form-control" name="mkr_descrip"><?php echo $row["mkr_descrip"] ?></textarea>
                  </td>
                </tr>
                <tr>
                  <td width="30%"><label>อีเมล</label></td>
                  <td width="70%">
                    <input type="text" class="form-control" name="email" value="<?php echo $row["email"] ?>">
                  </td>
                </tr>
                <tr>
                  <td width="30%"><label>เบอร์โทรศัพท์</label></td>
                  <td width="70%">
                    <input type="text" class="form-control" name="tel" value="<?php echo $row["tel"] ?>">
                  </td>
                </tr>
                <tr>
                  <td width="30%"><label>รูปภาพตลาด</label></td>
                  <td width="70%">
                    <input type="file" class="form-control" name="ct_logo">
                    <img style="width:300px;margin-top:10px;" src='../<?php echo $row["mkr_pic"] ?>'>
                  </td>
                </tr>
              </table>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
            <button type="submit" class="btn btn-primary" name="bn-submit">บันทึกข้อมูล</button>
          </div>
        </form>
      </div>
</body>

</html>