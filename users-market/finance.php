<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - ข้อมูลการเงิน</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>

<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
require "../backend/edit-market-payment.php";
?>


<body>
    <h1 class="head_contact">ข้อมูลการเงิน</h1>

    <form method="POST" enctype="multipart/form-data">
        <input name="p_id" type="text" class="form-control" value="<?php echo $row['p_id']; ?>" hidden>
        <div class="payment-info rounded shadow-sm p-5 mt-3 border">
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">ชื่อ</label>
                <div class="col-sm-10">
                    <input name="p_name" type="text" class="form-control" value="<?php echo $row['p_name']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">นามสกุล</label>
                <div class="col-sm-10">
                    <input name="p_surname" type="text" class="form-control" value="<?php echo $row['p_surname']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">ธนาคาร</label>
                <div class="col-sm-10 search_select_box">
                    <select name="p_bank" class="selectpicker" data-live-search="true" data-width="100%" data-size="5">
                        <option value="<?php echo $row['p_bank']; ?>" selected><?php echo $row['p_bank']; ?></option>
                        <option value="ธนาคารไทยพาณิชย์ (SCB)">ธนาคารไทยพาณิชย์ (SCB)</option>
                        <option value="ธนาคารกสิกรไทย (KBANK)">ธนาคารกสิกรไทย (KBANK)</option>
                        <option value="ธนาคารกรุงไทย (KTB)">ธนาคารกรุงไทย (KTB)</option>
                        <option value="ธนาคารกรุงเทพ (BBL)">ธนาคารกรุงเทพ (BBL)</option>
                        <option value="ธนาคารทหารไทย (TTB)">ธนาคารทหารไทย (TTB)</option>
                        <option value="ธนาคารออมสิน (GSB)">ธนาคารออมสิน (GSB)</option>
                        <option value="ธนาคารกรุงศรีอยุธยา (krungsri)">ธนาคารกรุงศรีอยุธยา (krungsri)</option>
                        <option value="ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร ธ.ก.ส.(BAAC)">ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร ธ.ก.ส.(BAAC)</option>
                        <option value="ธนาคารยูโอบี (UOB)">ธนาคารยูโอบี (UOB)</option>
                        <option value="ธนาคารอาคารสงเคราะห์ ธอส. (GHB)">ธนาคารอาคารสงเคราะห์ ธอส. (GHB)</option>
                        <option value="ธนาคารซีไอเอ็มบี (CIMB)">ธนาคารซีไอเอ็มบี (CIMB)</option>
                        <option value="ธนาคารซิตี้แบงค์ (Citibank)">ธนาคารซิตี้แบงค์ (Citibank)</option>
                        <option value="ธนาคารดอยช์แบงก์ (Deutsche Bank)">ธนาคารดอยช์แบงก์ (Deutsche Bank)</option>
                        <option value="ธนาคารเอชเอสบีซี (HSBC)">ธนาคารเอชเอสบีซี (HSBC)</option>
                        <option value="ธนาคารไอซีบีซี (ICBC)">ธนาคารไอซีบีซี (ICBC)</option>
                        <option value="ธนาคารอิสลามแห่งประเทศไทย (IBank)">ธนาคารอิสลามแห่งประเทศไทย (IBank)</option>
                        <option value="ธนาคารเกียรตินาคินภัทร (KKP)">ธนาคารเกียรตินาคินภัทร (KKP)</option>
                        <option value="ธนาคารแลนด์ แอนด์ เฮ้าส์ (LH Bank)">ธนาคารแลนด์ แอนด์ เฮ้าส์ (LH Bank)</option>
                        <option value="ธนาคาร มิซูโฮ (Mizuho Bank)">ธนาคาร มิซูโฮ (Mizuho Bank)</option>
                        <option value="ธนาคารสแตนดาร์ดชาร์เตอร์ด (Standard Chartered)">ธนาคารสแตนดาร์ดชาร์เตอร์ด (Standard Chartered)</option>
                        <option value="ธนาคาร ซูมิโตโม มิตซุย (Sumitomo Mitsui)">ธนาคาร ซูมิโตโม มิตซุย (Sumitomo Mitsui)</option>
                        <option value="ธนาคารไทยเครดิต (tcrbank)">ธนาคารไทยเครดิต (tcrbank)</option>
                        <option value="ธนาคารทิสโก้ (Tisco Bank)">ธนาคารทิสโก้ (Tisco Bank)</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">เบอร์ที่ผูกกับพร้อมเพย์</label>
                <div class="col-sm-10">
                    <input name="p_promtpay" type="text" id="tel" class="form-control" value="<?php echo $row['p_promtpay']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">หมายเลขบัญชี</label>
                <div class="col-sm-10">
                    <input name="p_account" type="text" id="accountno" class="form-control" value="<?php echo $row['p_account']; ?>">
                </div>
            </div>
            <div class="d-flex justify-content-end">
            <input type="submit" name="submit-apply" class="btn btn-primary  submit" id="submit" value="บันทึกข้อมูล">
            </div>
        </div>

    </form>

</body>

<script>
 
    $(":input").inputmask();

    $("#tel").inputmask({
        "mask": "999 999 9999"
    });
    $("#accountno").inputmask({
        "mask": "999 9 99999 9"
    });
</script>

</html>