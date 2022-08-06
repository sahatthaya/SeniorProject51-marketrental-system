<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลการจอง</title>

    <link rel="stylesheet" href="../css/rentEdit.css">


</head>

<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
require "../backend/qry-market-info.php"
?>

<body>
    <h1>แก้ไขข้อมูลการจอง</h1>


    <div class="rent-info">
        <h4>ข้อมูลการจองของ : A01 สหัสทยา เทียนมงคล</h4>
        <div class="info">
            <div class="info-part">

                <div class="hstack gap-3">
                    <p class="des-pay">ชื่อบัญชีผู้ใช้</p>:<input type="text" class="form-control" value="สหัสทยา เทียนมงคล">
                </div>
                <div class="hstack gap-3">
                    <p class="des-pay">วันที่เริ่มเช่า</p>:<input type="date" class="form-control" value="10/08/2022">
                </div>
                <div class="hstack gap-3">
                    <p class="des-pay">ชื่อร้านค้า</p>:<input type="text" class="form-control" value="สหัสทยาผลไม้ปั่น">
                </div>
            </div>
            <div class="info-part">
                <div class="hstack gap-3">
                    <p class="des-pay">รหัสแผงค้า</p>:<input type="text" class="form-control" value="A01">
                </div>
                <div class="hstack gap-3">
                    <p class="des-pay">ระยะเวลาเช่า</p>:<input type="text" class="form-control" value="2 เดือน">
                </div>
                <div class="hstack gap-3">
                    <p class="des-pay">ประเภทร้านค้า</p>:<input type="text" class="form-control" value="น้ำปั่น">
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="info">
        <div class="edit-info">
            <h4>ข้อมูลการชำระค่าเช่า</h4>
            <div class="sub-part">
                <div>
                    <div class="hstack gap-3">
                        <p class="des-pay">งวดวันที่</p>:<input type="date" class="form-control" value="06/08/2022">
                    </div>
                    <div class="hstack gap-3">
                        <p class="des-pay">รวมทั้งสิ้น</p>:<input type="text" class="form-control" value="1000 บาท">
                    </div>
                    <div class="hstack gap-3">
                        <p class="des-pay">สถานะ</p>:<input type="text" class="form-control" value="จ่ายแล้ว" disabled>
                    </div>
                </div>
                <div class="button-info">
                    <button class=" invoice">ใบแจ้งเก็บเงิน</button>
                    <button class=" receipt ">ใบเสร็จโอนเงิน</button>
                </div>
            </div>
            <hr>
            <div class="sub-part">
                <div>
                    <div class="hstack gap-3">
                        <p class="des-pay">งวดวันที่</p>:<input type="date" class="form-control" value="06/08/2022">
                    </div>
                    <div class="hstack gap-3">
                        <p class="des-pay">รวมทั้งสิ้น</p>:<input type="text" class="form-control" value="1000 บาท">
                    </div>
                    <div class="hstack gap-3">
                        <p class="des-pay">สถานะ</p>:<input type="text" class="form-control" value="จ่ายแล้ว" disabled>
                    </div>
                </div>
                <div class="button-info">
                    <button class=" invoice">ใบแจ้งเก็บเงิน</button>
                    <button class=" receipt ">ใบเสร็จโอนเงิน</button>
                </div>
            </div>
            <hr>
        </div>
        <div class="edit-info">
            <h4>กรอกค่าใช้จ่ายประจำงวด</h4>
            <div>
                <div class="hstack gap-3">
                    <p class="des-pay">งวดวันที่</p>:<input type="date" class="form-control" value="06/08/2022">
                </div>
                <div class="hstack gap-3">
                    <p class="des-pay">ค่าเช่า</p>:<input type="text" class="form-control">
                </div>
                <div class="hstack gap-3">
                    <p class="des-pay">ค่าน้ำ</p>:<input type="text" class="form-control">
                </div>
                <div class="hstack gap-3">
                    <p class="des-pay">ค่าน้ำ</p>:<input type="text" class="form-control">
                </div>
                <div class="hstack gap-3">
                    <p class="des-pay">ค่าไฟ</p>:<input type="text" class="form-control">
                </div>
                <div class="hstack gap-3">
                    <p class="des-pay">ค่าขยะ</p>:<input type="text" class="form-control">
                </div>
            </div>
            <button id="save-data">บันทึกข้อมูล</button>

        </div>


    </div>

    </div>




</body>

</html>