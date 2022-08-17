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
    // $(document).ready(function() {
    //     var x; // To store cloned div

    //     $(".div_1").draggable({
    //         helper: "clone",
    //         cursor: "move",
    //         revert: true
    //     });


    //     $(".plan").droppable({
    //         drop: function(event, ui) {
    //             x = ui.helper.clone(); 
    //             ui.helper.remove(); 
    //             x.appendTo('.plan'); 
    //             x.draggable({
    //                 cursor: "move",
    //                 revert: true,
    //                 containment: "parent"
    //             });
    //         }
    //     });

    // });

    $(document).ready(function() {
        var $boxstall = $(".plan"),
            $list = $(".list");
        // $("#sortable").sortable({
        //     revert: true
        // });
        // $( "ul, li" ).disableSelection();

        $(".stallbox", $list).draggable({
            // connectToSortable: "#sortable",
            contaiment: ".list",
            cursor: "move",
            // revert: "invalid"
        });
        $list.droppable({
            classes: {
                accept: ".plan > .stallbox"
            },
            drop: function(event, ui) {
                revert(ui.draggable)

            }
        });
        $boxstall.droppable({
            accept: ".list .stallbox",
            classes: {
                "ui-droppable-active": "custom-state-active"
            },
            drop: function(event, ui) {
                revertToPlan(ui.draggable);

            }
        });


        function revert($item) {
            $item.appendTo($list).fadeIn(function() {
                var $stalllist = $("ul", $list).length ?
                    $("ul", $list) :
                    $("<ul class='gallery ui-helper-reset'/>").appendTo($list);
                $item
                    .animate({
                        width: "250px",
                        height: "50px"

                    })
            });
        }

        function revertToPlan($item) {
            $item.fadeOut(function() {
                $item
                    .css("width", "100px")
                    .css("height", "100px")
                    .find("img")
                    .end()
                    .appendTo($boxstall)
                    .fadeIn();
            });
        }
    });

    // function stallFunction() {
    //     var stall = document.getElementById("stallID").value;
    //     var div = document.createElement('div');
    //     div.classList.add("stallbox");
    //     div.setAttribute("name", stall);
    //     div.innerHTML = stall;
    //     $(div).appendTo(".plan");
    // };
</script>

<body>
    <h1>แก้ไขแผนผังตลาด</h1>
    <div id="quick-menu2" class="hstack">
        <button type="button" class="btn btn-primary add-btn " id="partner-btn" data-bs-toggle="modal" data-bs-target="#edtmkrinfo-modal">
            <i class='bx bx-plus-circle'></i>เพิ่มแผงค้า
        </button>
        <button type="button" class="btn btn-primary add-btn" id="merchant-btn" onclick="window.location='marketPlan.php';">
            <i class='bx bxs-message-square-edit'></i>จัดการข้อมูลแผงค้า
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
        <div class="plan" id="plan">
        <h3 class="center">แผนผังตลาด</h3>

        </div>
        <div class="list">
            <h3 class="center">รายการแผงค้า</h3>
            <ul id="sortable">
                <?php while ($row1 = $result3->fetch_assoc()) : ?>
                    <li>
                        <div class="stallbox">
                         รหัสแผงค้า:   <?php echo $row1['sID'] ?>
                        </div>
                    </li>
                <?php
                endwhile ?>
            </ul>

        </div>
    </div>
</body>


</html>