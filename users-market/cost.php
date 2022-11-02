<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - ข้อมูลการเงิน</title>

    <!-- css  -->
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>

<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
require "../backend/edit-market-payment.php";
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

$resultCU = mysqli_query($conn, "SELECT * FROM `cost/unit` WHERE mkr_id = '$mkr_id'");
$costunit = mysqli_query($conn, "SELECT * FROM `cost/unit` WHERE mkr_id = '$mkr_id' and cu_type = 'บาท/หน่วย'");

// เพิ่มค่าใช้จ่ายเพิ่มเติม
if (isset($_POST['addcost'])) {
    $cu_name = $_POST['cu_name'];
    $cu_price = $_POST['cu_price'];
    $cu_type = $_POST['cu_type'];
    if (isset($cu_name) != "" && isset($cu_price) != "" && isset($cu_type) != "") {
        $sqladdcost = "INSERT INTO `cost/unit`(cu_name,cu_price,mkr_id,cu_type) VALUES ('$cu_name', '$cu_price', '$mkr_id', '$cu_type')";
        if ($rssqladdcost = mysqli_query($conn, $sqladdcost)) {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1"; URL=../edit-stall.php" />';
        } else {
            echo "<script>error();</script>";
        }
    } else {
        echo "<script>error();</script>";
    }
}


if (isset($_GET['delcu_id']) && isset($_GET['mkr_id'])) {
    $cu_id = $_GET['delcu_id'];
    $mkr_id = $_GET['mkr_id'];

    $delCU = "DELETE FROM `cost/unit` WHERE  cu_id = $cu_id";
    $sqldelCU = mysqli_query($conn, $delCU);
    if ($sqldelCU) {
        echo "<script>";
        echo "
        Swal.fire({
            title: 'ลบข้อมูลสำเร็จ',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
          }).then((result) => {
              window.location.href = 'cost.php?mkr_id=" . $mkr_id . "'
          })";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'> error(); </script>";
    }
}

require "../backend/manage-edit-Stall.php";

?>

<body onload="selecttype()">
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">ค่าใช้จ่ายเพิ่มเติม <?php echo $row1['mkr_name'] ?></li>
        </ol>
    </nav>
    <h1 class="head_contact">ค่าใช้จ่ายเพิ่มเติม</h1>
    <button type="button" class="btn btn-info add-btn text-light" id="partner-btn" data-bs-toggle="modal" data-bs-target="#editcost-modal">
        <i class='bx bxs-edit me-2'></i>จัดการค่าใช้จ่ายเพิ่มเติม
    </button>


    <!-- unit/cost Modal -->
    <div class="modal fade" id="editcost-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel">จัดการค่าใช้จ่ายเพิ่มเติม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div>
                            <div class="mb-3 row">
                                <h6 class="center mt-3 mb-3">เพิ่มค่าใช้จ่ายที่ต้องการ</h6>
                                <div class="col-lg-3"> <input type="text" class="form-control w-60" name="cu_name" placeholder="ค่าใช้จ่าย เช่น ค่าขยะ "></div>
                                <div class="col-lg-5">
                                    <div class="input-group mb-3">
                                        <input type="number" name="mkr_id" value="<?php echo $mkr_id ?>" hidden>
                                        <input type="number" class="form-control" style="width: 35%;" name="cu_price" placeholder="จำนวนเงิน เช่น 100">
                                        <select class="form-select" aria-label="Default select example" name="cu_type">
                                            <option selected value="บาท/หน่วย">บาท/หน่วย</option>
                                            <option value="บาท(เหมาจ่าย)">บาท(เหมาจ่าย)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" name="addcost" class="btn btn-primary text-center" style="width: 95%;">
                                        <i class='bx bx-plus-circle me-2'></i>เพิ่มข้อมูล
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="mb-3">
                        <h6 class="center mt-3 mb-3">แก้ไขค่าใช้จ่าย</h6>
                        <?php while ($row = $resultCU->fetch_assoc()) : ?>
                            <form method="POST" class="row">
                                <input type="number" class="form-control" style="width: 35%;" aria-label="Text input with dropdown button" placeholder="จำนวนเงิน เช่น 100" value="<?php echo $row['cu_id'] ?>" name="cu_id" hidden>
                                <div class="col-lg-3"> <input type="text" class="form-control w-60" name="cu_name" placeholder="ค่าใช้จ่าย เช่น ค่าขยะ " value="<?php echo $row['cu_name'] ?>"></div>
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <input type="number" class="form-control" style="width: 35%;" aria-label="Text input with dropdown button" placeholder="จำนวนเงิน เช่น 100" value="<?php echo number_format($row['cu_price']) ?>" name="cu_price">
                                        <select class="form-select" aria-label="Default select example" name="cu_type">
                                            <option value="<?php echo $row['cu_type'] ?>" selected hidden><?php echo $row['cu_type'] ?></option>
                                            <option value="บาท/หน่วย">บาท/หน่วย</option>
                                            <option value="บาท(เหมาจ่าย)">บาท(เหมาจ่าย)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 editbtn row">
                                    <div class="col-6 pe-0 me-0">
                                        <button type="submit" name="editcost" class="btn btn-info hstack w-100 m-0" style="color:white !important;">
                                            <i class='bx bxs-save me-2'></i>บันทึก
                                        </button>
                                    </div>
                                    <div class="col-6 pe-0">
                                        <a type="button" name="delcost" class="btn btn-danger hstack w-100" href="?delcu_id=<?php echo $row['cu_id'] ?>&mkr_id=<?php echo $row['mkr_id'] ?>">
                                            <i class='bx bxs-x-circle me-2'></i>ลบ
                                        </a>
                                    </div>
                                </div>
                            </form>
                        <?php
                        endwhile ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="table2" class="border mt-3 p-3 shadow-sm rounded">
        <div class="d-flex justify-content-between">
            <h3>ตารางจดค่าใช้จ่าย <span id="span">(ค่าน้ำ)</span></h3>
            <div style="width: 15.5%;">
                <select class="form-select w-100" aria-label="Default select example" id="costtype" onchange="selecttype()">
                    <?php while ($type = $costunit->fetch_assoc()) : ?>
                        <option value="<?php echo $type['cu_name'] ?>"><?php echo $type['cu_name'] ?></option>
                    <?php
                    endwhile ?>
                </select>
            </div>
        </div>
        <hr>
        <table id="myTable" class="display " style="width: 100%;">
            <thead>
                <tr>
                    <th>
                        รหัสแผงค้า
                    </th>
                    <th>
                        เลขมิเตอร์เดือนก่อน (10/2022)
                    </th>
                    <th>
                        เลขมิเตอร์เดือนนี้ (11/2022)
                    </th>
                    <th>
                        หน่วยที่ใช้
                    </th>
                    <th>
                        คิดเป็นเงิน (บาท)
                    </th>
                    <!-- <th>
                        บันทึกข้อมูล
                    </th> -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>A01</td>
                    <td>100</td>
                    <td>
                        <input type="number" class="form-control" value="200">
                    </td>
                    <td>100</td>
                    <td>800</td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div class="center">
            <button type="button" class="btn btn-primary w-50" id="partner-btn" data-bs-toggle="modal" data-bs-target="#editcost-modal">บันทึกข้อมูล</button>
        </div>
    </div>

</body>

</html>

<script>
    function selecttype() {
        var sel = document.getElementById("costtype");
        var text = sel.options[sel.selectedIndex].text;
        const span = document.getElementById("span");
        $('#span').empty();
        document.getElementById("span").innerHTML = "(" + text + ")";
    }
</script>