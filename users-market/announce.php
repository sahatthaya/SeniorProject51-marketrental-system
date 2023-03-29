<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - Document</title>



    <link rel="stylesheet" href="../css/applicant.css" type="text/css">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>



<?php

include "profilebar.php";

include "nav.php";

include "../backend/1-connectDB.php";


$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username = '$username'";

$result = mysqli_query($conn, $sql);

$row1 = mysqli_fetch_array($result);

extract($row1);

$users_id = $row1['users_id'];

$qrymymkr = mysqli_query($conn, "SELECT * FROM market_detail WHERE users_id = '$users_id' AND `a_id`=1");

$count_n = 1;

require "../backend/add-applicant.php";



?>





<body>
    <nav aria-label="breadcrumb mb-3">

        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./status-announce.php" class="text-decoration-none">คำร้องขอประชาสัมพันธ์</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">ส่งคำร้องขอประชาสัมพันธ์</li>
        </ol>

    </nav>
    <div class="applybox">

        <form id="applyform" method="POST" enctype="multipart/form-data" class="was-validated">

            <div class="form-outer" style="overflow: visible;">

                <h1 id="headline">กรอกข้อมูลเพื่อสร้างคำร้องขอประชาสัมพันธ์</h1>



                <!-- form--1 -->

                <div id="stepOne" class="row border shadow-sm p-5 mt-3 mb-3 rounded">
                    <div class="des_input">ตลาดที่ต้องการประชาสัมพันธ์</div>

                    <div class="search_select_box p-0">

                        <select class="selectpicker form-control" title="เลือกตลาดของคุณ" name="mkr_id" id="mkr_id" data-width="100%" data-size="5" required>

                            <?php while ($row1 = mysqli_fetch_array($qrymymkr)) :; ?>

                                <option value="<?php echo $row1['mkr_id']; ?>"><?php echo $row1['mkr_name']; ?></option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                    <div class="des_input">หัวข้อ</div>

                    <input class="form-control col-6" type="text" placeholder="หัวข้อ" name="bn_toppic" required>

                    <div class="des_input">รายละเอียด</div>

                    <textarea name="bn_detail" class=" form-control m-0" placeholder="รายละเอียด" id="" cols="30" rows="5" style="border-radius: 5px;resize: none;" required></textarea>



                    <div class="des_input">รูปภาพ <span class="text-secondary fs-8">( ขนาดแนะนำ 1278 x 400 )</span></div>

                    <input class="sqr-input col-12 form-control" type="file" aria-label="แนบรูปภาพ" name="bn_img" accept="image/jpeg,image/gif,image/png" required>

                    <input type="submit" class="btn btn-primary" id="add-data" name="bn-submit" value="ยืนยันคำร้อง">

                </div>

            </div>

        </form>

    </div>

</body>



</html>