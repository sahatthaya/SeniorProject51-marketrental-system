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
include "../backend/qry-bookingform.php";
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
    <form id="checkoutForm" method="POST" action="../backend/checkout-dept.php" enctype="multipart/form-data" novalidate>
        <div class="form-outer form-group " style="overflow: visible;">
            <h1 id="headline">กรอกข้อมูลเพื่อจองแผงค้า</h1>
            <!-- form--1 -->
            <div id="stepOne" class="row border shadow-sm p-5 mt-3 mb-3 rounded">
                <h4 class="p-0"><span class="text-secondary">ขั้นที่ 1</span> ข้อมูลแผงค้าและเลือกวันที่ต้องการจอง</h4>
                <div class="progress p-0 my-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width:25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">1/4 </div>
                </div>
                <input class="form-control col-6" type="text" id="opentype" placeholder="ชื่อ" name="opentype" value="<?php echo $opentype ?>" required hidden>
                <input class="form-control col-6" type="text" id="opentype" placeholder="ชื่อ" name="stall_id" value="<?php echo $s_id ?>" required hidden>
                <input class="form-control col-6" type="text" id="opentype" placeholder="ชื่อ" name="users_id" value="<?php echo $_SESSION['users_id']; ?>" required hidden>
                <div class="row p-0 m-0">
                    <div class="col-6 ps-0">
                        <div class="des_input">รหัสแผงค้า</div>
                        <input class="form-control col-6" value="<?php echo $rowstall['sID'] ?>" disabled>
                    </div>
                    <div class="col-6 pe-0">
                        <div class="des_input">ขนาดพื้นที่</div>
                        <input class="form-control col-6" value="<?php echo $rowstall['sWidth'] . ' * ' . $rowstall['sHeight'] . ' เมตร' ?>" disabled>
                    </div>
                </div>
                <div class="des_input">ราคาค่าเช่า</div>
                <input class="form-control col-6" value="<?php echo $rowstall['sRent'] . ' ' . $rowstall['sPayRange'] ?>" disabled>
                <div class="des_input">ราคาค่ามัดจำ</div>
                <input class="form-control col-6" value="<?php echo $rowstall['sDept'] . ' บาท' ?>" disabled>

                <div class="des_input ">วันที่ต้องการเช่า <span class="fs-6">(การจองขั้นต่ำ <?php echo $row['min_rent'] ?>)</span></div>
                <div class="w-100 mb-2 p-0">
                    <div id="demo-range-selection" name="daterange"></div>
                    <input id="datestart" name="b_start" hidden />
                    <input id="dateend" name="b_end" hidden />
                </div>
                <input type="button" name="next" class=" btn btn-primary" value="ถัดไป" onclick="nextbtn(),validateForm()" id="next">

            </div>
            <!-- form--2 -->
            <div id="stepTwo" class="row border shadow-sm p-5 mt-3 mb-3 rounded">
                <h4 class="p-0"><span class="text-secondary"> ขั้นที่ 2</span> กรอกข้อมูลส่วนตัวและข้อมูลร้านค้า</h4>
                <div class="progress p-0 my-2 mb-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width:  50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">2/4 </div>
                </div>
                <h5 class="p-0 mt-4 fw-semibold">ข้อมูลส่วนตัว</h5>
                <hr class="m-1">
                <div class="des_input">ชื่อ</div>
                <input class="form-control col-6" type="text" id="fristname" placeholder="ชื่อ" name="firstName" value="<?php echo $rowus['firstName'] ?>" required autofocus>
                <div class="des_input">นามสกุล</div>
                <input class="form-control col-6" type="text" id="lastname" placeholder="นามสกุล" name="lastName" value="<?php echo $rowus['lastName'] ?>" required>
                <div class="des_input">อีเมล</div>
                <input class="sqr-input col-12 form-control " id="myemail" type="email" placeholder="อีเมล" name="email" value="<?php echo $rowus['email'] ?>" required>
                <div class="des_input">เบอร์โทรศัพท์</div>
                <input name="tel" id="mytel" class="sqr-input col-12 form-control" type="text" placeholder="เบอร์โทรศัพท์" name="tel" pattern="[0-9]{10}" title="กรุณากรอกเบอร์โทรศัพท์ หมายเลข (0-9) จำนวน 10 ตัว" value="<?php echo $rowus['tel'] ?>" required>
                <div class="des_input">สำเนาบัตรประจำตัวประชาชน</div>
                <input class="sqr-input col-12 form-control" id="imgInp" type="file" aria-label="อัปโหลดเอกสาร" name="cardIDcpy" required>
                <h5 class="p-0 mt-4 fw-semibold">ข้อมูลร้านค้า</h5>
                <hr class="m-1">
                <div class="des_input">ชื่อร้านค้า</div>
                <input class=" col-12 form-control" id="stallName" type="text" placeholder="ชื่อร้านค้า" name="storeName" required>

                <div class="des_input hstack gap-2">รายละเอียดสินค้าโดยสังเขป
                    <div data-toggle="tooltip" title="เช่น ร้านขายเครื่องดื่มสุขภาพ ทำจากผักและผลไม้" class="mt-1">
                        <i class='bx bx-info-circle'></i>
                    </div>
                </div>
                <div class="form-floating p-0">
                    <textarea class="form-control mb-2" cols="30" rows="10" id="Infomrk" name="shopdes" style="padding-top:5px !important ; resize: none;" required></textarea>
                </div>
                <hr class="m-0 my-3">
                <input type="button" name="previous" class="btn btn-info" style="color: white;margin-top:0 !important;" value="ย้อนกลับ" onclick="previousbtn()" id="back">
                <input type="button" name="next" class=" btn btn-primary  mt-3" value="ถัดไป" onclick="gotostep3(),<?php echo ($display == 'block' ? 'checkInfo2()' : 'checkInfo1()'); ?>" id="next">
            </div>

            <!-- form--3 -->
            <div id="stepThree" class="row border shadow-sm p-5 mt-3 mb-3 rounded">

                <h4 class="p-0"><span class="text-secondary"> ขั้นที่ 3</span> ตรวจสอบและยืนยันข้อมูล</h4>
                <div class="progress p-0 my-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width: 75%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100">3/4 </div>
                </div>
                <h5 class="p-0 mt-4 fw-semibold">ข้อมูลการจอง</h5>
                <hr class="m-1">
                <div class="row p-0 m-0">
                    <div class="col-6 ps-0">
                        <div class="des_input">รหัสแผงค้า</div>
                        <input class="form-control col-6" value="<?php echo $rowstall['sID'] ?>" disabled>
                    </div>
                    <div class="col-6 pe-0">
                        <div class="des_input">ขนาดพื้นที่</div>
                        <input class="form-control col-6" value="<?php echo $rowstall['sWidth'] . ' * ' . $rowstall['sHeight'] . ' เมตร' ?>" disabled>
                    </div>
                </div>
                <div class="des_input">ราคาค่าเช่า</div>
                <input class="form-control col-6" value="<?php echo $rowstall['sRent'] . ' ' . $rowstall['sPayRange'] ?>" disabled>
                <div class="des_input">ราคาค่ามัดจำ</div>
                <input class="form-control col-6" value="<?php echo $rowstall['sDept'] . ' บาท' ?>" disabled>
                <div class="row px-0 mx-0">
                    <div class="col-6 ps-0">
                        <div class="des_input" style="display:<?php echo ($display == 'block' ? 'none' : 'block'); ?>;">วันที่เริ่มเช่า</div>
                        <input class="form-control col-6" type="text" id="demodatestart" style="display:<?php echo ($display == 'block' ? 'none' : 'block'); ?>;" disabled>
                    </div>
                    <div class="col-6 pe-0">
                        <div class="des_input" style="display:<?php echo ($display == 'block' ? 'none' : 'block'); ?>;">วันที่สิ้นสุดการเช่า</div>
                        <input class="form-control col-6" type="text" id="demodateend" style="display:<?php echo ($display == 'block' ? 'none' : 'block'); ?>;" disabled>
                    </div>
                </div>
                <h5 class="p-0 mt-4 fw-semibold">ข้อมูลส่วนตัว</h5>
                <hr class="m-1">
                <div class="row p-0 m-0">
                    <div class="col-6 ps-0">
                        <div class="des_input">ชื่อ</div>
                        <input class="form-control col-6" id="demofristname" disabled>
                    </div>
                    <div class="col-6 mw-100 pe-0">
                        <div class="des_input">นามสกุล</div>
                        <input class="form-control col-6" id="demolastname" disabled>
                    </div>
                </div>
                <div class="row p-0 m-0">
                    <div class="col-6 ps-0">
                        <div class="des_input">อีเมล</div>
                        <input class="form-control col-6" id="demoemail" disabled>
                    </div>
                    <div class="col-6 pe-0">
                        <div class="des_input">เบอร์โทรศัพท์</div>
                        <input class="form-control col-6" id="demotel" disabled>
                    </div>
                </div>
                <div class="des_input">สำเนาบัตรประจำตัวประชาชน</div>
                <input class="form-control col-6" id="demoimg" disabled>

                <h5 class="p-0 mt-4 fw-semibold">ข้อมูลร้านค้า</h5>
                <hr class="m-1">

                <div class="des_input">ชื่อร้านค้า</div>
                <input class="form-control col-6" id="demostallName" disabled>
                <div class="des_input">รายละเอียดสินค้าโดยสังเขป</div>
                <div class="form-floating p-0">
                    <textarea class="form-control" cols="30" rows="10" id="demoInfomrk" style="padding-top:5px !important ; resize: none;" disabled></textarea>
                </div>

                <hr class="m-0 my-2">
                <input type="button" name="previous" class="btn btn-info mt-3" style="color: white;" value="ย้อนกลับ" onclick="backtostep2()" id="back">
                <input type="button" name="next" class=" btn btn-primary  mt-3" value="ถัดไป" onclick="gotostep4()" id="next">
            </div>
            <!-- form4 -->
            <div id="stepFour" class="row border shadow-sm p-5 mt-3 mb-3 rounded">
                <h4 class="p-0"><span class="text-secondary"> ขั้นที่ 4</span> ชำระค่ามัดจำ</h4>
                <div class="progress p-0 my-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">4/4 </div>
                </div>
                <div class="des_input">ชำระไปยัง</div>
                <input class="form-control col-6" value="<?php echo $row['mkr_name']; ?>" disabled>
                <div class="des_input">ค่ามัดจำ</div>
                <input class="form-control col-6" value="<?php echo $rowstall['sDept'] . ' บาท' ?>" disabled>
                <?php
                @$fee = (4.07 / 100) * $rowstall['sDept'];
                @$price = $rowstall['sDept'] + $fee;
                ?>
                <div class="des_input">ค่าธรรมเนียม <span class="text-secondary" style="font-size: 15px;">(4.07%)</span></div>
                <input class="form-control col-6" value="<?php echo $fee ?>  บาท" disabled>
                <div class="des_input">รวมทั้งสิ้น</div>
                <input class="form-control col-6" value="<?php echo $price . ' บาท' ?>" disabled>
                <div class="text-danger">*หมายเหตุ* <br /> 1. การจองจะสำเร็จเมื่อการชำระเงินเสร็จสิ้น โดยค่ามัดจำจะถูกคืนให้แก่ผู้จองโดยจะหักกับค่าเช่าในงวดแรก <br>2. หากทำการยกเลิกการจองจะไม่ได้รับค่ามัดจำคืน <br> 3. คุณจะไม่สามารถยกเลิกการจองได้เมื่อถึง 7 วันก่อนวันเริ่มเช่า</div>
                <input type="button" name="previous" class="btn btn-info mt-3" style="color: white;" value="ย้อนกลับ" onclick="backtostep3()" id="back">
                <input type="hidden" name="omiseToken">
                <input type="hidden" name="omiseSource">
                <input type="hidden" name="dept_pay" value="<?php echo $rowstall['sDept'] ?>">
                <?php
                @$totalcal = $price * 100;
                @$total = $price;
                ?>
                <input name="total" value="<?php echo $totalcal ?>" hidden>
                <input type="submit" id="checkoutButton" class="btn btn-info mt-3" style="background-color: #000374;color:white;" value="ชำระเงิน" />
            </div>
        </div>
    </form>
    <script type="text/javascript" src="https://cdn.omise.co/omise.js">
    </script>

    <script>
        OmiseCard.configure({
            publicKey: "pkey_test_5tl2v3azqsf7i7u6hlm",
            image: "http://localhost/SeniorProject51/asset/contact/logo-with-bg.png",
            frameLabel: "MarketRental",
            submitLabel: "ชำระเงิน"
        });

        var button = document.querySelector("#checkoutButton");
        var form = document.querySelector("#checkoutForm");

        button.addEventListener("click", (event) => {
            event.preventDefault();
            OmiseCard.open({
                amount: <?php echo $totalcal ?>,
                currency: "THB",
                defaultPaymentMethod: "credit_card",
                onCreateTokenSuccess: (nonce) => {
                    if (nonce.startsWith("tokn_")) {
                        form.omiseToken.value = nonce;
                    } else {
                        form.omiseSource.value = nonce;
                    };
                    form.submit();
                }
            });
        });
    </script>
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

    // datepicker
    mobiscroll.setOptions({
        locale: mobiscroll.localeTh,
        theme: 'ios',
        themeVariant: 'light'
    });
    // ประกาษตัวแปรและธีมสี
    const today = new Date()
    const tomorrow = new Date(today)
    var colorset = [
        '#abdee6',
        '#cbaacb',
        '#ffffb5',
        '#ffccb6',
        '#f3b0c3',
        '#c6dbda',
        '#fee1e8',
        '#fed7c3',
        '#f6eac2',
        '#ecd5e3',
        'ff968a'
    ];
    // จองตลาดเปิดปกติ
    mobiscroll.datepicker('#demo-range-selection', {
        controls: ['calendar'],
        display: 'inline',
        rangeSelectMode: 'wizard',
        select: 'range',
        selectSize: 10,
        showOuterDays: false,
        startInput: '#datestart',
        endInput: '#dateend',
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
        invalid: [<?php while ($q1 = $qryinvalid->fetch_assoc()) : ?> {
                    start: new Date(<?php
                                    $start1 = strtotime(str_replace('-', '/', $q1['b_start']));
                                    echo date("Y,m,d", strtotime("-1 month", $start1))
                                    ?>),
                    end: new Date(<?php
                                    $end1 = strtotime(str_replace('-', '/', $q1['b_end']));
                                    echo date("Y,m,d", strtotime("-1 month", $end1))
                                    ?>),

                },
            <?php endwhile ?>
        ]

    });
</script>



</html>