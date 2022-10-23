<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - แก้ไขข้อมูลแผงค้า</title>

    <!-- css  -->
    <link rel="stylesheet" href="../css/editStall.css" type="text/css">

</head>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
$sKey = $_GET['sKey'];
$count_n = 1;
$data2 = "SELECT stall.*, zone.* ,market_detail.* FROM stall 
JOIN zone ON (stall.z_id = zone.z_id)
JOIN market_detail ON (stall.market_id = market_detail.mkr_id)
 WHERE (sKey = '$sKey')";
$row = mysqli_query($conn, $data2);
$s = mysqli_fetch_array($row);
extract($s);

$z_qry = "SELECT * FROM `zone`";
$z = mysqli_query($conn, $z_qry);


require "../backend/manage-edit-Stall.php";
?>
<script src="../backend/script.js"></script>


<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item fs-5 "><a href="edit-Stall.php?mkr_id=<?php echo $s['mkr_id']; ?>" class="text-decoration-none">จัดการข้อมูลแผงค้า <?php echo $s['mkr_name']; ?></a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">แก้ไขข้อมูลแผงค้า <?php echo $s['mkr_name']; ?></li>
        </ol>
    </nav>
    <h1>แก้ไขข้อมูลแผงค้า</h1>
    <!-- content -->
    <div class="border rounded shadow-sm p-3 mt-3">
        <form method="POST">
            <label class="hstack mt-2">รหัสแผงค้า :
                <div data-toggle="tooltip" title="รหัสแผงค้าภายในตลาดเดียวกัน จะไม่สามารถซ้ำกันได้" class="mt-1 ms-2">
                    <i class='bx bx-info-circle'></i>
                </div>
            </label>
            <div class="input-group">
                <input type="text" class="form-control" id="stallID" aria-label="รหัสแผงค้า" name="sKey" placeholder="กรุณากรอกรหัสแผงค้า เช่น รหัสแผงค้า A01" value="<?php echo $s['sKey']; ?>" require hidden>
                <input type="text" class="form-control" id="stallID" aria-label="รหัสแผงค้า" name="sID" placeholder="กรุณากรอกรหัสแผงค้า เช่น รหัสแผงค้า A01" value="<?php echo $s['sID']; ?>" require disabled>
            </div>
            <label for="" class="mt-2">ประเภทแผงค้า</label>
            <div class="search_select_box">
                <select class="selectpicker dropdown" title="เลือกประเภท" name="z_id" data-live-search="true" data-width="100%" data-size="5" required>
                    <option value="<?php echo $s['z_id']; ?>" selected><?php echo $s['z_name']; ?></option>
                    <?php while ($zone = mysqli_fetch_array($z)) :; ?>
                        <option value="<?php echo $zone['z_id']; ?>"><?php echo $zone['z_name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <label class="mt-2">ขนาดพื้นที่ :</label>
            <div class="input-group">
                <input type="number" class="form-control " placeholder="กว้าง" name="sWidth" placeholder="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" require value="<?php echo $s['sWidth'] ?>">
                <span class="input-group-text">*</span>
                <input type="number" class="form-control" placeholder="ยาว" name="sHeight" placeholder="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" require value="<?php echo $s['sHeight'] ?>">
                <span class="input-group-text">เมตร</span>

            </div>
            <label class="mt-2">ราคามัดจำ :</label>
            <div class="input-group">
                <input type="number" class="form-control" name="sDept" placeholder="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" require value="<?php echo $s['sDept'] ?>">
                <span class="input-group-text">บาท</span>
            </div>
            <label class="mt-2">ราคาค่าเช่า :</label>
            <div class="input-group">
                <input type="number" class="form-control" name="sRent" placeholder="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" require value="<?php echo $s['sRent'] ?>">
                <select class="input-group-text" name="sPayRange">
                    <option value="<?php echo $s['sPayRange']; ?>"><?php echo $s['sPayRange']; ?></option>
                    <option value="บาท/วัน">บาท/วัน</option>
                    <option value="บาท/เดือน">บาท/เดือน</option>
                </select>
            </div>
            <div class="mt-2 hstack gap-2">
                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="show" <?php echo ($s['show'] == "1" ? "checked" : ""); ?>>
                <label class="form-check-label" for="flexCheckDefault">
                    แสดงแผงค้านี้บนแผนผังตลาด
                </label>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary mt-3" name="edtStall-submit">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>

</body>

<script>
    $(document).ready(function() {
        $("body").tooltip({
            selector: '[data-toggle=tooltip]',
            placement: 'right'
        });
    });
</script>

</html>