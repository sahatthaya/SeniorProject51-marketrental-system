<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขแผนผังตลาด</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/market-plan.css" type="text/css">
    <link rel="stylesheet" href="../css/banner.css" type="text/css">


    <?php
    include "profilebar.php";
    include "nav.php";
    include "../backend/connectDB.php";
    include "../backend/import-link.php";
    require "../backend/managemarketPlan.php";
    ?>

</head>


<body>
    <h1>จัดการข้อมูลแผงค้า</h1>
    <div id="quick-menu2" class="hstack">
        <button type="button" class="btn btn-primary add-btn " id="partner-btn" data-bs-toggle="modal" data-bs-target="#edtmkrinfo-modal">
            <i class='bx bx-plus-circle'></i>เพิ่มแผงค้า
        </button>
        <button type="button" class="btn btn-primary add-btn" id="merchant-btn" data-bs-toggle="modal" data-bs-target="#edtmkrinfo-modal">
            <i class='bx bxs-message-square-edit'></i>ปรับแก้แผนผังตลาด
        </button>
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
                        <input type="text" class="form-control" id="stawID" aria-label="รหัสแผงค้า">
                    </div>
                    <label>ขนาดพื้นที่ :</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="กว้าง" aria-label="Username">
                        <span class="input-group-text">X</span>
                        <input type="text" class="form-control" placeholder="ยาว" aria-label="Server">
                        <select class="input-group-text" id="inputGroupSelect01">
                            <option selected>เมตร</option>
                            <option value="1">เซนติเมตร</option>
                        </select>
                    </div>
                    <label>ราคามัดจำ :</label>
                    <div class="input-group">
                        <input type="text" class="form-control" aria-label="รหัสแผงค้า">
                        <span class="input-group-text">บาท</span>
                    </div>
                    <label>ราคาค่าเช่า :</label>
                    <div class="input-group">
                        <input type="text" class="form-control" aria-label="รหัสแผงค้า">
                        <select class="input-group-text" id="inputGroupSelect01">
                            <option selected>บาท/วัน</option>
                            <option value="1">บาท/เดือน</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary" name="bn-submit">บันทึกข้อมูล</button>
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
                        <th scope="col">ราคามัดจำ</th>
                        <th scope="col">ราคาค่าเช่า</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col">ประวัจิการจอง</th>
                        <th scope="col">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row1 = $result3->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $count_n; ?></td>
                            <td><?php echo $row1['timestamp'] ?></td>
                            <td><?php echo $row1['bn_toppic']; ?></td>
                            <td><?php echo $row1['username']; ?></td>
                            <td><button name="view" type="button" class="modal_data1 btn btn-outline-primary" id="<?php echo $row1['req_an_id']; ?>">ดูรายละเอียด</button></td>
                            <td>
                                <div class="row" style="justify-content: center;">
                                    <a href="../backend/manageannouce.php?approve=<?php echo $row1['req_an_id']; ?>" onclick="return confirm('คุณต้องการอนุมัติคำร้องนี้หรือไม่')" class=" btn btn-outline-success col-md-4" id="" style="margin-right: 2px; font-size:14px;">อนุมัติ</a>
                                    <a href="../backend/manageannouce.php?denied=<?php echo $row1['req_an_id']; ?>" onclick="return confirm('คุณต้องการลบคำร้องนี้หรือไม่')" class=" btn btn-outline-danger col-md-4" style="margin-left: 2px; font-size:14px;">ลบ</a>
                                </div>
                            </td>
                        </tr>
                    <?php $count_n++;
                    endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
</body>


</html>