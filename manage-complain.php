<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการการร้องเรียน</title>
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
    <h1 class="head_contact">จัดการคำร้องขอประชาสัมพันธ์</h1>
    <div id="content">
        <div id="table2">
            <table id="myTable" class="display " style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">วันที่ร้องเรียน</th>
                        <th scope="col">ประเภทการร้องเรียน</th>
                        <th scope="col">หัวข้อการร้องเรียน</th>
                        <th scope="col">ผู้ร้องเรียน</th>
                        <th scope="col">สถานะ</th>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#respond">
                                ตอบกลับ
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php require './backend/model-complain.php' ?>
    </div>

</body>



</html>