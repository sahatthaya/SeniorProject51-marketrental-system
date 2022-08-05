<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลการจอง</title>

    <link rel="stylesheet" href="./css/reserve-info.css">


</head>

<?php
include "profilebar.php";
include "nav.php";
include "backend/connectDB.php";
include "backend/import-link.php";
require "backend/qry-market-info.php"
?>

<div class="content">
    <h1 id="headline">จัดการข้อมูลการจอง</h1>
    <div>
        <div id="table">
            <table id="myTable" class="display " style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">ชื่อบัญชีผู้ใช้</th>
                        <th scope="col">รหัสแผงค้า</th>
                        <th scope="col">วันที่เริ่มเช่า</th>
                        <th scope="col">ประเภทร้านค้า</th>
                        <th scope="col">ระยะเวลาเช่า</th>
                        <th scope="col">ใบเสร็จค่ามัดจำ</th>
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
                        <td>
                            <div style="justify-content: center; margin:10px 0; ">
                                <a href=""  class=" btn btn-outline-danger " style="margin-left: 2px;font-size:14px; background-color: #3DC9F9;border:none; color:#fff;">จัดการข้อมูล</a>
                            </div>
                            <div style="justify-content: center;">
                                <a href="" class=" btn btn-outline-danger " style="margin-left: 2px;font-size:14px; background-color: #EF3838;color:#fff;">ยกเลิกการจอง</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


</body>

</html>