<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจองทั้งหมด</title>
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
    <h1 class="head_contact">จัดการข่าวสารตลาด</h1>

    <form action="">
        <div class="add-info" style="border: 1px solid #000;  border-radius: 5px;padding:1em; margin: 2em 0;">
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">หัวเรื่อง</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">รายละเอียด</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">ไฟล์ที่เกี่ยวข้อง</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary " style="width: 150px;" type="button">เพิ่ม</button>
            </div>
        </div>
    </form>
    
    <div id="content">
        <div id="table2">
            <table id="myTable" class="display " style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">วันที่เริ่มเช่า</th>
                        <th scope="col">ชื่อบัญชีผู้ใช้</th>
                        <th scope="col">รหัสแผง</th>
                        <th scope="col">ประเภทร้านค้า</th>
                        <th scope="col">ระยะเวลาการเช่า</th>
                        <th scope="col">ดูหลักฐานมัดจำ</th>
                        <th scope="col">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button name="view" type="button" class="modal_data1 btn btn-outline-primary">ดูรายละเอียด</button></td>
                        <td>
                            <div class="row" style="justify-content: center;">
                                <a href="" class=" btn btn-outline-success col-12 " style="margin:3px 10px; width:50% ; ; font-size:14px;"> แก้ไขข้อมูล</a>
                                <a href="" class=" btn btn-outline-danger " style="margin:3px 10px; width:50% ; font-size:14px;">ยกเลิกการจอง</a>
                            </div>
                        </td>
                </tbody>
            </table>
        </div>
    </div>

</body>



</html>