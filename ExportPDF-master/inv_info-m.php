<?php

require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf'
        ]
    ],
    'default_font' => 'sarabun'
]);
include "./profilebar-market.php";
include "./nav-market.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";

if (isset($_GET["INV_id"])) {
    $INV_id = $_GET["INV_id"];
    $result = mysqli_query($conn, "SELECT market_detail.* FROM `invoice` JOIN market_detail ON (market_detail.mkr_id = invoice.mkr_id) WHERE INV_id = $INV_id");
    $rowm = mysqli_fetch_array($result);
    extract($rowm);
    $open = $rowm['opening'];
    if ($open == 'เปิดทำการทุกวัน') {
        $resultdata = mysqli_query($conn, "SELECT invoice.INV_id AS invid,`invoice`.*,booking_range.*,stall.*,market_detail.*,amphures.*,districts.*,provinces.* FROM `invoice`,`booking_range`,`stall`,`market_detail`,`provinces`,`amphures`,`districts` WHERE (booking_range.b_id = invoice.b_id AND stall.sKey = booking_range.stall_id AND market_detail.mkr_id = invoice.mkr_id AND market_detail.province_id = provinces.id AND market_detail.district_id = districts.id AND market_detail.amphure_id = amphures.id AND invoice.INV_id= $INV_id)");
    } else {
        $resultdata = mysqli_query($conn, "SELECT invoice.INV_id AS invid,`invoice`.*,booking_period.*,stall.*,market_detail.*,amphures.*,districts.*,provinces.* FROM `invoice`,`booking_period`,`stall`,`market_detail`,`provinces`,`amphures`,`districts` WHERE (booking_period.b_id = invoice.b_id AND stall.sKey = booking_period.stall_id AND market_detail.mkr_id = invoice.mkr_id AND market_detail.province_id = provinces.id AND market_detail.district_id = districts.id AND market_detail.amphure_id = amphures.id AND invoice.INV_id= $INV_id)");
    }
    
    $row = mysqli_fetch_array($resultdata);
    extract($row);
}

@$fee = round(number_format((4.07 / 100) * $row["INV_rentprice"], 2, '.', ''));
$qrycost = mysqli_query($conn, "SELECT * FROM `inv_cost` WHERE `INV_id`= '$INV_id'");
$qrycost2 = mysqli_query($conn, "SELECT * FROM `inv_cost` WHERE `INV_id`= '$INV_id'");
$qrycost3 = mysqli_query($conn, "SELECT * FROM `inv_cost` WHERE `INV_id`= '$INV_id'");
$qrycost4 = mysqli_query($conn, "SELECT * FROM `inv_cost` WHERE `INV_id`= '$INV_id'");
$userid = $_SESSION['users_id'];

if ($row['INV_status'] == '2') {
    $paiddata = mysqli_query($conn, "SELECT * FROM `invoice_paid` WHERE inv_id= $INV_id");
    $rowp = mysqli_fetch_array($paiddata);
    extract($rowp);
} else {
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - ข้อมูลใบเรียกเก็บค่าเช่า</title>
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
    <link rel="stylesheet" href="../css/reciept.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Sarabun&;display=swap" rel="stylesheet">

</head>

<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="../users-market/index.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item fs-5 "><a href="../users-market/rent.php?mkr_id=<?php echo $mkr_id ?>" class="text-decoration-none">จัดการค่าเช่า</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">ข้อมูลใบเรียกเก็บค่าเช่า <?php echo  $row["invid"] ?></li>
        </ol>
    </nav>
    <div class="content">
        <h1 id="headline">ข้อมูลใบเรียกเก็บค่าเช่า (รหัส <?php echo  $row["invid"] ?>)</h1>

        <div id="table" class="bannertb border p-3 shadow-sm rounded mt-2">
            <div class="d-flex justify-content-between">
                <div class="fs-5">ข้อมูลใบเรียกเก็บค่าเช่า</div>
                <?php
                if ($row['INV_status'] == '2') { ?>
                    <a type="button" class="btn mt-0" style="background-color: #000374;color:white;" href="./reciept-billrent.pdf">ดาวน์โหลดฐานการชำระเงิน</a>
                <?php
                } else {
                    echo '';
                } ?>
            </div>
            <hr>
            <div class="row mb-2">
                <div class="col-2">วันที่สร้าง</div>
                <div class="col-3"><?php echo date("d/m/Y", strtotime($row['INV_created'])) ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-2">หมดเขตชำระภายในวันที่</div>
                <div class="col-3"><?php echo date("d/m/Y", strtotime($row['INV_expired'])) ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-2">รหัสแผงค้า</div>
                <div class="col-3"><?php echo  $row["sID"] ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-2">รายละเอียดค่าใช้จ่ายเพิ่มเติม</div>
                <div class="col-3">
                    <?php
                    $numRowsop2 = mysqli_num_rows($qrycost2);
                    if ($numRowsop2 > 0) {
                        while ($c = mysqli_fetch_assoc($qrycost2)) : ?>
                            - <?php echo $c["cost_name"] ?> <?php echo number_format($c["price/unit"]) ?> <?php echo $c["unit"] ?><br>
                        <?php endwhile;
                    } else {
                        ?>
                        -
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-2">สถานะ</div>
                <div class="col-3">
                    <?php
                    if ($row['INV_status'] == '1') {
                        echo '<span class="text-danger">ยังไม่ชำระ</span>';
                    } else {
                        echo '<span class="text-success">ชำระแล้ว</span>';
                    }
                    ?>
                </div>
            </div>
            <table class="display table table-striped table-hover " style="width: 100%;">
                <thead class="table-dark">
                    <tr>
                        <th>ลำดับ</th>
                        <th>รายการ</th>
                        <th>รายละเอียด</th>
                        <th>จำนวนเงิน</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>ค่าเช่า</td>
                        <td>- </td>
                        <td>+ <?php echo number_format($row["INV_rentprice"]) ?> บาท</td>
                    </tr>
                    <?php
                    if ($row["INV_discount"] != 0) {
                        $count = 2;
                    ?>
                        <tr>
                            <td>2</td>
                            <td>คืนค่ามัดจำ</td>
                            <td>-</td>
                            <td>- <?php echo number_format($row["INV_discount"]) ?> บาท</td>
                        </tr>
                        <?php
                    } else {
                        $count = 1;
                    }
                    $numRowsop = mysqli_num_rows($qrycost);
                    if ($numRowsop > 0) {
                        $cost = 0;
                        while ($rowc = mysqli_fetch_assoc($qrycost)) :
                            $unit = floor($rowc["price"] / $rowc["price/unit"]);
                            if ($rowc["unit"] == "(เหมาจ่าย)") {
                                $detail = '';
                            } else {
                                $detail =  " x " . number_format($unit) . " หน่วย = " . number_format($rowc["price"]) . " บาท";
                            }
                        ?>
                            <tr>
                                <td><?php echo $count + 1 ?></td>
                                <td><?php echo $rowc["cost_name"] ?></td>
                                <td><?php echo number_format($rowc["price/unit"]) . " " . $rowc["unit"] . $detail ?></td>
                                <td>+ <?php echo number_format($rowc["price"]) ?> บาท</td>
                            </tr>
                    <?php
                            $cost = $cost + $rowc["price"];
                            $count++;
                        endwhile;
                    } else {
                        $cost = 0;
                    }

                    $total = $row["INV_rentprice"] - $row["INV_discount"] + $cost;
                    ?>

                    <tr class="fw-bold">
                        <td>#</td>
                        <td>รวมทั้งสิ้น</td>
                        <td>-</td>
                        <td>= <?php echo number_format($total) ?> บาท</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php ob_start(); ?>
    <div style="font-size:20px;" hidden>
        <div style="font-size:30px;"><strong style="font-weight: bold;">ใบเสร็จการชำระค่าเช่าแผงค้า</strong></div>
        <hr>
        <div class="row">
            <div class="col-6">
                <address>
                    <strong style="font-weight: bold;">ผู้ชำระ :</strong> คุณ <?php echo $row['b_fname'] . ' ' . $row['b_lname'] ?><br>
                    <?php echo $row['b_email'] ?><br>
                    <?php echo $row['b_tel'] ?><br>
                </address>
            </div>
            <div class="col-6 text-right">
                <address>
                    <strong style="font-weight: bold;">ผู้รับเงิน :</strong> <?php echo $row['mkr_name'] ?><br>
                    <?php echo $row['house_no']; ?> ถนน <?php echo $row['road']; ?> ตำบล/แขวง <?php echo $row['district_name']; ?> อำเภอ/เขต <?php echo $row['amphure_name']; ?> <br>
                    <?php echo $row['province_name']; ?> <?php echo $row['postalcode']; ?>
                </address>
            </div>
        </div>
        <div style="margin-top:10px;background-color: #f4f4f4;padding: 8px;">
            <div style="font-size:22px;"><strong style="font-weight: bold;">ข้อมูลใบเรียกเก็บค่าเช่า</strong></div>
            <strong style="font-weight: bold;">วันที่สร้าง</strong> <?php echo date("d/m/Y", strtotime($row['INV_created'])) ?><br>
            <strong style="font-weight: bold;">หมดเขตชำระภายในวันที่</strong> <?php echo date("d/m/Y", strtotime($row['INV_expired'])) ?><br>
            <strong style="font-weight: bold;">รหัสแผงค้า</strong> <?php echo  $row["sID"] ?> <br>
            <strong style="font-weight: bold;">รายละเอียดค่าใช้จ่ายเพิ่มเติม</strong>
            <div>
                <?php
                $numRowsop3 = mysqli_num_rows($qrycost3);
                if ($numRowsop3 > 0) {
                    while ($c = mysqli_fetch_assoc($qrycost3)) : ?>
                        - <?php echo $c["cost_name"] ?> <?php echo number_format($c["price/unit"]) ?> <?php echo $c["unit"] ?><br>
                    <?php endwhile;
                } else {
                    ?>
                    -
                <?php
                }
                ?>
            </div>
        </div>
        <div>
            <table style="width:100%;border-collapse: collapse;font-size:20px;margin-top:10px;border: 1px solid #dddddd;">
                <thead style="text-align:center;">
                    <tr style="background-color: #dddddd;">
                        <td style="border: 1px solid #dddddd; padding: 8px; text-align:center;" colspan="3"><strong style="font-weight: bold;">รายการชำระเงิน</strong></td>
                    </tr>
                    <tr style="border: 1px solid #dddddd;">
                        <td style="border: 1px solid #dddddd; padding: 8px;"><strong style="font-weight: bold;">ลำดับ</strong></td>
                        <td style="border: 1px solid #dddddd;padding: 8px;" class="text-center"><strong style="font-weight: bold;">รายการ</strong></td>
                        <td style="border: 1px solid #dddddd;padding: 8px;" class="text-center"><strong style="font-weight: bold;">จำนวนเงิน (บาท)</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border: 1px solid #dddddd;padding: 8px;text-align:center;">1</td>
                        <td style="border: 1px solid #dddddd;padding: 8px;"><strong style="font-weight: bold;">ค่าบริการและภาษี</strong> (4.07%)</td>
                        <td style="border: 1px solid #dddddd;padding: 8px;" class="text-center"><?php echo number_format($row["fee_pay"]) ?></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #dddddd;padding: 8px;text-align:center;">2</td>
                        <td style="border: 1px solid #dddddd;padding: 8px;"><strong style="font-weight: bold;">ค่าเช่า</strong>
                            <?php
                            if ($row["INV_discount"] != 0) {
                                echo '(หักค่ามัดจำแล้ว ' . $row["INV_discount"] . ' บาท)';
                            } else {
                                echo '';
                            }
                            ?></td>
                        <td style="border: 1px solid #dddddd;padding: 8px;" class="text-center"><?php echo number_format($row["INV_rentprice"] - $row["INV_discount"]) ?></td>
                    </tr>
                    <?php
                    $numRowsop4 = mysqli_num_rows($qrycost4);
                    if ($numRowsop4 > 0) {
                        $count = 2;
                        $cost = 0;
                        while ($rowc = mysqli_fetch_assoc($qrycost4)) :
                            $unit = floor($rowc["price"] / $rowc["price/unit"]);
                            if ($rowc["unit"] == "(เหมาจ่าย)") {
                                $detail = '';
                            } else {
                                $detail =  " x " . number_format($unit) . " หน่วย = " . number_format($rowc["price"]) . " บาท";
                            }
                    ?>
                            <tr>
                                <td style="border: 1px solid #dddddd;padding: 8px;text-align:center;"><?php echo $count + 1 ?></td>
                                <td style="border: 1px solid #dddddd;padding: 8px;"><strong style="font-weight: bold;"><?php echo $rowc["cost_name"] ?></strong></td>
                                <td style="border: 1px solid #dddddd;padding: 8px;" class="text-center"><?php echo number_format($rowc["price"]) ?></td>
                            </tr>
                    <?php
                            $cost = $cost + $rowc["price"];
                            $count++;
                        endwhile;
                    } else {
                        $cost = 0;
                    }
                    ?>
                    <tr style="border: 1px solid #dddddd;">
                        <td style="border: 1px solid #dddddd;padding: 8px;" colspan="2"><strong style="font-weight: bold;">รวมทั้งสิ้น</strong> </td>
                        <td style="border: 1px solid #dddddd;padding: 8px;" class="text-center"><strong style="font-weight: bold;"><?php echo number_format($rowp["total"]) ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <table class="w-100" style="font-size:20px;margin-top:10px;">
            <tr>
                <td>
                    <strong style="font-weight: bold;">รหัสการชำระเงิน</strong> <?php echo $rowp["token_pay"] ?>
                </td>
                <td align="right">
                    <strong style="font-weight: bold;">ชำระเมื่อ</strong> <?php echo  date("d/m/Y เวลา h:ia", strtotime($rowp['timestamp'])) ?>
                </td>
            </tr>
        </table>
    </div>
    <?php
    $html = ob_get_contents();
    $mpdf->WriteHTML($html);
    $mpdf->Output("reciept-billrent.pdf");
    ob_end_flush(); ?>

</body>