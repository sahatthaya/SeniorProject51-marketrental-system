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
    <form id="checkoutForm" method="POST" action="../backend/checkout.php" enctype="multipart/form-data" novalidate>
        <div class="form-outer form-group " style="overflow: visible;">
            <h1 id="headline">กรอกข้อมูลเพื่อจองแผงค้า</h1>
            <!-- form--1 -->
            <div id="stepOne" class="row border shadow-sm p-5 mt-3 mb-3 rounded">
                <h4 class="p-0"><span class="text-secondary">ขั้นที่ 1</span> กรอกข้อมูลส่วนตัว</h4>
                <div class="progress p-0 my-2">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width: 33.3%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">1/3 </div>
                </div>
                <input class="form-control col-6" type="text" id="opentype" placeholder="ชื่อ" name="opentype" value="<?php echo $opentype ?>" required hidden>
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
                <input type="button" name="next" class=" btn btn-primary mt-3" value="ถัดไป" onclick="nextbtn(),validateForm()" id="next">

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
                <div class="des_input" style="display:<?php echo $display ?> ;">รอบที่ต้องการจอง</div>
                <select name="daterange" id="daterangerent" class="form-select" style="display:<?php echo $display ?> ;">
                    <?php while ($rowcalen = mysqli_fetch_assoc($qryrentperiod)) : ?>
                        <?php
                        if ($rowcalen['s_id'] == $s_id) {
                            if ($rowcalen['bp_id'] == '') {
                                $disalbed = '';
                            } else {
                                $disalbed = 'hidden disabled';
                            }
                        } else {
                            $disalbed = '';
                        }
                        ?>
                        <option value="<?php echo $rowcalen['id'] ?>" <?php echo $disalbed; ?>>รอบวันที่ <?php echo date("d/m/Y", strtotime($rowcalen['start'])) ?> ถึง <?php echo date("d/m/Y", strtotime($rowcalen['end']))  ?> ( จำนวน <?php echo $rowcalen['day'] ?> วัน )</option>
                    <?php endwhile; ?>
                </select>
                <div class="des_input hstack gap-2">รายละเอียดสินค้าโดยสังเขป
                    <div data-toggle="tooltip" title="เช่น ร้านขายเครื่องดื่มสุขภาพ ทำจากผักและผลไม้" class="mt-1">
                        <i class='bx bx-info-circle'></i>
                    </div>
                </div>
                <input class="form-control col-12" type="text" id="Infomrk" placeholder="กรอกข้อมูลรายละเอียดสินค้าโดยสังเขป" name="mkrDes" required>
                <input type="button" name="previous" class="btn btn-info  mt-3" style="color: white;" value="ย้อนกลับ" onclick="previousbtn()" id="back">
                <input type="button" name="next" class=" btn btn-primary  mt-3" value="ถัดไป" onclick="gotostep3(),<?php echo ($display == 'block' ? 'checkInfo2()' : 'checkInfo1()'); ?>" id="next">
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
                <input class="form-control col-6" id="demoimg" disabled>
                <div class="des_input">ชื่อร้านค้า</div>
                <input class="form-control col-6" id="demostallName" disabled>
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
                <div class="des_input" style="display:<?php echo $display ?> ;">รอบที่เลือกเช่า</div>
                <input class="form-control col-6" type="text" id="daterange" style="display:<?php echo $display ?> ;" disabled>
                <div class="des_input">รายละเอียดสินค้าโดยสังเขป</div>
                <input class="form-control col-6" id="demoInfomrk" disabled>
                <input type="button" name="previous" class="btn btn-info  mt-3" style="color: white;" value="ย้อนกลับ" onclick="backtostep2()" id="back">
                <input type="hidden" name="omiseToken">
                <input type="hidden" name="omiseSource">
                <?php
                @$price = $rowstall['sDept'];
                @$totalcal = $price * 100;
                @$total = $price;
                ?>
                <input name="total" value="<?php echo $totalcal ?>" hidden>
                <button type="submit" id="checkoutButton" class="btn  mt-3" style="background-color: #000374;color:white;">ชำระค่ามัดจำและบันทึกการจอง</button>
            </div>
        </div>
    </form>
    <script type="text/javascript" src="https://cdn.omise.co/omise.js">
    </script>

    <script>
        OmiseCard.configure({
            publicKey: "pkey_test_5tl2v3azqsf7i7u6hlm",
            image:"http://localhost/SeniorProject51/asset/contact/logo-with-bg.png",
            frameLabel:"MarketRental",
            submitLabel:"ชำระเงิน"
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