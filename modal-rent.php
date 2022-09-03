<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รหัสแผงค้า</title>
    <link rel="stylesheet" href="./css/banner.css" type="text/css">
    <link rel="stylesheet" href="./css/payment.css" type="text/css">

</head>

<?php

include "profilebar.php";
include "nav.php";
include "backend/1-connectDB.php";
include "backend/1-import-link.php";
?>

<body>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stall-code">
        A001
    </button>

    <!-- Modal -->
    <div class="modal fade" id="stall-code" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">รหัสแผง A001</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5">
                    <div class="hstack gap-3">
                        <p class="des-pay">ขนาดพื้นที่</p>:<input  class="form-control" >
                    </div>
                    <div class="hstack gap-3">
                        <p class="des-pay">ค่าเช่า</p>:<input type="text" class="form-control" >
                    </div>
                    <div class="hstack gap-3">
                        <p class="des-pay">สถานะ</p>:<input type="text" class="form-control" >
                    </div>
                    <div class="hstack gap-3">
                        <p class="des-pay">รวมทั้งสิ้น</p>:<input type="text" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary ">จอง</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#payment-rent">
        ชำระค่ามัดจำ
    </button>

    <!-- Modal -->
    <div class="modal fade" id="payment-rent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">ชำระค่าเช่าแผงค้า</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="content">
                    <div class="pay-rent-info">
                        <div class="hstack gap-3">
                            <p class="des-pay">ชื่อผู้จอง</p>:<input type="date" class="form-control" value="01/08/2022" disabled>
                        </div>
                        <div class="hstack gap-3">
                            <p class="des-pay">รหัสแผงค้า</p>:<input type="text" class="form-control" value="สหัสทยา เทียนมงคล" disabled>
                        </div>
                        <div class="hstack gap-3">
                            <p class="des-pay">ราคามัดจำ</p>:<input type="text" class="form-control" value="A10" disabled>
                        </div>
                        <div class="hstack gap-3">
                            <p class="des-pay">รวมทั้งสิ้น</p>:<input type="text" class="form-control" value="เปิดท้าย มข" disabled>
                        </div>
                    </div>

                    <div class="pay">
                        <h5 class="center">แสกน QRCode เพื่อชำระเงิน</h5>
                        <img id="qr-code" src="./asset/qrcode/qr.png" alt="">
                        <div class="hstack gap-3">
                            <p class="des-pay">ใบเสร็จการโอน</p>:<input type="file" class="form-control">
                        </div>
                        <div class="hstack gap-3">
                            <p class="des-pay">วันที่โอน</p>:<input type="date" class="form-control">
                        </div>
                        <div class="hstack gap-3">
                            <p class="des-pay">เวลาที่โอน</p>:<input type="time" class="form-control">
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger " data-bs-dismiss="modal">ยกเลิก</button>
                    <button id="confirm" type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">เสร็จสิ้น</button>

                </div>
            </div>
        </div>
    </div>
</body>

<script src="./backend/script.js"></script>

</html>