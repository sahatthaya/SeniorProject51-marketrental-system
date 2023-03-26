<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - คำร้องขอเพิ่มตลาดใหม่</title>



    <link rel="stylesheet" href="../css/applicant.css" type="text/css">

</head>

<?php

include "profilebar.php";

?>

<?php

include "nav.php";

include "../backend/1-connectDB.php";

$mkr_id = $_GET['mkr_id'];

$sql = "SELECT market_detail.*,users.username ,

    provinces.province_name,

    amphures.amphure_name,

    districts.district_name , 

    market_type.market_type

    FROM market_detail 

        JOIN users ON (market_detail.users_id = users.users_id)

        JOIN provinces ON (market_detail.province_id = provinces.id)

        JOIN amphures ON (market_detail.	amphure_id = amphures.id)

        JOIN districts ON (market_detail.district_id = districts.id)

        JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)

         WHERE (a_id='1' AND mkr_id = '$mkr_id') ";

$result = mysqli_query($conn, $sql);

$row1 = mysqli_fetch_array($result);

extract($row1);


if (isset($_POST['bn-submit'])) {
    $n_sub = $row1['mkr_name'] . " ได้ส่งประกาศถึงผู้เช่า";
    $n_detail =  $_POST['bn_detail'];


    $query = mysqli_query($conn, "SELECT * FROM booking,stall WHERE market_id = $mkr_id and status = '1' GROUP BY `users_id`  ORDER BY `timestamp` DESC");
    while ($row = $query->fetch_assoc()) {
        $users_id = $row['users_id'];
        $insert = mysqli_query($conn, "INSERT INTO `notification`(`n_sub`, `n_detail`,`status`, `type`, `users_id`,`fk_id`) VALUES ('$n_sub','$n_detail','1','8','$users_id','$mkr_id')");
    }

    if ($insert) {
        echo "<script>
        Swal.fire({
    
            title: 'ส่งประกาศไปถึงผู้เช่าสำเร็จ',
    
            icon: 'success',
    
            showConfirmButton: false,
    
            timer: 3000
    
        });
        </script>";
    }
    echo '<meta http-equiv="refresh" content="1"; />';
}


?>



<body>
    <nav aria-label="breadcrumb mb-3">

        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php?mkr_id=<?php echo $row1['mkr_id']; ?>" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item fs-5 "><a href="./booking.php?mkr_id=<?php echo $mkr_id ?>" class="text-decoration-none">การจองทั้งหมด <?php echo $row1['mkr_name']; ?></a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">สร้างประกาศถึงผู้เช่าทุกคน</li>
        </ol>

    </nav>
    <h1 id="headline">กรอกข้อมูลเพื่อสร้างประกาศถึงผู้เช่าทุกคน</h1>


    <form id="applyform" method="POST" enctype="multipart/form-data" class="was-validated">

        <div class="form-outer" style="overflow: visible;">

            <!-- form--1 -->

            <div id="stepOne" class="row border shadow-sm p-5 mt-3 mb-3 rounded">

                <div class="des_input mb-3">เรียน ผู้เช่าแผงค้าในตลาด<?php echo $row1['mkr_name']; ?></div>

                <textarea name="bn_detail" class=" form-control m-0" placeholder="กรุณากรอกรายละเอียด" id="" cols="50" rows="5" style="border-radius: 5px;resize: none;" required></textarea>
                
                <div class="text-end des_input">ด้วยความเคารพ <br> ตลาด<?php echo $row1['mkr_name']; ?></div>

                <input type="submit" class="btn btn-primary mt-4" id="add-data" name="bn-submit" value="ยืนยันการสร้างและส่งประกาศ">

            </div>

        </div>

    </form>
</body>

</html>