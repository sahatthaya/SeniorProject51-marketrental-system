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
require "../backend/manage_cost.php";

?>

<body onload="selecttype()">
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">ค่าใช้จ่ายเพิ่มเติม <?php echo $row1['mkr_name'] ?></li>
        </ol>
    </nav>
    <h1 class="head_contact">ค่าใช้จ่ายเพิ่มเติม</h1>
    <button type="button" class="btn btn-primary add-btn text-light" id="partner-btn" data-bs-toggle="modal" data-bs-target="#editcost-modal">
        <i class='bx bxs-edit me-2'></i>จัดการค่าใช้จ่ายเพิ่มเติม
    </button>
    <a type="button" class="btn btn-primary add-btn text-light" id="partner-btn" href="cost-history.php?mkr_id=<?php echo $row1['mkr_id']?>">
    <i class='bx bx-history'></i>ประวัติการจดค่าใช้จ่ายเพิ่มเติม
    </a>

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
    <form method="post">
        <div id="table2" class="border mt-3 p-3 shadow-sm rounded">
            <div class="hstack gap-2">
                ค่าใช้จ่ายประเภท :
                <div style="width: 15.5%;">
                    <select class="form-select w-100" aria-label="Default select example" id="costtype" name="cu_id" onchange="selecttype()">
                        <?php while ($type = $costunit->fetch_assoc()) : ?>
                            <option value="<?php echo $type['cu_id'] ?>" id="<?php echo $type['cu_price'] ?>"><?php echo $type['cu_name'] ?></option>
                        <?php
                        endwhile ?>
                    </select>
                </div>
                รอบเดือน/ปี :
                <div style="width: 15.5%;">
                    <input id="date" name="cost_period" class="form-control" value="<?php echo date("Y/m"); ?>" />
                    <input type="number" id="unit" name="mkr_id" class="form-control unit" value="<?php echo $mkr_id ?>" hidden>
                    <input type="number" id="cu_price" name="cu_price" class="form-control unit" value="" hidden>
                </div>
            </div>
            <hr>
            <table id="myTable" class="display " style="width: 100%;">
                <thead>
                    <tr>
                        <th>
                            ลำดับ
                        </th>
                        <th>
                            รหัสแผงค้า
                        </th>
                        <th>
                            หน่วยที่ใช้
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = '1';
                    while ($table = $stall->fetch_assoc()) : ?>
                        <tr>
                            <td>
                                <?php echo $count ?>
                            </td>
                            <td>
                                <?php echo $table['sID'] ?>
                                <input type="number" id="unit" name="sKey<?php echo $count ?>" class="form-control unit" value="<?php echo $table['sKey'] ?>" hidden>
                            </td>
                            <td>
                                <input type="number" id="unit" name="c_unit<?php echo $count ?>" class="form-control unit" value="0" require>
                            </td>
                        </tr>
                    <?php
                        $count++;
                    endwhile
                    ?>
                </tbody>
            </table>
            <hr>
            <input type="number" id="unit" name="count_num" class="form-control unit" value="<?php echo $count - 1 ?>" hidden>

            <div class="row">
                <div class="col-6">

                </div>
                <div class="col-6 row pe-0">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary w-100" id="partner-btn" name="save-table">บันทึกข้อมูล</button>
                    </div>
                    <div class="col-6 pe-0">
                        <button type="button" class="btn btn-danger w-100" id="partner-btn" data-bs-toggle="modal" onclick="reset()">ล้างข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


</body>

</html>

<script>
    function reset() {
        var sel = document.getElementsByClassName("unit").value = '0';
    }

    function selecttype() {
        var sel = document.getElementById("costtype");
        var b = sel.options[sel.selectedIndex];
        var a = $(b).attr('id');
        // const span = document.getElementById("span");
        // $('#span').empty();
        document.getElementById("cu_price").value = a;
    }
    mobiscroll.datepicker('#date', {
        controls: ['date'],
        dateFormat: 'MM/YYYY',
        themeVariant: 'light',
        locale: mobiscroll.localeTh,
    });
</script>