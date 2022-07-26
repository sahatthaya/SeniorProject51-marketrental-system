<?php
include "profilebar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/index.css" type="text/css">
</head>

<?php
include "nav.php";
include "../backend/connectDB.php";
require "../backend/qry-index.php";
include "../backend/import-link.php";
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
                            <img class="d-block w-100" src="../<?php echo $row['bn_pic']; ?>">
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

        <!-- users-guide -->
        <div id="users-guide">
            <button class="quick" id="partner-btn" data-bs-toggle="modal" data-bs-target="#partner-modal">
                <i class='bx bxs-store-alt'></i>
                <p> สำหรับเจ้าของตลาด</p>
            </button>
            <button class="quick" id="merchant-btn" data-bs-toggle="modal" data-bs-target="#merchant-modal">
                <i class='bx bxs-message-square-edit'></i>
                <p> ค้นหาพื้นที่ขายของ </p>
            </button>
        </div>


    </div>
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
                    <img src="../<?php echo $row1['mkr_pic'] ?>" class="radius10 mkrimg " alt="...">
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
            <?php endwhile ?>
        </div>
    </div>
    <!-- Modal -->
    <!-- partner-modal  -->
    <div class="modal fade" id="partner-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">สำหรับเจ้าของตลาด</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <h3 class="center">ขั้นตอนการสมัครเป็นพาร์ทเนอร์</h3>
                        <div class="row">
                            <div class="col c">
                                <div class="card">
                                    <img src="../asset/contact/mkr-1.png" class="card-img-top" alt="...">

                                </div>
                            </div>
                            <div class="col c">
                                <div class="card center">
                                    <img src="../asset/contact/mkr-2.png" class="card-img-top" alt="...">

                                </div>
                            </div>
                            <div class="col c">
                                <div class="card">
                                    <img src="../asset//contact/mkr-2.png" class="card-img-top" alt="...">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- merchant-modal  -->
    <div class="modal fade" id="merchant-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">สำหรับพ่อค้าแม่ค้า</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <h3 class="center">ขั้นตอนการจองพื้นที่</h3>
                        <div class="row">
                            <div class="col c">
                                <div class="card">
                                    <img src="../asset/contact/merchant-1.png" class="card-img-top" alt="...">
                                </div>
                            </div>
                            <div class="col c">
                                <div class="card center">
                                    <img src="../asset/contact/merchant-2.png" class="card-img-top" alt="...">
                                </div>
                            </div>
                            <div class="col c">
                                <div class="card">
                                    <img src="../asset/contact/merchant-3.png" class="card-img-top" alt="...">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>