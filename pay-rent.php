<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ชำระค่าเช่าแผงค้า</title>

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
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        ชำระค่าเช่าแผงค้า
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" >

                <h2 style="text-align: center;">ชำระค่าเช่าแผงค้า </h2>
                <h3 style="text-align: center;">งวดประจำวันที่</h3>
                <div class="pay-rent-info">
                    <p>ผู้เช่า</p>
                    <p>รหัสแผงค้า</p>
                    <p>ตลาด</p>
                    <p>ราคาแผง/เดือน</p>
                    <p>ค่าใช้จ่ายอื่นๆ</p>
                    <p>รวมทั้งสิ้น</p>
                </div>

   
                <div class="row" >
                    <div class="col-sm-8">
                        <div class="mb-8 ">
                            <div class="row file-rent" >
                                <input id="file-slip" type="file">
                                <div class="col-md-6">
                                    <input type="date" >
                                </div>
                                <div class="col-md-6"  >
                                    <input type="time">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 ">
                        <img id="qr-code" src="./asset/img_market/202207191266434879.png"  alt="">
                    </div>
                </div>
                <button id="confirm" type="button" class="btn btn-primary" >เสร็จสิ้น</button>
            </div>
        </div>
    </div>


    <!-- 
    <h2 style="text-align: center;">ชำระค่าเช่าแผงค้า </h2>
    <h3 style="text-align: center;">งวดประจำวันที่</h3>
    <div class="pay-rent-info">
        <p>ผู้เช่า</p>
        <p>รหัสแผงค้า</p>
        <p>ตลาด</p>
        <p>ราคาแผง/เดือน</p>
        <p>ค่าใช้จ่ายอื่นๆ</p>
        <p>รวมทั้งสิ้น</p>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card mb-3 rental-pay-info">
                <div class="row g-0">
                    <input type="file">
                    <div class="col-md-6">
                       <input type="date">
                    </div>
                    <div class="col-md-6" id="rental-pay-info">
                       <input type="date">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 ">
            <img src="./asset/img_market/202207191266434879.png" alt="">
        </div>

    </div> -->









</body>

</html>