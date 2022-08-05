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

    <?php
    include "profilebar.php";
    include "nav.php";
    include "../backend/1-connectDB.php";
    include "../backend/1-import-link.php";
    $mkr_id = $_GET['mkr_id'];
    $count_n = 1;
    $data2 = "SELECT * FROM stall WHERE (market_id = '$mkr_id')";
    $result3 = mysqli_query($conn, $data2);
    require "../backend/manage-editStall.php";
    ?>

</head>
<script src="../backend/script.js"></script>

<body>
    <h1>จัดการข้อมูลแผงค้า</h1>
    <div id="quick-menu2" class="hstack">
        <button type="button" class="btn btn-primary add-btn " id="partner-btn" data-bs-toggle="modal" data-bs-target="#edtmkrinfo-modal">
            <i class='bx bx-plus-circle'></i>เพิ่มแผงค้า
        </button>
        <a type="button" class="btn btn-primary add-btn" id="merchant-btn" href="marketPlan.php?mkr_id=<?php echo $mkr_id = $_GET['mkr_id']; ?>">
            <i class='bx bxs-message-square-edit'></i>ปรับแก้แผนผังตลาด
</a>
    </div>

    <!-- Modal -->
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
        <div id="table2">
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
                            <td><?php echo $row1['sID']?></td>
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
                                    <a href="../backend/manage-editStall.php?delstall=<?php echo $row1['sKey']; ?>" onclick="return confirm('คุณต้องการลบคำร้องนี้หรือไม่')" class=" btn btn-outline-danger col-md-4" style="text-align:center;padding: 4px 0;margin-left:2px;">ลบ</a>
                                </div>
                            </td>
                        </tr>

                    <?php $count_n++;
                    endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php require '../backend/modal-editStall.php' ?>
</body>

<script>
    // apply detail popup
    $(document).ready(function() {
        $('.modal_data').click(function() {
            var sKey = $(this).attr("id");
            $.ajax({
                url: "../backend/manage-editStall.php",
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