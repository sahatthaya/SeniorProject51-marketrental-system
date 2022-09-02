<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขแผนผังตลาด</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/market-plan.css" type="text/css">

    <?php
    include "profilebar.php";
    include "nav.php";
    include "../backend/1-connectDB.php";
    include "../backend/1-import-link.php";
    if ($_GET) {
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
             WHERE (mkr_id = '$mkr_id') ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        extract($row);
    }
    $count_n = 1;
    $data2 = "SELECT * FROM stall WHERE (market_id = '$mkr_id')";
    $result3 = mysqli_query($conn, $data2);
    ?>

</head>

<body>
    <h1>แผนผัง<?php echo $row['mkr_name']; ?></h1>
    <div class="plan">
        <div class="w-100 hstack px-1 pt-3 gap-2">
            <label>ประเภทร้านค้า : </label>
            <select class="form-select" aria-label="Default select example" style="width: 25%;">
                <option selected>ทั้งหมด</option>
                <option value="1">ร้านเสื้อผ้า</option>
                <option value="2">ร้านอาหาร</option>
                <option value="3">ร้านน้ำ</option>
            </select>
            <button type="button" class="btn btn-outline-primary save-stall" id="save"><i class='bx bx-search' ></i> ค้นหา </button>
        </div>
        <hr>
        <div id="plan">
            <div class="liststall vstack" id="sortable">
                <?php while ($row1 = $result3->fetch_assoc()) : ?>
                    <li class="m-1 ">
                        <div class="stallbox" data-need="<?php echo $row1['sKey'] ?>">
                            <div class="text-center stallnum">
                                <div class="mx-auto text-wrap">แผงค้า : <span><?php echo $row1['sID'] ?></span></div>
                            </div>
                        </div>
                    </li>
                <?php endwhile ?>
            </div>
        </div>
    </div>
</body>


</html>