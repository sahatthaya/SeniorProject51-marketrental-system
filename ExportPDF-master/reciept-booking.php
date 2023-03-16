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
include "./profilebar-merchant.php";
include "./nav-merchant.php";
include "../backend/1-connectDB.php";

if (isset($_GET["b_id"])) {
  $id = $_GET["b_id"];
  $nav = $_GET["nav"];
  $resultdata = mysqli_query($conn, "SELECT * FROM market_detail,booking,stall,provinces,amphures,districts WHERE booking.stall_id=stall.sKey and stall.market_id = market_detail.mkr_id AND market_detail.province_id = provinces.id and market_detail.	amphure_id = amphures.id and market_detail.district_id = districts.id and b_id = '4'");
  $row = mysqli_fetch_array($resultdata);
  extract($row);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> MarketRental - ข้อมูลการจองแผงค้า</title>
  <link href="https://fonts.googleapis.com/css?family=Sarabun&;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/banner.css" type="text/css">
  <link rel="stylesheet" href="../css/reciept.css" type="text/css">
</head>

<body>
  <nav aria-label="breadcrumb mb-3">
    <ol class="breadcrumb ">
      <?php if ($nav == "r") { ?>
        <li class="breadcrumb-item fs-5 "><a href="../users-merchant/rent.php" class="text-decoration-none">จัดการการจอง</a></li>
      <?php } else { ?>
        <li class="breadcrumb-item fs-5 "><a href="../users-merchant/rent-history.php" class="text-decoration-none">ประวัติการจองแผงค้า</a></li>
      <?php } ?>

      <li class="breadcrumb-item active fs-5" aria-current="page">ข้อมูลการจองแผงค้า</li>
    </ol>
  </nav>
  <div class="content">
    <h1 id="headline">ข้อมูลการจองแผงค้า</h1>
    <h1 id="headline" hidden>ข้อมูลการจองแผงค้า</h1>

    <div class="border p-3 shadow-sm rounded mt-2">
      <div id="table" class="bannertb">
        <div class="d-flex justify-content-between">
          <div class="fs-5">ข้อมูลการจอง</div>
          <a href="reciept-booking.pdf" target="blank" class="btn btn-primary">ดาวน์โหลดใบเสร็จการจองแผงค้า (pdf)</a>
        </div>
        <hr>
        <table class="display table" style="width: 100%;">
          <tbody>
            <tr>
              <td width="30%"><label>ตลาด</label></td>
              <td width="70%"><?php echo $row['mkr_name'] ?></td>
            </tr>
            <tr>
              <td width="30%"><label>รหัสแผงค้า</label></td>
              <td width="70%"><?php echo  $row["sID"] ?></td>
            </tr>
            <tr>
              <td width="30%"><label>ช่วงวันที่จอง</label></td>
              <td width="70%"><?php echo date("d/m/Y", strtotime($row['b_start'])) ?> - <?php echo date("d/m/Y", strtotime($row['b_end'])) ?></td>
            </tr>
            <tr>
              <td width="30%"><label>ระยะเวลาที่จอง</label></td>
              <td width="70%"><?php echo $row["b_day"] ?> วัน</td>
            </tr>
            <tr>
              <td width="30%"><label>ราคาค่าเช่าแผง</label></td>
              <td width="70%"><?php echo number_format($row["sRent"]) ?> <?php echo $row["sPayRange"] ?></td>
            </tr>
            <tr>
              <td width="30%"><label>ราคาค่ามัดจำ</label></td>
              <td width="70%"><?php echo number_format($row["sDept"]) ?> บาท</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div id="table" class="bannertb" style="margin-top:20px ;">
        <div class="fs-5">ข้อมูลการชำระเงิน</div>
        <hr>
        <table class="table">
          <tr>
            <td width="30%"><label>รหัสการชำระ</label></td>
            <td width="70%"><?php echo $row["b_codepay"] ?></td>
          </tr>
          <tr>
            <td width="30%"><label>ชำระเงินเมื่อวันที่</label></td>
            <td width="70%"><?php echo  date("d/m/Y เวลา h:ia", strtotime($row['timestamp'])) ?></td>
          </tr>
          <tr>
            <td width="30%"><label>ค่ามัดจำ</label></td>
            <td width="70%"><?php echo number_format($row["b_deptpay"]) ?> บาท</td>
          </tr>
          <tr>
            <td width="30%"><label>ค่าบริการและภาษี <span class="text-secondary">(4.07%)</span></label></td>
            <td width="70%"><?php echo number_format($row["b_feepay"]) ?> บาท</td>
          </tr>
          <tr>
            <td width="30%"><label>รวมทั้งสิ้น</label></td>
            <td width="70%"><?php echo number_format($row["b_totalpay"]) ?> บาท</td>
          </tr>
        </table>
      </div>
    </div>
  </div>

  <?php ob_start(); ?>
  <div style="font-size:20px;" hidden>
    <div style="font-size:30px;"><strong style="font-weight: bold;">ใบเสร็จการจองแผงค้า</strong></div>
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
      <div style="font-size:22px;"><strong style="font-weight: bold;">ข้อมูลการจองแผงค้า</strong></div>
      <strong style="font-weight: bold;">ตลาด</strong> <?php echo $row['mkr_name'] ?><br>
      <strong style="font-weight: bold;">รหัสแผงค้า</strong> <?php echo  $row["sID"] ?> <br>
      <strong style="font-weight: bold;">วันที่จอง</strong> <?php echo date("d/m/Y", strtotime($row['b_start'])) ?> - <?php echo date("d/m/Y", strtotime($row['b_end'])) ?> <br>
      <strong style="font-weight: bold;">ระยะเวลาที่จอง</strong> <?php echo $row["b_day"] ?> วัน <br>
      <strong style="font-weight: bold;">ราคาค่าเช่าแผง</strong> <?php echo number_format($row["sRent"]) ?> <?php echo $row["sPayRange"] ?> <br>
      <strong style="font-weight: bold;">ราคาค่ามัดจำ</strong> <?php echo number_format($row["sDept"]) ?> บาท
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
            <td style="border: 1px solid #dddddd;padding: 8px;"><strong style="font-weight: bold;">ค่ามัดจำ</strong></td>
            <td style="border: 1px solid #dddddd;padding: 8px;" class="text-center"><?php echo number_format($row["b_deptpay"]) ?></td>
          </tr>
          <tr>
            <td style="border: 1px solid #dddddd;padding: 8px;text-align:center;">2</td>
            <td style="border: 1px solid #dddddd;padding: 8px;"><strong style="font-weight: bold;">ค่าบริการและภาษี</strong> (4.07%)</td>
            <td style="border: 1px solid #dddddd;padding: 8px;" class="text-center"><?php echo number_format($row["b_feepay"]) ?></td>
          </tr>
          <tr style="border: 1px solid #dddddd;">
            <td style="border: 1px solid #dddddd;padding: 8px;" colspan="2"><strong style="font-weight: bold;">รวมทั้งสิ้น</strong> </td>
            <td style="border: 1px solid #dddddd;padding: 8px;" class="text-center"><strong style="font-weight: bold;"><?php echo number_format($row["b_totalpay"]) ?></strong></td>
          </tr>
        </tbody>
      </table>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <table class="w-100" style="font-size:20px;margin-top:10px;">
      <tr>
        <td>
          <strong style="font-weight: bold;">รหัสการชำระเงิน</strong> <?php echo $row["b_codepay"] ?>
        </td>
        <td align="right">
          <strong style="font-weight: bold;">ชำระเมื่อ</strong> <?php echo  date("d/m/Y เวลา h:ia", strtotime($row['timestamp'])) ?>
        </td>
      </tr>
    </table>
  </div>
  <?php
  $html = ob_get_contents();
  $mpdf->WriteHTML($html);
  $mpdf->Output("reciept-booking.pdf");
  ob_end_flush();
  ?>

</body>