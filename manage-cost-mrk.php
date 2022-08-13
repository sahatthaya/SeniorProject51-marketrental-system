<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลค่าใช้จ่ายของตลาด</title>
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
    <h1 class="head_contact">จัดการข้อมูลค่าใช้จ่ายของตลาด</h1>

    <form action="">
        <div class="add-info" style="border: 1px solid #000;  border-radius: 5px;padding: 2em 3em; margin: 2em 0;">
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">ค่าน้ำ</label>
                <div class="col-sm-10">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with dropdown button">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">ใส่หน่วย</button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">zdgfhgjf</a></li>
                            <li><a class="dropdown-item" href="#">,jmhng</a></li>
                            <li><a class="dropdown-item" href="#">fgn</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">ค่าไฟ</label>
                <div class="col-sm-10">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" aria-label="Text input with dropdown button">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">ใส่หน่วย</button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">zdgfhgjf</a></li>
                            <li><a class="dropdown-item" href="#">,jmhng</a></li>
                            <li><a class="dropdown-item" href="#">fgn</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">ไฟล์ที่เกี่ยวข้อง</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary " type="button">บันทึก</button>
            </div>
        </div>
    </form>

</body>



</html>