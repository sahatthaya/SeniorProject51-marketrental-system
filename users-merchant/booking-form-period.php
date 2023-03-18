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

include "../backend/qry-bookingform.php";

$userid = $_SESSION['users_id'];

$sqlqry = "SELECT * FROM users WHERE (users_id = '$userid') ";

$qry = mysqli_query($conn, $sqlqry);

$rowus = mysqli_fetch_array($qry);

?>



<script src="../backend/script.js"></script>



<body onload="checkperiod()">

    <nav aria-label="breadcrumb mb-3">

        <ol class="breadcrumb">

            <li class="breadcrumb-item fs-5 "><a href="./all-market.php" class="text-decoration-none">ตลาดทั้งหมด</a></li>

            <li class="breadcrumb-item fs-5 "><a href="market-info.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none"><?php echo $row['mkr_name']; ?></a></li>

            <li class="breadcrumb-item fs-5 "><a href="booking-period.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none">จองแผงค้า<?php echo $row['mkr_name']; ?></a></li>

            <li class="breadcrumb-item active fs-5" aria-current="page">กรอกข้อมูลเพื่อจองแผงค้า <?php echo $row['mkr_name']; ?></li>

        </ol>

    </nav>

    <form id="checkoutForm" method="POST" action="../backend/checkout-dept-period.php" enctype="multipart/form-data" class="was-validated">
        <input class="form-control col-6" type="text" id="opentype" placeholder="ชื่อ" name="market_name" value="<?php echo  $row['mkr_name']; ?>" required hidden>
        <input class="form-control col-6" type="text" id="opentype" placeholder="ชื่อ" name="usersmkr_id" value="<?php echo  $row['users_id']; ?>" required hidden>
        <div class="form-outer form-group " style="overflow: visible;">

            <h1 id="headline">กรอกข้อมูลเพื่อจองแผงค้า</h1>

            <!-- form--1 -->

            <div id="stepOne" class="row border shadow-sm p-5 mt-3 mb-3 rounded">

                <h4 class="p-0"><span class="text-secondary">ขั้นที่ 1</span> ข้อมูลแผงค้าและเลือกวันที่ต้องการจอง</h4>

                <div class="progress p-0 my-2">

                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width:25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">1/4 </div>

                </div>

                <input class="form-control col-6" type="text" id="opentype" placeholder="ชื่อ" name="opentype" value="<?php echo $opentype ?>" required hidden>



                <div class="row p-0 m-0">

                    <div class="col-6 ps-0">

                        <div class="des_input">รหัสแผงค้า</div>

                        <input class="form-control col-6" name="stall_id" value="<?php echo $rowstall['sKey'] ?>" hidden>

                        <input class="form-control col-6" type="text" id="opentype" placeholder="ชื่อ" name="users_id" value="<?php echo $_SESSION['users_id']; ?>" required hidden>

                        <input class="form-control col-6" value="<?php echo $rowstall['sID'] ?>" disabled>

                    </div>

                    <div class="col-6 pe-0">

                        <div class="des_input">ขนาดพื้นที่</div>

                        <input class="form-control col-6" value="<?php echo $rowstall['sWidth'] . ' * ' . $rowstall['sHeight'] . ' เมตร' ?>" disabled>

                    </div>

                </div>

                <div class="des_input">ราคาค่าเช่า</div>

                <input class="form-control col-6" value="<?php echo number_format($rowstall['sRent']) . ' ' . $rowstall['sPayRange'] ?>" disabled>

                <!-- <div class="des_input">ราคาค่ามัดจำ</div>

                <input class="form-control col-6" value="<?php echo number_format($rowstall['sDept']) . ' บาท' ?>" disabled> -->



                <div class="des_input" style="display:<?php echo $display ?> ;">รอบที่ต้องการจอง</div>

                <?php

                $skey = $rowstall['sKey'];

                $rsp = mysqli_query($conn, "SELECT * FROM booking_period JOIN stall ON (stall.sKey = booking_period.stall_id) JOIN opening_period ON (opening_period.id = booking_period.op_id) WHERE (`stall_id` = '$skey' AND '$curr_date' <= `start` )");

                $numRowscalen = mysqli_num_rows($qryrentperiod);

                $numRowsrsp = mysqli_num_rows($rsp);

                if ($numRowscalen == $numRowsrsp) {

                    echo '<select class="form-select" id="daterangerent" disabled>

                    <option value="no" selected>ไม่มีรอบที่ว่าง</option>

                  </select>';
                } else {

                ?>

                    <select name="op_id" id="daterangerent" class="form-select" style="display:<?php echo $display ?> ;">

                        <?php while ($rowcalen = mysqli_fetch_assoc($qryrentperiod)) : ?>

                            <?php

                            $op_id = $rowcalen['id'];

                            $rsrange = mysqli_query($conn, "SELECT * FROM stall JOIN booking_period ON (stall.sKey = booking_period.stall_id) WHERE (`stall_id` = '$skey' AND `op_id` = '$op_id')");

                            $numRows = mysqli_num_rows($rsrange);

                            if ($numRows > 0) {

                                $disalbed = 'hidden disabled';
                            } else {

                                $disalbed = '';
                            }

                            ?>

                            <option value="<?php echo $rowcalen['id'] ?>" <?php echo $disalbed; ?> id="<?php echo $rowcalen['start'] ?>" data="<?php echo $rowcalen['day'] ?>">รอบวันที่ <?php echo date("d/m/Y", strtotime($rowcalen['start'])) ?> ถึง <?php echo date("d/m/Y", strtotime($rowcalen['end']))  ?> ( จำนวน <?php echo $rowcalen['day'] ?> วัน )</option>

                        <?php endwhile; ?>

                    </select>

                <?php } ?>

                <hr class="m-0 my-3 ">

                <input type="button" name="next" class=" btn btn-primary" value="ถัดไป" onclick="nextbtn(),calday()" id="next1">



            </div>

            <!-- form--2 -->

            <div id="stepTwo" class="row border shadow-sm p-5 mt-3 mb-3 rounded">

                <h4 class="p-0"><span class="text-secondary"> ขั้นที่ 2</span> กรอกข้อมูลส่วนตัวและข้อมูลร้านค้า</h4>

                <div class="progress p-0 my-2 mb-2">

                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width:  66.6%" aria-valuenow="66.6" aria-valuemin="0" aria-valuemax="100">2/3 </div>

                </div>

                <h5 class="p-0 mt-4 fw-semibold">ข้อมูลส่วนตัว</h5>

                <hr class="m-1">

                <div class="des_input">ชื่อ</div>

                <input class="form-control col-6" type="text" id="firstname" placeholder="ชื่อ" name="firstName" value="<?php echo $rowus['firstName'] ?>" onchange="checkform2()" required autofocus>

                <div class="des_input">นามสกุล</div>

                <input class="form-control col-6" type="text" id="lastname" placeholder="นามสกุล" name="lastName" value="<?php echo $rowus['lastName'] ?>" onchange="checkform2()" required>

                <div class="des_input">อีเมล</div>

                <input class="sqr-input col-12 form-control " id="myemail" type="email" placeholder="อีเมล" name="email" value="<?php echo $rowus['email'] ?>" onchange="checkform2()" required>

                <div class="des_input">เบอร์โทรศัพท์</div>

                <input name="tel" id="mytel" class="sqr-input col-12 form-control" type="text" placeholder="เบอร์โทรศัพท์" name="tel" pattern="[0-9]{10}" title="กรุณากรอกเบอร์โทรศัพท์ หมายเลข (0-9) จำนวน 10 ตัว" value="<?php echo $rowus['tel'] ?>" onchange="checkform2()" required>

                <div class="des_input">สำเนาบัตรประจำตัวประชาชน</div>

                <input class="sqr-input col-12 form-control" id="imgInp" type="file" aria-label="อัปโหลดเอกสาร" name="cardIDcpy" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" onchange="checkform2()" required>

                <h5 class="p-0 mt-4 fw-semibold">ข้อมูลร้านค้า</h5>

                <hr class="m-1">

                <div class="des_input">ชื่อร้านค้า</div>

                <input class=" col-12 form-control" id="stallName" type="text" placeholder="ชื่อร้านค้า" name="storeName" onchange="checkform2()" required>



                <div class="des_input hstack gap-2">รายละเอียดสินค้าโดยสังเขป

                    <div data-toggle="tooltip" title="เช่น ร้านขายเครื่องดื่มสุขภาพ ทำจากผักและผลไม้" onchange="checkform2()" class="mt-1">

                        <i class='bx bx-info-circle'></i>

                    </div>

                </div>

                <div class="form-floating p-0">

                    <textarea class="form-control mb-2" cols="30" rows="10" id="Infomrk" name="shopdes" style="padding-top:5px !important ; resize: none;" onchange="checkform2()" required></textarea>

                </div>

                <hr class="m-0 my-3">

                <input type="button" name="previous" class="btn btn-info" style="color: white;margin-top:0 !important;" value="ย้อนกลับ" onclick="previousbtn()" id="back">

                <input type="button" name="next" class=" btn btn-primary  mt-3" value="ถัดไป" onclick="gotostep3(),<?php echo ($display == 'block' ? 'checkInfo2()' : 'checkInfo1()'); ?>" id="next2" disabled>

            </div>



            <!-- form--3 -->

            <div id="stepThree" class="row border shadow-sm p-5 mt-3 mb-3 rounded">

                <h4 class="p-0"><span class="text-secondary"> ขั้นที่ 3</span> ตรวจสอบและยืนยันข้อมูล</h4>

                <div class="progress p-0 my-2">

                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width: 75%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100">3/4 </div>

                </div>

                <div class="accordion p-0 accordion-flush" id="accordionPanelsStayOpenExample">

                    <div class="accordion-item">

                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">

                            <div class="border-bottom" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">

                                <h5 class="p-0 mt-4 fw-semibold d-flex justify-content-between">ข้อมูลการจอง <i class='bx bx-chevron-down fs-2'></i></h5>

                            </div>

                        </h2>

                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">

                            <div class="accordion-body px-0">

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

                                <input class="form-control col-6" value="<?php echo number_format($rowstall['sRent']) . ' ' . $rowstall['sPayRange'] ?>" disabled>
                                <!-- 
                                <div class="des_input">ราคาค่ามัดจำ</div>

                                <input class="form-control col-6" value="<?php echo number_format($rowstall['sDept']) . ' บาท' ?>" disabled> -->

                                <div class="des_input" style="display:<?php echo $display ?> ;">รอบที่เลือกเช่า</div>

                                <input class="form-control col-6" type="text" id="daterange" style="display:<?php echo $display ?> ;" disabled>

                            </div>

                        </div>

                    </div>

                    <div class="accordion-item">

                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">

                            <div class="border-bottom" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

                                <h5 class="p-0 mt-4 fw-semibold d-flex justify-content-between">ข้อมูลส่วนตัว <i class='bx bx-chevron-down fs-2'></i></h5>

                            </div>

                        </h2>

                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">

                            <div class="accordion-body px-0">

                                <div class="row p-0 m-0">

                                    <div class="col-6 ps-0">

                                        <div class="des_input">ชื่อ</div>

                                        <input class="form-control col-6" id="demofirstname" disabled>

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

                            </div>

                        </div>

                    </div>

                    <div class="accordion-item">

                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">

                            <div class="border-bottom" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="collapseThree">

                                <h5 class="p-0 mt-4 fw-semibold d-flex justify-content-between">ข้อมูลร้านค้า <i class='bx bx-chevron-down fs-2'></i></h5>

                            </div>

                        </h2>

                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">

                            <div class="accordion-body px-0">

                                <div class="des_input">ชื่อร้านค้า</div>

                                <input class="form-control col-6" id="demostallName" disabled>

                                <div class="des_input">รายละเอียดสินค้าโดยสังเขป</div>

                                <div class="form-floating p-0">

                                    <textarea class="form-control" cols="30" rows="10" id="demoInfomrk" style="padding-top:5px !important ; resize: none;" disabled></textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="accordion-item" hidden>

                        <h2 class="accordion-header" id="panelsStayOpen-headingFour">

                            <div class="border-bottom" data-bs-toggle="collapse" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="collapseFour">

                                <h5 class="p-0 mt-4 fw-semibold d-flex justify-content-between">ข้อมูลร้านค้า <i class='bx bx-chevron-down fs-2'></i></h5>

                            </div>

                        </h2>

                        <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">

                            <div class="accordion-body px-0">

                                <div class="des_input">ชื่อร้านค้า</div>

                                <input class="form-control col-6" id="demostallName" disabled>

                                <div class="des_input">รายละเอียดสินค้าโดยสังเขป</div>

                                <div class="form-floating p-0">

                                    <textarea class="form-control" cols="30" rows="10" id="demoInfomrk" style="padding-top:5px !important ; resize: none;" disabled></textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <h5 class="p-0 mt-4 fw-semibold">ข้อมูลการชำระเงิน</h5>

                <hr class="m-1">



                <div class="des_input">ชำระไปยัง</div>

                <input class="form-control col-6" value="<?php echo $row['mkr_name']; ?>" disabled>

                <div class="des_input">ค่าเช่า <span class="text-secondary" style="font-size: 15px;" id="spanrent"></span></div>

                <input class="form-control col-6" id="rentpriceperday" disabled>

                <div class="des_input">ค่าธรรมเนียม <span class="text-secondary" style="font-size: 15px;">(4.07%)</span></div>

                <input class="form-control col-6" id="fee" disabled>

                <div class="des_input">รวมทั้งสิ้น</div>

                <input class="form-control col-6" id="total" disabled>

                <div class="text-danger">*หมายเหตุ* 
                    <br /> 1. การจองจะสำเร็จเมื่อการชำระเงินเสร็จสิ้น
                    <br>2. หากทำการยกเลิกการจองจะไม่ได้รับค่าเช่าคืน
                    <br>3. คุณสามารถ<span class="text-decoration-underline">ยกเลิกการจอง</span>ได้ถึงวันที่ <span class="text-decoration-underline" id="expdate2"></span>
                </div>

                <input type="hidden" name="omiseToken">

                <input type="hidden" name="omiseSource">

                <input type="hidden" name="dept_pay" value="0">

                <input type="hidden" name="fee_pay" value="0">

                <input type="hidden" name="rentprice" id="rentprice">

                <input type="hidden" name="fee" id="feer">

                <input name="total" id="totalcal" hidden>

                <hr class="m-0 my-2">

                <input type="button" name="previous" class="btn btn-info mt-3" style="color: white;" value="ย้อนกลับ" onclick="backtostep2()" id="back">

                <input type="submit" id="checkoutButton" class="btn btn-info mt-3" style="background-color: #000374;color:white;" value="ชำระเงิน" />

            </div>

        </div>

    </form>

    <script type="text/javascript" src="https://cdn.omise.co/omise.js">

    </script>



    <script>
        function calday() {
            const dnd = document.querySelector('#daterangerent');

            // date
            var d = new Date(dnd.options[dnd.selectedIndex].id);
            const pastDate = new Date(d.setDate(d.getDate() - 7));
            const day = pastDate.getDate().toString().padStart(2, '0');
            const month = (pastDate.getMonth() + 1).toString().padStart(2, '0');
            const year = pastDate.getFullYear().toString();
            const formattedDate = `${day}/${month}/${year}`;

            document.getElementById("expdate2").innerHTML = formattedDate;

            // day
            const daynum = dnd.options[dnd.selectedIndex].getAttribute("data");
            const rentpriceperday = <?php echo $rowstall['sRent'] ?>;
            const rentprice = rentpriceperday * daynum;
            const fee = (4.07 / 100) * rentprice;
            const total = rentprice + fee;
            const totalcal = total * 100;

            document.getElementById("spanrent").innerHTML = "( " + rentpriceperday.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " บาท/วัน * " + daynum + " วัน )";
            document.getElementById("rentpriceperday").value = rentprice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " บาท";
            document.getElementById("fee").value = fee.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " บาท";
            document.getElementById("rentprice").value = rentprice;
            document.getElementById("feer").value = fee;
            document.getElementById("total").value = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " บาท";
            document.getElementById("totalcal").value = totalcal;
        }

        OmiseCard.configure({

            publicKey: "pkey_test_5tl2v3azqsf7i7u6hlm",

            image: "http://localhost/SeniorProject51/asset/contact/logo-with-bg.png",

            frameLabel: "MarketRental",

            submitLabel: "ชำระเงิน"

        });



        var button = document.querySelector("#checkoutButton");

        var form = document.querySelector("#checkoutForm");



        button.addEventListener("click", (event) => {

            const totalcal = document.getElementById("totalcal").value

            event.preventDefault();

            OmiseCard.open({

                amount: totalcal,

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



    function checkperiod() {

        if (document.getElementById("daterangerent").value == "no") {

            document.getElementById("next1").disabled = true;

        } else {

            document.getElementById("next1").disabled = false;

        }

    }
</script>







</html>