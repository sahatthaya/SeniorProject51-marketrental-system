<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการแผงค้า</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/editStall.css" type="text/css">
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>
<script type="text/javascript">
    function success() {
        Swal.fire({
            title: 'บันทึกข้อมูลสำเร็จ',
            icon: 'success',
            showConfirmButton: false,
            timer: 2500
        })
    }

    function delsuccess() {
        Swal.fire({
            title: 'ลบข้อมูลสำเร็จ',
            icon: 'success',
            showConfirmButton: false,
            timer: 2500
        })
    }

    function error() {
        Swal.fire({
            title: 'ผิดพลาด',
            text: 'เกิดข้อผิดพลาดกรุณาลองอีกครั้ง',
            icon: 'error',
            showConfirmButton: false,
            timer: 2500
        })
    }
</script>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
$mkr_id = $_GET['mkr_id'];
$count_n = 1;
$data2 = "SELECT * FROM stall WHERE (market_id = '$mkr_id')";
$result3 = mysqli_query($conn, $data2);
$costunit = "SELECT * FROM `cost/unit` WHERE mkr_id = '$mkr_id'";
$resultCU = mysqli_query($conn, $costunit);
$numCU = mysqli_num_rows($resultCU);

require "../backend/manage-edit-Stall.php";

if (isset($_POST['submit-edit'])) {
    $costunit = "SELECT * FROM `cost/unit` WHERE mkr_id = '$mkr_id'";
    $resultCU = mysqli_query($conn, $costunit);
    $num = mysqli_num_rows($resultCU);
}

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
            echo "<script>alert ('ผิดพลาด ไม่สามารถเพิ่มข้อมูลได้');</script>";
        }
    } else {
        echo "<script>alert ('ข้อมูลไม่เข้า');</script>";
    }
}
// เพิ่มแผงค้า
if (isset($_POST['stall-submit'])) {
    $sID = $_POST['sID'];
    $sWidth = $_POST['sWidth'];
    $sHeight = $_POST['sHeight'];
    $sAreaUnit = $_POST['sAreaUnit'];
    $sDept = $_POST['sDept'];
    $sPayRange = $_POST['sPayRange'];
    $sRent = $_POST['sRent'];
    if (isset($_POST['sID']) != "" && isset($_POST['sWidth']) != "" && isset($_POST['sHeight']) != "" && isset($_POST['sAreaUnit']) != "" && isset($_POST['sDept']) != "" && isset($_POST['sPayRange']) != "") {
        $sqlInsert = "INSERT INTO stall (sID,sWidth,sHeight,sAreaUnit,sDept,sPayRange,dropped,market_id,sRent,sStatus) VALUES ('$sID','$sWidth','$sHeight','$sAreaUnit','$sDept','$sPayRange','0', $mkr_id,$sRent,'ว่าง') ";
        $sql = mysqli_query($conn, $sqlInsert);
        if ($sql) {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1"; URL=../users-market/edit-stall.php" />';
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง');</script>";
        }
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง);</script>";
    }
}

// ลบแผงค้า
if (isset($_GET['delstall'])) {
    $sKey = $_GET['delstall'];
    $mkr_id = $_GET['mkr_id'];
    $sqlDelUsers = "DELETE FROM stall WHERE sKey = ' $sKey'";
    if (mysqli_query($conn, $sqlDelUsers)) {
        echo "<script type='text/javascript'> delsuccess(); </script>";
    } else {
        echo "<script type='text/javascript'> error(); </script>";
    }
}

if (isset($_GET['delcu_id']) && isset($_GET['mkr_id'])) {
    $cu_id = $_GET['delcu_id'];
    $mkr_id = $_GET['mkr_id'];

    $delCU = "DELETE FROM `cost/unit` WHERE  cu_id = $cu_id";
    $sqldelCU = mysqli_query($conn, $delCU);
    if ($sqldelCU) {
        echo "<script type='text/javascript'> delsuccess(); </script>";
    } else {
        echo "<script type='text/javascript'> error(); </script>";
    }
}

?>
<script src="../backend/script.js"></script>

<body>
    <h1>จัดการข้อมูลแผงค้า</h1>

    <div id="quick-menu2" class="mt-3">
        <button type="button" class="btn btn-primary add-btn " id="partner-btn" data-bs-toggle="modal" data-bs-target="#editcost-modal">
            <i class='bx bxs-edit'></i>จัดการค่าใช้จ่ายเพิ่มเติม
        </button>

        <button type="button" class="btn btn-primary add-btn " id="partner-btn" data-bs-toggle="modal" data-bs-target="#edtmkrinfo-modal">
            <i class='bx bx-plus-circle'></i>เพิ่มแผงค้า
        </button>
        <a type="button" class="btn btn-primary add-btn" id="merchant-btn" href="marketPlan.php?mkr_id=<?php echo $mkr_id = $_GET['mkr_id']; ?>">
            <i class='bx bxs-message-square-edit'></i>ปรับแก้แผนผังตลาด
        </a>
    </div>
    <!-- Modal -->
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
                                <div class="col-sm-3"> <input type="text" class="form-control w-60" name="cu_name" placeholder="ค่าใช้จ่าย เช่น ค่าขยะ "></div>
                                <div class="col-sm-7">
                                    <div class="input-group mb-3">
                                        <input type="number" name="mkr_id" value="<?php echo $mkr_id ?>" hidden>
                                        <input type="number" class="form-control w-50" name="cu_price" placeholder="จำนวนเงิน เช่น 100">
                                        <select class="form-select" aria-label="Default select example" name="cu_type">
                                            <option selected value="บาท/หน่วย">บาท/หน่วย</option>
                                            <option value="บาท(เหมาจ่าย)">บาท(เหมาจ่าย)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" name="addcost" class="btn btn-primary">
                                        <i class='bx bxs-plus-circle me-2'></i>เพิ่ม
                                    </button>
                                </div>
                            </div>
                    </form>
                    <hr>
                    <form method="POST">
                        <div class="mb-3 row">
                            <?php while ($row = $resultCU->fetch_assoc()) : ?>
                                <div class="col-sm-3"> <input type="text" class="form-control w-60" name="cu_name" placeholder="ค่าใช้จ่าย เช่น ค่าขยะ " value="<?php echo $row['cu_name'] ?>"></div>
                                <div class="col-sm-7">
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control w-50" aria-label="Text input with dropdown button" placeholder="จำนวนเงิน เช่น 100" value="<?php echo $row['cu_price'] ?>">
                                        <select class="form-select" aria-label="Default select example">
                                            <option value="<?php echo $row['cu_type'] ?>" selected><?php echo $row['cu_type'] ?></option>
                                            <option value="บาท/หน่วย">บาท/หน่วย</option>
                                            <option value="บาท(เหมาจ่าย)">บาท(เหมาจ่าย)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <a type="button" name="delcost" class="btn btn-danger" href="edit-Stall.php?delcu_id=<?php echo $row['cu_id'] ?>&mkr_id=<?php echo $row['mkr_id'] ?>">
                                        <i class='bx bxs-x-circle me-2'></i>ลบ
                                    </a>
                                </div>
                            <?php
                            endwhile ?>
                        </div>
                        <hr>
                        <div class="d-flex ">
                            <button type="submit" name="submit-edit" class="btn btn-primary">บันทึกการแก้ไข</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
            </div> -->
    </div>
    </div>
    </div>
    <!--stall Modal -->
    <div id="edtmkrinfo-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <form method="POST" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">เพิ่มแผงค้า</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <label>รหัสแผงค้า :</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="stallID" aria-label="รหัสแผงค้า" name="sID" title="กรุณากรอกรหัสแผงค้า เช่น รหัสแผงค้า A01" require>
                    </div>
                    <label>ขนาดพื้นที่ :</label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="กว้าง" name="sWidth" title="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" require>
                        <span class="input-group-text">*</span>
                        <input type="number" class="form-control" placeholder="ยาว" name="sHeight" title="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" require>
                        <select class="input-group-text" id="inputGroupSelect01" name="sAreaUnit">
                            <option selected value="เมตร">เมตร</option>
                            <option value="เซนติเมตร">เซนติเมตร</option>
                        </select>
                    </div>
                    <label>ราคามัดจำ :</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="sDept" title="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" require>
                        <span class="input-group-text">บาท</span>
                    </div>
                    <label>ราคาค่าเช่า :</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="sRent" title="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" require>
                        <select class="input-group-text" name="sPayRange">
                            <option value="บาท/วัน">บาท/วัน</option>
                            <option value="บาท/เดือน">บาท/เดือน</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary" name="stall-submit">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>
    <div id="content">
        <div id="table2" class="bannertb border p-3 shadow-sm rounded mt-3">
            <table id="myTable" class="display " style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">รหัสแผงค้า</th>
                        <th scope="col">ขนาดพื้นที่</th>
                        <th scope="col">ราคามัดจำ (บาท)</th>
                        <th scope="col">ราคาค่าเช่า</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col">ประวัติการจองแผงค้า</th>
                        <th scope="col">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row1 = $result3->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $count_n; ?></td>
                            <td><?php echo $row1['sID'] ?></td>
                            <td><?php echo $row1['sWidth'] . ' * ' . $row1['sHeight'] . ' ' . $row1['sAreaUnit']; ?></td>
                            <td><?php echo $row1['sDept']; ?></td>
                            <td><?php echo $row1['sRent'] . ' ' . $row1['sPayRange']; ?></td>
                            <td><?php echo $row1['sStatus']; ?></td>
                            <td>
                                <button class=" btn btn-outline-info">ดูประวัติการจอง</button>
                            </td>
                            <td>
                                <div class="row" style="justify-content: center;">
                                    <a class="btn btn-outline-success col-md-4 modal_data" style="text-align:center;padding: 4px 0;" id="<?php echo $row1['sKey']; ?>">แก้ไข</a>
                                    <a href="edit-Stall.php?delstall=<?php echo $row1['sKey']; ?>;&mkr_id=<?php echo $row1['market_id']; ?>;" onclick="return confirm('คุณต้องการลบแผงค้านี้หรือไม่')" class=" btn btn-outline-danger col-md-4" style="text-align:center;padding: 4px 0;margin-left:2px;">ลบ</a>
                                </div>
                            </td>
                        </tr>

                    <?php $count_n++;
                    endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php require '../backend/modal-edit-Stall.php' ?>
</body>

<script>
    // apply detail popup
    $(document).ready(function() {
        $('.modal_data').click(function() {
            var sKey = $(this).attr("id");
            $.ajax({
                url: "../backend/manage-edit-Stall.php",
                method: "POST",
                data: {
                    sKey: sKey
                },
                success: function(data) {
                    $('#bannerdetail').html(data);
                    $('#bannerdataModal').modal('show');
                }
            });

        })
    });
</script>

</html>