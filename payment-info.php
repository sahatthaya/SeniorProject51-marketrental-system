<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลการเงิน</title>
    <!-- css  -->
    <link rel="stylesheet" href="./css/banner.css" type="text/css">
</head>
<?php
include "./profilebar.php";
include "nav.php";
include "./backend/1-connectDB.php";
include "./backend/1-import-link.php";

?>

<body>
    <h1 class="head_contact">ข้อมูลการเงิน</h1>

    <form action="">
        <div class="payment-info" style="border: 1px solid #000;  border-radius: 5px;padding:2em 3em; margin: 2em 0;">
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">ผู้รับเงิน</label>
                <div class="col">
                    <input type="text" class="form-control" placeholder="First name" aria-label="First name">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
                </div>

            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">หมายเลขพร้อมเพย์</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" >
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">ไฟล์ที่เกี่ยวข้อง</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="button">เพิ่ม</button>
            </div>
        </div>
    </form>
</body>



</html>