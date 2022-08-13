<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กรอกค่าใช้จ่ายประจำเดือน</title>
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
    <h1 class="head_contact">กรอกค่าใช้จ่ายประจำเดือน</h1>

    <form method="POST">
        <label>งวดวันที่ :</label>
        <input type="date" data-width="100%" style="border-radius: 5px ; border: 1px solid #000" data-style="btn-outline-secondary" data-size="5" required></input>

        <label>ถึง : </label>
        <input type="date" data-width="100%" style="border-radius: 5px ; border: 1px solid #000" data-style="btn-outline-secondary" data-size="5" required></input>

        </div>

    </form>


    <div id="content">
        <div id="table2">
            <table id="myTable" class="display " style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">งวดวันที่</th>
                        <th scope="col">ชื่อบัญชีผู้ใช้</th>
                        <th scope="col">รหัสแผง</th>
                        <th scope="col">ค่าน้ำ</th>
                        <th scope="col">ค่าไฟ</th>
                        <th scope="col">ค่าขยะ</th>
                        <th scope="col">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input name="view" type="text" class="modal_data1 btn btn-outline-primary" style=" width:100px ; "></td>
                        <td><input name="view" type="text" class="modal_data1 btn btn-outline-primary" style=" width:100px;"></td>
                        <td><input name="view" type="text" class="modal_data1 btn btn-outline-primary" style=" width:100px ; "></td>
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