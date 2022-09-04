<?php
include "profilebar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - หน้าหลัก</title>
    <link rel="shortcut icon" type="image/x-icon" href="../asset/contact/logo.png" />
    <!-- css  -->
    <link rel="stylesheet" href="./css/index.css" type="text/css">
</head>

<?php
include "./backend/1-connectDB.php";
include "nav.php";
include "backend/1-import-link.php";
require "./backend/qry-index.php";
?>

<body>
    <!-- banner -->
    <div class=" banner">
        <div id="banner" class="carousel slide topcontent" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php
                $i = 0;
                foreach ($result as $row) {
                    $actives = '';
                    if ($i == 0) {
                        $actives = 'active';
                    }
                ?>
                    <button type="button" data-bs-target="#banner" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo $actives; ?> "></button>
                <?php $i++;
                } ?>
            </div>
            <div class="carousel-inner">
                <?php
                $i = 0;
                foreach ($result as $row) {
                    $actives = '';
                    if ($i == 0) {
                        $actives = 'active';
                    }
                ?>
                    <div class="carousel-item <?php echo $actives; ?>">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo $row['bn_toppic'] ?></h5>
                            <p><?php echo $row['bn_detail'] ?></p>
                        </div>
                        <a href="<?php echo $row['bn_link'] ?>">
                            <img class="d-block w-100" src="<?php echo $row['bn_pic']; ?>">
                        </a>
                    </div>
                <?php
                    $i++;
                }
                mysqli_close($conn);
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#banner" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#banner" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="contentbox web-info">
            <figure class="text-center">
                <blockquote class="blockquote">
                    <p>“ศูนย์กลางที่ให้ผู้ที่สนใจจะหาพื้นที่ขายของที่ตลาด แต่ยังไม่ทราบข้อมูลต่างๆในการที่จะเช่าพื้นที่ และเจ้าของตลาดที่ต้องการจะให้มีคนมาเช่าพื้นที่มาพบเจอกัน ทำให้ง่ายสำหรับทั้งสองฝั่ง โดยเรารวบรวมพื้นที่เช่าตลาดทั้งเล็กและใหญ่มารวมกันไว้ในที่เดียว
                        ท่านสามารถค้นหาตลาดได้โดยการคัดกรองจากที่อยู่ของตลาดนั้นๆ ราคาของพื้นที่เช่าและเป็นตลาดประเภทอะไร เพื่อให้คุณนั้นง่ายต่อการหาพื้นที่เช่าขายของของคุณได้ที่นี่</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    <cite title="Source Title">MarketRental</cite>
                </figcaption>
            </figure>
        </div>

        <div class="users-guide">
        <h3 class="center">สำหรับพ่อค้าแม่ค้าที่ต้องการจองแผงค้า</h3>
            <div class="guide">
                <div>
                    <h5 class="center">1. เข้าสู่ระบบ</h5>
                    <img src="asset/contact/merchant-1.png" class="card-img-top img-fluid" alt="...">
                </div>
                <div>
                    <h5 class="center">2. เลือกตลาดที่ต้องการ</h5>
                    <img src="asset/contact/merchant-2.png" class="card-img-top img-fluid" alt="...">
                </div>
                <div>
                    <h5 class="center">3. จ่ายค่ามัดจำ</h5>
                    <img src="asset/contact/merchant-3.png" class="card-img-top img-fluid" alt="...">
                </div>
            </div>
            <div class="text-center guide-btn">
                <button type="button" class="btn btn-primary btn-lg" onclick="window.location='all-market.php';">ค้นหาพื้นที่ขายของ</button>
            </div>
        </div>
    </div>
    <hr>
    <div class="users-guide">
        <h3 class="center">สำหรับเจ้าของตลาดที่ต้องการเป็นพาร์ทเนอร์</h3>
        <div class="guide">
            <div>
                <h5 class="center">1. เข้าสู่ระบบ</h5>
                <img src="asset/contact/mkr-1.png" class="card-img-top img-fluid" alt="...">
            </div>
            <div>
                <h5 class="center">2. กรอกข้อมูล</h5>
                <img src="asset/contact/mkr-2.png" class="card-img-top img-fluid" alt="...">
            </div>
            <div>
                <h5 class="center">3. รอการอนุมัติจากแอดมิน</h5>
                <img src="asset/contact/mkr-3.png" class="card-img-top img-fluid" alt="...">
            </div>
        </div>
        <div class="text-center guide-btn">
            <button type="button" class="btn btn-primary btn-lg" onclick="signIn();showsignup()">สมัครสมาชิก</button>
        </div>
    </div>
    </div>
    <hr>
    <div class=" topmkr">
        <div class="text row">
            <h3 class="col-10">ตลาดแนะนำ</h3>
            <a class="col-2 text-end" id="all-mrk" href="all-market.php">
                <h5>ดูตลาดทั้งหมด</h5>
            </a>
        </div>
        <div class="box">
            <?php while ($row1 = $resultmkr->fetch_assoc()) : ?>
                <a class="marketcard radius10" href="market-info.php?mkr_id=<?php echo $row1['mkr_id']; ?>">
                    <img src="<?php echo $row1['mkr_pic'] ?>" class="radius10 mkrimg " alt="...">
                    <div class="overlay">
                        <h4 style="text-align: center;"><?php echo $row1['mkr_name'] ?></h4>
                        <div class="row markettag">
                            <p class="col-6  ptext" style="text-align: center;"><i class='bx bxs-navigation'></i> <?php echo $row1['province_name'] ?></p>
                            <p class="col-6  ptext" style="text-align: center;"><i class='bx bxs-info-circle'></i> <?php echo $row1['market_type'] ?></p>

                        </div>
                        <p class="ptext">รายละเอียด : <?php echo $row1['mkr_descrip'] ?></p>
                        <p class="ptext">เบอร์ติดต่อ : <?php echo $row1['tel'] ?></p>
                        <p class="ptext">อีเมล : <?php echo $row1['email'] ?></p>
                        <p class="ptext">จำนวนแผงว่าง : 0 จาก 0</p>
                    </div>
                </a>
            <?php
            endwhile ?>
        </div>
    </div>



</body>

</html>