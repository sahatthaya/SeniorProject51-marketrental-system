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

<?php
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";

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
        <h1 id="headline">กรอกข้อมูลเพื่อทำการจองแผงค้า</h1>
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
                        <span class="progress-label">ข้อมูลร้านค้า</span>
                    </li>
                </ul>
            </section>

            <div class="form-outer form-group" style="overflow: visible;">
                <!-- form--1 -->
                <div id="stepOne" class="row">
                    <div class="des_input">ชื่อ</div>
                    <input class="form-control col-6" type="text" placeholder="ชื่อ" name="firstName" pattern="[^0-9]+" required autofocus>
                    <div class="des_input">นามสกุล</div>
                    <input class="form-control col-6" type="text" placeholder="นามสกุล" name="lastName" pattern="[^0-9]+" required>
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
                    <div class="des_input">ชื่อร้านค้า</div>
                    <input class=" col-12 form-control" type="text" placeholder="ชื่อร้านค้า" name="mkrName" required>
                    <div class="row pe-0 me-0">
                        <div class="col-6 p-0">
                            <div class="des_input">วันที่ต้องการเริ่มเช่า</div>
                            <input class=" col-12 form-control" type="date" placeholder="ชื่อตลาด" name="mkrName" required>
                        </div>
                        <div class="col-6">
                            <div class="des_input">วันที่ต้องการสิ้นสุดการเช่า</div>
                            <input class=" col-12 form-control" type="date" placeholder="ชื่อตลาด" name="mkrName" required>
                        </div>
                    </div>
                    <div class="des_input">ประเภทร้านค้า</div>
                    <select class="form-select mb-3" aria-label="Default select example">
                        <option selected>ร้านของใช้</option>
                        <option value="1">ร้านเสื้อผ้า</option>
                        <option value="2">ร้านอาหาร</option>
                        <option value="3">ร้านน้ำ</option>
                    </select>
                    <input type="button" name="previous" class="btn btn-primary action-button" value="ย้อนกลับ" onclick="previousbtn()" id="back">
                    <input type="submit" name="submit-apply" class="btn btn-success submitBtn" id="submit" value="ยืนยันการจอง">
                </div>
            </div>
        </form>
    </div>
</body>
<script src="../backend/script.js"></script>

</html>