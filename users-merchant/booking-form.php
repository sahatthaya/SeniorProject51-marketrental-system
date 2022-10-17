<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - กรอกข้อมูลเพื่อจองแผงค้า</title>
    <link rel="stylesheet" href="../css/applicant.css" type="text/css">
    <link rel="stylesheet" href="../css/payment.css" type="text/css">


</head>

<?php

include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
include "../backend/qry-booking.php";
$userid = $_SESSION['users_id'];
$sqlqry = "SELECT * FROM users WHERE (users_id = '$userid') ";
$qry = mysqli_query($conn, $sqlqry);
$rowus = mysqli_fetch_array($qry);
?>

<script src="../backend/script.js"></script>

<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item fs-5 "><a href="./all-market.php" class="text-decoration-none">ตลาดทั้งหมด</a></li>
            <li class="breadcrumb-item fs-5 "><a href="market-info.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none"><?php echo $row['mkr_name']; ?></a></li>
            <li class="breadcrumb-item fs-5 "><a href="booking.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none">จองแผงค้า<?php echo $row['mkr_name']; ?></a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">กรอกข้อมูลเพื่อจองแผงค้า <?php echo $row['mkr_name']; ?></li>
        </ol>
    </nav>
    <form id="applyform" method="POST" enctype="multipart/form-data" novalidate>
        <div class="form-outer form-group " style="overflow: visible;">
            <h1 id="headline">กรอกข้อมูลเพื่อจองแผงค้า</h1>

            <!-- form--1 -->
            <div id="stepOne" class="row border shadow-sm p-5 mt-3 mb-3 rounded">
                <h4 class="p-0"><span class="text-secondary">ขั้นที่ 1</span> กรอกข้อมูลส่วนตัว</h4>
                <div class="progress p-0 my-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width: 33.3%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">1/3 </div>
                </div>
                <div class="des_input">ชื่อ</div>
                <input class="form-control col-6" type="text" id="fristname" placeholder="ชื่อ" name="firstName" value="<?php echo $rowus['firstName'] ?>" required autofocus>
                <div class="des_input">นามสกุล</div>
                <input class="form-control col-6" type="text" id="lastname" placeholder="นามสกุล" name="lastName" value="<?php echo $rowus['lastName'] ?>" required>
                <div class="des_input">อีเมล</div>
                <input class="sqr-input col-12 form-control " id="myemail" type="email" placeholder="อีเมล" name="email" value="<?php echo $rowus['email'] ?>" required>
                <div class="des_input">เบอร์โทรศัพท์</div>
                <input name="tel" id="mytel" class="sqr-input col-12 form-control" type="text" placeholder="เบอร์โทรศัพท์" name="name" pattern="[0-9]{10}" title="กรุณากรอกเบอร์โทรศัพท์ หมายเลข (0-9) จำนวน 10 ตัว" value="<?php echo $rowus['tel'] ?>" required>
                <div class="des_input">สำเนาบัตรประจำตัวประชาชน</div>
                <input class="sqr-input col-12 form-control" id="imgInp" type="file" aria-label="อัปโหลดเอกสาร" name="cardIDcpy" required>
                <input type="button" name="next" class=" btn btn-primary action-button" value="ถัดไป" onclick="nextbtn()" id="next">

            </div>
            <!-- form--2 -->
            <div id="stepTwo" class="row border shadow-sm p-5 mt-3 mb-3 rounded">
                <h4 class="p-0"><span class="text-secondary"> ขั้นที่ 2</span> กรอกข้อมูลร้านค้า</h4>
                <div class="progress p-0 my-2 mb-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width:  67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100">2/3 </div>
                </div>
                <div class="des_input">ชื่อร้านค้า</div>
                <input class=" col-12 form-control" id="stallName" type="text" placeholder="ชื่อร้านค้า" name="storeName" required>
                <?php echo  $opening_period ?>
                <div class="des_input hstack gap-2">รายละเอียดสินค้าโดยสังเขป
                    <div data-toggle="tooltip" title="เช่น ร้านขายเครื่องดื่มสุขภาพ ทำจากผักและผลไม้" class="mt-1">
                        <i class='bx bx-info-circle'></i>
                    </div>
                </div>
                <input class="form-control col-12" type="text" id="Infomrk" placeholder="กรอกข้อมูลรายละเอียดสินค้าโดยสังเขป" name="mkrDes" required>
                <input type="button" name="previous" class="btn btn-info action-button" style="color: white;" value="ย้อนกลับ" onclick="previousbtn()" id="back">
                <input type="button" name="next" class=" btn btn-primary action-button" value="ถัดไป" onclick="gotostep3(),checkInfo()" id="next">
            </div>

            <!-- form--3 -->
            <div id="stepThree" class="row border shadow-sm p-5 mt-3 mb-3 rounded">

                <h4 class="p-0"><span class="text-secondary"> ขั้นที่ 3</span> ตรวจสอบและยืนยันข้อมูล</h4>
                <div class="progress p-0 my-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">3/3 </div>
                </div>
                <div class="des_input">ชื่อ</div>
                <input class="form-control col-6" id="demofristname" disabled>
                <div class="des_input">นามสกุล</div>
                <input class="form-control col-6" id="demolastname" disabled>
                <div class="des_input">อีเมล</div>
                <input class="form-control col-6" id="demoemail" disabled>
                <div class="des_input">เบอร์โทรศัพท์</div>
                <input class="form-control col-6" id="demotel" disabled>
                <div class="des_input">สำเนาบัตรประจำตัวประชาชน</div>
                <img class="img-fluid" id="blah" src="#" />
                <div class="des_input">ชื่อร้านค้า</div>
                <input class="form-control col-6" id="demostallName" disabled>
                <div class="des_input">วันที่เลือกเช่า</div>
                <input class="form-control col-6" type="text" id="demorentperiod" disabled>
                <div class="des_input">รายละเอียดสินค้าโดยสังเขป</div>
                <input class="form-control col-6" id="demoInfomrk" disabled>
                <input type="button" name="previous" class="btn btn-info" style="color: white;" value="ย้อนกลับ" onclick="backtostep2()" id="back">
                <input type="button" name="submit-apply" class="btn btn-success submitBtn" id="submit" value="ยืนยันการส่งคำร้อง" data-bs-toggle="modal" data-bs-target="#payment-rent">
            </div>

            <!-- Modal -->
            <div class="modal fade modal-payment" id="payment-rent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <img id="qr-code" src="../asset/qrcode/qr.png" alt="">
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
        </div>
    </form>
</body>
<script>
    $(document).ready(function() {
        $("body").tooltip({
            selector: '[data-toggle=tooltip]',
            placement: 'right'
        });
    });
    $(":input").inputmask();

    $("#mytel").inputmask({
        "mask": "9999999999"
    });

    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }

    // datepicker
    mobiscroll.setOptions({
        locale: mobiscroll.localeTh,
        theme: 'ios',
        themeVariant: 'light'
    });
    const today = new Date()
    const tomorrow = new Date(today)

    mobiscroll.datepicker('#demo-range-selection', {
        controls: ['calendar'],
        display: 'inline',
        rangeSelectMode: 'wizard',
        select: 'range',
        selectSize: 10,
        rangeEndInvalid: true,
        min: tomorrow.setDate(tomorrow.getDate() + 1),
        minRange: <?php $rentrange = $row['min_rent'];
                    if ($rentrange == "1 วัน") {
                        echo $rr = 1;
                    } else {
                        if ($rentrange == "1 สัปดาห์") {
                            echo $rr = 7;
                        } else {
                            if ($rentrange == "1 เดือน") {
                                echo $rr = 28;
                            } else {
                                echo $rr = 365;
                            }
                        }
                    }
                    ?>,
        colors: [<?php while ($q1 = $qrycalendar1->fetch_assoc()) : ?> {
                    start: new Date(<?php
                                    $start1 = strtotime(str_replace('-', '/', $q1['start']));
                                    echo date("Y,m,d", strtotime("-1 month", $start1))
                                    ?>),
                    end: new Date(<?php
                                    $end1 = strtotime(str_replace('-', '/', $q1['end']));
                                    echo date("Y,m,d", strtotime("-1 month", $end1))
                                    ?>),
                    background: '#' + Math.floor(Math.random() * 16777215).toString(16)

                },
            <?php endwhile ?>
        ]

    });

    mobiscroll.datepicker('#datepicker', {
        controls: ['calendar'],
        display: 'inline',
        rangeSelectMode: 'wizard',
        inRangeInvalid: true,
        rangeEndInvalid: false,
        select: 'range',
        selectSize: 10,
        min: tomorrow.setDate(tomorrow.getDate() + 1),
        invalid: [{
            recurring: {
                repeat: 'weekly',
                weekDays: 'SA,SU'
            }
        }]
    });
</script>



</html>