<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - ระบบร้องเรียน</title>

    <link rel="stylesheet" href="./css/complain.css">



</head>



<?php

include "profilebar.php";

include "nav.php";

include "./backend/1-connectDB.php";
require "./backend/add-complain.php";



if ($_GET['mkr_id'] && $_GET['comp_id']) {

    $mkr_id = $_GET['mkr_id'];
    $comp_id = $_GET['comp_id'];

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


$perpage = 5;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start = ($page - 1) * $perpage;


$comp = mysqli_query($conn, "SELECT complain.*, toppic.toppic,users.username,comp_status.* FROM complain 
JOIN toppic ON (complain.toppic_id = toppic.toppic_id)
JOIN users ON (complain.users_id = users.users_id)
JOIN comp_status ON (comp_status.cs_id = complain.status)
WHERE (comp_id = '$comp_id')");
$c = mysqli_fetch_array($comp);
extract($c);
$reply = mysqli_query($conn, "SELECT * FROM `reply` WHERE `comp_id` = '$comp_id'");
$numRowr = mysqli_num_rows($reply);
$img = mysqli_query($conn, "SELECT * FROM `img` WHERE `fk_id` = '$comp_id' AND `type` = '1'");
$numimg = mysqli_num_rows($img);




//qry

$data = "SELECT reply.*,users.username FROM reply 
JOIN users ON (reply.users_id = users.users_id) 
WHERE (comp_id = '$comp_id')
ORDER BY rp_id ASC limit {$start} , {$perpage}";
$result = mysqli_query($conn, $data);

$sql2 = "SELECT reply.*,users.username FROM reply 
JOIN users ON (reply.users_id = users.users_id) 
WHERE (comp_id = '$comp_id')";
$query2 = mysqli_query($conn, $sql2);
?>



<body>
    <nav aria-label="breadcrumb mb-3">

        <ol class="breadcrumb ">
            <?php if (isset($_GET['my_thread'])) { ?>
                <li class="breadcrumb-item fs-5 "><a href="./comp-status.php" class="text-decoration-none">ติดตามสถานะคำร้องเรียน</a></li>
                <li class="breadcrumb-item active fs-5" aria-current="page">การร้องเรียน</li>
            <?php } else { ?>
                <li class="breadcrumb-item fs-5 "><a href="./all-market.php" class="text-decoration-none">ตลาดทั้งหมด</a></li>

                <li class="breadcrumb-item fs-5 "><a href="market-info.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none"><?php echo $row['mkr_name']; ?></a></li>
                <li class="breadcrumb-item fs-5 "><a href="complain.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none">ระบบร้องเรียน<?php echo $row['mkr_name']; ?></a></li>

                <li class="breadcrumb-item active fs-5" aria-current="page">การร้องเรียน</li>
            <?php } ?>

        </ol>

    </nav>

    <div>


        <div class="border rounded shadow-sm p-3">
            <div class="d-flex justify-content-between">
                <h4 class=""><?php echo $c['comp_subject']; ?></h4>
                <div class="<?php echo $c['cs_color']; ?>">
                    <?php echo $c['cs_name']; ?>
                    <i class='bx bxs-circle'></i>
                </div>
            </div>

            <hr>

            <div class="mb-3 text-break">
                <?php echo $c['comp_detail']; ?>
            </div>
            <div class="row">
                <?php
                if ($numimg == 0) {
                } else {
                    $count = 0;
                    while ($im = $img->fetch_assoc()) :
                ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <div class="hovereffect rounded mb-1">
                                <img class="img-responsive w-100 img-fluid" src="./<?php echo $im['img'] ?>" alt="" style="height: 200px;">
                                <div class="overlay text-end">
                                    <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $count ?>">
                                        <i class='bx bx-zoom-in'></i> ขยาย
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal<?php echo $count ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-end">
                                        </div>
                                        <img class="img-responsive w-100 img-fluid" src="./<?php echo $im['img'] ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                        $count++;
                    endwhile;
                } ?>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <div class="d-flex hstck gap-2">
                    <div>
                        โดย: <?php echo $c['username']; ?>
                    </div>
                    <div class="text-secondary opacity-50">
                        <?php echo date("วันที่ d/m/Y เวลา h:i a", strtotime($c['timestamp'])) ?>
                    </div>
                </div>
                <div class="text-secondary">
                    <i class='bx bx-message-square-dots'></i> <?php echo $numRowr ?>
                </div>
            </div>


        </div>

        <!-- การตอบกลับ -->
        <?php

        $total_record = mysqli_num_rows($query2);

        $total_page = ceil($total_record / $perpage);

        ?>

        <hr style="display: <?php echo $total_record > 0 ? 'block' : 'none'; ?>;">

        <?php
        if (mysqli_num_rows($result) == 0) { ?>
            <h2 class="text-inline mt-5">
                <i><span class="text-secondary fs-5"> ยังไม่มีการตอบกลับในขณะนี้ </span></i>
            </h2>

            <?php
        } else {
            $countrp = 1;
            while ($row2 = $result->fetch_assoc()) :
                $comp_id = $row2['comp_id'];
                if ($row2['mkr_name'] != '') {
                    $admin = ' (' . $row2['mkr_name'] . ')';
                    $text = "text-primary";
                } else {
                    $admin = "";
                    $text = "";
                }

            ?>
                <div>
                    <div class="border rounded shadow-sm p-3 my-2 comp-card">
                        <div class="text-end">
                            <h6>การตอบกลับที่ #<?php echo $countrp ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <?php echo $row2['rp_detail']; ?>
                        </div>
                        <div class="row">
                            <?php
                            $fk = $row2['rp_id'];
                            $imgrp = mysqli_query($conn, "SELECT * FROM `img` WHERE `fk_id` = '$fk' AND `type` = '2'");
                            $numimgrp = mysqli_num_rows($imgrp);
                            if ($numimgrp == 0) {
                            } else {
                                $count = 0;
                                while ($imr = $imgrp->fetch_assoc()) :
                            ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                        <div class="hovereffect rounded my-1">
                                            <img class="img-responsive w-100 img-fluid" src="./<?php echo $imr['img'] ?>" alt="" style="height: 200px;">
                                            <div class="overlay text-end">
                                                <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $count ?>">
                                                    <i class='bx bx-zoom-in'></i> ขยาย
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="exampleModal<?php echo $count ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-end">
                                                    </div>
                                                    <img class="img-responsive w-100 img-fluid" src="./<?php echo $imr['img'] ?>" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    $count++;
                                endwhile;
                            } ?>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex hstck gap-2">
                                <div>
                                    โดย: <span class="<?php echo $text ?>"><?php echo $row2['username']; ?><?php echo $admin ?></span>
                                </div>
                            </div>
                            <div>
                                <?php echo date("วันที่ d/m/Y เวลา h:i a", strtotime($row2['timestamp'])) ?>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
                $countrp++;
            endwhile;
        } ?>
    </div>

    <hr style="display: <?php echo $total_record > 0 ? 'block' : 'none'; ?>;">

    <div class="my-3" style="display: <?php echo $total_record > 5 ? 'block' : 'none'; ?>;">

        <nav aria-label="Page navigation example " style="height: 38px;">

            <ul class="pagination justify-content-end">

                <li class="page-item">

                    <a class="page-link" href="thread.php?page=1&&mkr_id=<?php echo $mkr_id; ?>&&comp_id=<?php echo $comp_id ?>" aria-label="Previous">

                        <span aria-hidden="true">&laquo;</span>

                    </a>

                </li>

                <?php for ($i = 1; $i <= $total_page; $i++) { ?>

                    <li class="page-item"><a class="page-link" href="thread.php?page=<?php echo $i; ?>&&mkr_id=<?php echo $mkr_id; ?>&&comp_id=<?php echo $comp_id ?>"><?php echo $i; ?></a></a></li>

                <?php } ?>

                <li class="page-item">

                    <a class="page-link" href="thread.php?page=<?php echo $total_page; ?>&&mkr_id=<?php echo $mkr_id; ?>&&comp_id=<?php echo $comp_id ?>" aria-label="Next">

                        <span aria-hidden="true">&raquo;</span>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</body>





</html>