<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลตลาด</title>
    <!-- css  -->
    <link rel="stylesheet" href="css/market-info.css">
</head>
<?php
include "profilebar.php";
include "nav.php";
include "backend/1-connectDB.php";
include "backend/1-import-link.php";
require "backend/qry-market-info.php"
?>

<body>
    <div>
        <div class="mkrpic">
            <img src="<?php echo $row['mkr_pic'] ?>" class="d-block w-100" alt="...">
        </div>

        <div class="mrk_info">
            <p id="mkr_name"><?php echo $row['mkr_name']; ?></p>
            <div class="hstack gap-2 info-tag">
                <button class="type_tag"><i class='bx bxs-info-circle'></i> <?php echo $row['market_type']; ?></button>
                <button class="type_tag"><i class='bx bxs-navigation'></i> <?php echo $row['province_name']; ?></button>
            </div>
            <h5>รายละเอียด</h5>
            <p class="text_desc">
                <?php echo $row['mkr_descrip']; ?>
            </p>
            <h5>ข้อมูลติดต่อ</h5>
            <p class="text_desc">
                เบอร์โทร : <?php echo $row['tel']; ?>
                <br>
                อีเมล : <?php echo $row['email']; ?>
                <br>
                ที่อยู่ : <?php echo $row['mkr_address']; ?>
            </p>

        </div>

        <div id="quick-menu2" class="hstack">
            <a type="button" class="quick-menu2" id="partner-btn" data-bs-toggle="modal" data-bs-target="#partner-modal">
                <i class='bx bxs-map-alt'></i>
                <p> แผนผังตลาด</p>
            </a>
            <a type="button" class="quick-menu2 " id="merchant-btn" data-bs-toggle="modal" data-bs-target="#merchant-modal">
                <i class='bx bxs-message-square-edit'></i>
                <p> สนใจเช่าจองพื้นที่ </p>
            </a>
            <a type="button" class="quick-menu2 " href="complain.php?mkr_id=<?php echo $row['mkr_id']; ?>">
                <i class='bx bxs-paper-plane'></i>
                <p> การร้องเรียน </p>
            </a>
        </div>

        <div class="mrk_news">
            <h5>ข่าวสารตลาด</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href=""> An item</a></li>
                <li class="list-group-item"><a href=""> An item</a></li>
                <li class="list-group-item"><a href=""> An item</a></li>
            </ul>
        </div>

    </div>
</body>

</html>