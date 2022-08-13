<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลการเงิน</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";

?>

<body>
    <h1 class="head_contact">ข้อมูลการเงิน</h1>

    <form action="">
        <div class="payment-info rounded shadow-sm p-5 mt-3 border" >
        <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">ชื่อ</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" >
                </div>
            </div><div class="mb-3 row">
                <label class="col-sm-2 col-form-label">นามสกุล</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" >
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">หมายเลขพร้อมเพย์</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" >
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary w-25" type="button">บันทึก</button>
            </div>
        </div>
    </form>
</body>



</html>