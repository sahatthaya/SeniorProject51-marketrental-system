<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลการจอง</title>

    <link rel="stylesheet" href="./css/reserve-info.css">

    
</head>

<?php
include "profilebar.php";
include "nav.php";
include "backend/connectDB.php";
include "backend/import-link.php";
require "backend/qry-market-info.php"
?>

<body>

    <h3 class="res-info">ข้อมูลการจองของ :</h3>
    <div class="container">

        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">ชื่อบัญชีผู้ใช้</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">วันที่เริ่มเช่า</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">ชื่อร้านค้า</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">รหัสแผงค้า</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">ระยะเวลาเช่า</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">ประเภทร้านค้า</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">

                    <h4>ข้อมูลการชำระค่าเช่า</h4>
                    <div class="card mb-3 rental-pay-info">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <p>งวดวันที่</p>
                                <p>รวมทั้งสิ้น</p>
                                <p>สถานะ</p>
                            </div>
                            <div class="col-md-6" id="rental-pay-info">
                                <div class="mb-6 row  ">
                                    <button class="col-sm-4 invoice">ดูใบแจ้ง <br> เก็บเงิน</button>
                                    <button class="col-sm-4 receipt ">ดูสลิป <br> จ่ายเงิน</button>
                                </div>
                            </div>
                        </div>
                    </div>






                </div>



                <div class="col-sm-6 ">
                    <h4>กรอกค่าใช้จ่ายประจำงวด</h4>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">งวดวันที่</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">ค่าเช่า (ต่อเดือน)</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">- ค่าน้ำ</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">- ค่าไฟ</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-4 col-form-label">- ค่าขยะ</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <button id="save-data">บันทึกข้อมูล</button>
                    </div>
                </div>

            </div>
        </div>




</body>

</html>