<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขแผนผังตลาด</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/market-plan.css" type="text/css">

    <?php
    include "profilebar.php";
    include "nav.php";
    include "../backend/1-connectDB.php";
    include "../backend/1-import-link.php";
    $mkr_id = $_GET['mkr_id'];
    $count_n = 1;
    $data2 = "SELECT * FROM stall WHERE (market_id = '$mkr_id')";
    $result3 = mysqli_query($conn, $data2);
    require "../backend/manage-edit-Stall.php";
    ?>

</head>
<script>
    $(document).ready(function() {

        var $boxstall = $(".plan"),
            $list = $(".list"),
            x;

        // sortable list 
        $("#sortable, #plan").sortable({
            revert: "invalid",
            connectWith: ".connectedSortable",
        }).disableSelection();

        // ลากได้ ถ้าไม่ดรอปจะrevert กลับมา
        $(".stallbox").draggable({
            connectToSortable: "#sortable",
            contaiment: ".list .plan",
            cursor: "move",
            revert: "invalid",

        });

        // ดรอปไปแพลน
        $boxstall.droppable({
            drop: function(event, ui) {
                $(ui.helper).draggable({
                        connectToSortable: "#sortable",
                        contaiment: ".list .plan",
                        cursor: "move",
                        revert: "invalid",

                    })
                    .resizable({
                        contaiment: "parant",
                        cursor: "move",
                        css: "position:absolute"
                    }).css("width", "100")
                    .css("height", "100");
            }
        });

        // ดรอปกลับมาที่ลิส
        $list.droppable({
            classes: {
                accept: ".plan .stallbox"
            },

            drop: function(event, ui) {
                $(ui.helper).draggable({
                        connectToSortable: "#sortable",
                        contaiment: ".list .plan",
                        cursor: "move",
                        revert: "invalid",

                    }).css("width", "200")
                    .css("height", "50").resizable('disable');
            }
        });
    });
</script>

<body>
    <h1>แก้ไขแผนผังตลาด</h1>
    <div id="quick-menu2" class="hstack">
        <button type="button" class="btn btn-primary add-btn " id="partner-btn" data-bs-toggle="modal" data-bs-target="#edtmkrinfo-modal">
            <i class='bx bx-plus-circle'></i>เพิ่มแผงค้า
        </button>
        <a type="button" class="btn btn-primary add-btn" id="merchant-btn" href="edit-stall.php?mkr_id=<?php echo $mkr_id = $_GET['mkr_id']; ?> ">
            <i class='bx bxs-message-square-edit'></i>จัดการข้อมูลแผงค้า
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
    <div class="content">
        <div class="plan">
            <h3 class="center">แผนผังตลาด</h3>
            <div id="plan"></div>
        </div>
        <div class="list">
            <h3 class="center">รายการแผงค้า</h3>
            <div class="liststall vstack" id="sortable">
                <?php while ($row1 = $result3->fetch_assoc()) : ?>
                    <li class="m-1 ">
                        <div class="stallbox">
                            รหัสแผงค้า: <?php echo $row1['sID'] ?>
                        </div>
                    </li>
                <?php endwhile ?>

            </div>
        </div>
    </div>
</body>


</html>