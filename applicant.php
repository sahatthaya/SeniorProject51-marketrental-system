<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ส่งคำร้องขอเป็นพาร์ทเนอร์</title>
    <link rel="stylesheet" href="./css/applicant.css" type="text/css">
</head>
<script type="text/javascript">
    function nologin() {
        Swal.fire({
            title: 'คุณยังไม่ได้เข้าสู่ระบบ',
            text: "กรุณาเข้าสู่ระบบเพื่อทำการส่งคำร้อง",
            icon: 'warning',
            showConfirmButton: false,
            timer: 4000
        })
    }
</script>
<?php

include "profilebar.php";
include "nav.php";
include "backend/connectDB.php";
include "backend/import-link.php";
?>

<body onload="nologin()">
    <div class="applybox">
        <h1 id="headline">กรอกข้อมูลเพื่อสร้างคำร้องขอเป็นพาร์ทเนอร์</h1>
        <form id="applyform" method="POST" enctype="multipart/form-data">
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

            <div class="form-outer" style="overflow: visible;">
                <!-- form--1 -->
                <div id="stepOne" class="row">
                    <div class="des_input">ชื่อ-นามสกุล</div>
                    <input class="form-control col-6" type="text" placeholder="ชื่อ" name="firstName" required disabled>
                    <input class="form-control col-6" type="text" placeholder="นามสกุล" name="lastName" required disabled>

                    <div class="des_input">อีเมล</div>
                    <input class="sqr-input col-12 form-control" type="email" placeholder="อีเมล" name="email" required disabled>
                    <div class="des_input">เบอร์โทรศัพท์</div>
                    <input name="tel" class="sqr-input col-12 form-control" type="text" placeholder="เบอร์โทรศัพท์" name="name" pattern="[0-9]{10}" title="กรุณากรอกเบอร์โทรศัพท์ หมายเลข (0-9) จำนวน 10 ตัว" required disabled>
                    <div class="des_input">สำเนาบัตรประจำตัวประชาชน</div>
                    <input class="sqr-input col-12 form-control" type="file" aria-label="อัปโหลดเอกสาร" name="cardIDcpy" required disabled>
                    <input type="button" name="next" class=" btn btn-primary action-button" value="ถัดไป" onclick="nologin()" id="next">
                </div>
            </div>
        </form>
    </div>
</body>
<script src="./backend/script.js"></script>

</html>