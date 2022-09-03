<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มจองแผงค้า</title>
    <link rel="stylesheet" href="./css/applicant.css" type="text/css">

</head>

<?php

include "profilebar.php";
include "nav.php";
include "backend/1-connectDB.php";
include "backend/1-import-link.php";
?>

<body>

    <form id="applyform" method="POST" enctype="multipart/form-data" novalidate>
        <div class="form-outer form-group " style="overflow: visible;">
            <h1 id="headline">กรอกข้อมูลเพื่อส่งคำร้องขอเพิ่มตลาดใหม่</h1>

            <!-- form--1 -->
            <div id="stepOne" class="row border shadow-sm p-5 mt-3 mb-3 rounded">
                <h4 class="p-0"><span class="text-secondary">ขั้นที่ 1</span> กรอกข้อมูลส่วนตัว</h4>
                <div class="progress p-0 my-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width: 33.3%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">1/3 </div>
                </div>
                <div class="des_input">ชื่อ</div>
                <input class="form-control col-6" type="text" placeholder="ชื่อ" name="firstName" pattern="[^0-9]+" required autofocus>
                <div class="des_input">นามสกุล</div>
                <input class="form-control col-6" type="text" placeholder="นามสกุล" name="lastName" pattern="[^0-9]+" required>
                <div class="des_input">อีเมล</div>
                <input class="sqr-input col-12 form-control " type="email" placeholder="อีเมล" name="email" required>
                <div class="des_input">เบอร์โทรศัพท์</div>
                <input name="tel" id="tel" class="sqr-input col-12 form-control" type="text" placeholder="เบอร์โทรศัพท์" name="name" pattern="[0-9]{10}" title="กรุณากรอกเบอร์โทรศัพท์ หมายเลข (0-9) จำนวน 10 ตัว" required>
                <div class="des_input">สำเนาบัตรประจำตัวประชาชน</div>
                <input class="sqr-input col-12 form-control" type="file" aria-label="อัปโหลดเอกสาร" name="cardIDcpy" required>
                <input type="button" name="next" class=" btn btn-primary action-button" value="ถัดไป" onclick="nextbtn()" id="next">
            </div>
            <!-- form--2 -->
            <div id="stepTwo" class="row border shadow-sm p-5 mt-3 mb-3 rounded">

                <h4 class="p-0"><span class="text-secondary"> ขั้นที่ 2</span> กรอกข้อมูลตลาด</h4>
                <div class="progress p-0 my-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width:  67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100">2/3 </div>
                </div>
                <div class="des_input">ชื่อร้านค้า</div>
                <input class=" col-12 form-control" type="text" placeholder="ชื่อร้านค้า" name="storeName" required>
                <div class="des_input">ระยะเวลาการเช่า</div>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <div class="des_input">ประเภทสินค้า</div>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>

               

                <div class="des_input">วันที่เริ่มเช่า</div>
                <input class=" col-12 form-control" type="date" placeholder="ชื่อร้านค้า" name="storeName" required>


                <div class="des_input hstack gap-2">รายละเอียดตลาดโดยสังเขป
                    <div data-toggle="tooltip" title="เช่น ตลาดค้าส่ง ทำเลดี ติดถนนใหญ่ใกล้สี่แยกไฟแดง" class="mt-1">
                        <i class='bx bx-info-circle'></i>
                    </div>
                </div>
                <input class="form-control col-12" type="text" placeholder="กรอกข้อมูลตลาดโดยสังเขป" name="mkrDes" required>
                <input type="button" name="previous" class="btn btn-primary action-button" value="ย้อนกลับ" onclick="previousbtn()" id="back">
                <input type="button" name="next" class=" btn btn-primary action-button" value="ถัดไป" onclick="gotostep3()" id="next">

            </div>

            <!-- form--3 -->
            <div id="stepThree" class="row border shadow-sm p-5 mt-3 mb-3 rounded">

                <h4 class="p-0"><span class="text-secondary"> ขั้นที่ 3</span> กรอกข้อมูลตลาด</h4>
                <div class="progress p-0 my-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">3/3 </div>
                </div>



                <input type="button" name="previous" class="btn btn-primary action-button" value="ย้อนกลับ" onclick="backtostep2()" id="back">
                <input type="submit" name="submit-apply" class="btn btn-success submitBtn" id="submit" value="ยืนยันการส่งคำร้อง">
            </div>

        </div>
    </form>
    <script src="../backend/script.js"></script>
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
    $("#zip-code").inputmask({
        "mask": "99999"
    });
</script>

<script src="./backend/script.js"></script>

</html>