<?php
include "profilebar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ส่งคำร้องขอเป็นพาร์ทเนอร์</title>
    <link rel="stylesheet" href="../css/applicant.css" type="text/css">
</head>
<script type="text/javascript">
    function success() {
        Swal.fire({
            title: 'ส่งข้อมูลสำเร็จ',
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
include "nav.php";
include "../backend/connectDB.php";
include "../backend/import-link.php";

$userid = $_SESSION['users_id'];
$sqlqry = "SELECT * FROM users WHERE (users_id = '$userid') ";
$qry = mysqli_query($conn, $sqlqry);
$row = mysqli_fetch_array($qry);

$query_mkrType = "SELECT * FROM market_type ORDER BY market_type_id";
$result_mkrType = mysqli_query($conn, $query_mkrType);
$query_province = "SELECT * FROM province";
$result_province = mysqli_query($conn, $query_province);

require "../backend/add-applicant.php"
?>

<body>
    <div class="applybox">
        <h1 id="headline">กรอกข้อมูลเพื่อสร้างคำร้องขอเป็นพาร์ทเนอร์</h1>
        <form id="applyform" method="POST" enctype="multipart/form-data" novalidate>
            <!-- แถบโปรเกสฟอร์ม -->
            <section class="step-wizard">
                <ul class="step-wizard-list">
                    <li id="Onestep" class="step-wizard-item">
                        <span class="progress-count">1</span>
                        <span class="progress-label">ข้อมูลส่วนตัว</span>
                    </li>
                    <li id="Twostep" class="step-wizard-item  current-item">
                        <span class="progress-count">2</span>
                        <span class="progress-label">ข้อมูลตลาด</span>
                    </li>
                </ul>
            </section>

            <div class="form-outer form-group" style="overflow: visible;">
                <!-- form--1 -->
                <div id="stepOne" class="row">
                    <div class="des_input">ชื่อ</div>
                    <input class="form-control col-6" type="text" placeholder="ชื่อ" name="firstName" pattern="[^0-9]+" required autofocus>
                    <div class="des_input">นามสกุล</div>
                    <input class="form-control col-6" type="text" placeholder="นามสกุล" name="lastName" pattern="[^0-9]+"  required>
                    <div class="des_input">อีเมล</div>
                    <input class="sqr-input col-12 form-control " type="email" placeholder="อีเมล" name="email" required>
                    <div class="des_input">เบอร์โทรศัพท์</div>
                    <input name="tel" class="sqr-input col-12 form-control" type="text" placeholder="เบอร์โทรศัพท์" name="name" pattern="[0-9]{10}" title="กรุณากรอกเบอร์โทรศัพท์ หมายเลข (0-9) จำนวน 10 ตัว" required>
                    <div class="des_input">สำเนาบัตรประจำตัวประชาชน</div>
                    <input class="sqr-input col-12 form-control" type="file" aria-label="อัปโหลดเอกสาร" name="cardIDcpy" required>
                    <input type="button" name="next" class=" btn btn-primary action-button" value="ถัดไป" onclick="nextbtn()" id="next">
                </div>
                <!-- form--2 -->
                <div id="stepTwo" class="row">
                    <div class="des_input">ชื่อตลาด</div>
                    <input class=" col-12 form-control" type="text" placeholder="ชื่อตลาด" name="mkrName" required>
                    <div class="row" id="dropdown">
                        <div class="col-6" id="mkrtype">
                            <div class="des_input">ประเภทตลาด</div>
                            <div class="search_select_box">
                                <select class="selectpicker " title="เลือกประเภท" name="mkrtype" data-width="100%" data-size="5" required>
                                    <?php while ($row1 = mysqli_fetch_array($result_mkrType)) :; ?>
                                        <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6" id="provincebox">
                            <div class="des_input">จังหวัด</div>
                            <div class="search_select_box">
                                <select name="province" id="province" class="selectpicker" data-live-search="true" title="เลือกจังหวัด" data-width="100%" data-size="5" required>
                                    <?php while ($row1 = mysqli_fetch_array($result_province)) :; ?>
                                        <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="des_input">สถานที่ตั้ง</div>
                    <input class="form-control col-12" type="text" placeholder="เช่น บ้านเลขที่ ถนน ตำบล อำเภอ จังหวัด" name="mkrAddress" required>
                    <div class="des_input">รายละเอียดตลาดโดยสังเขป</div>
                    <input class="form-control col-12" type="text" placeholder="กรอกข้อมูลตลาดโดยสังเขป" name="mkrDes" required>
                    <div class="des_input">อัปโหลดเอกสารหรือรูปภาพเพื่อยืนยันตลาด</div>
                    <input class="sqr-input col-12 form-control" type="file" placeholder="เช่น ตลาดขายปลีก ใจกลางเมือง ทำเลดี ติดถนนใหญ่" name="mkrFile" required>
                    <input type="button" name="previous" class="btn btn-primary action-button" value="ย้อนกลับ" onclick="previousbtn()" id="back">
                    <input type="submit" name="submit-apply" class="btn btn-success submitBtn" id="submit" value="ยืนยันการส่งคำร้อง">
                </div>
            </div>
        </form>
    </div>
</body>
<script src="../backend/script.js"></script>

</html>