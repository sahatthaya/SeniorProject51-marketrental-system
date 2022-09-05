<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - แก้ไขแผนผังตลาด</title>

    <!-- css  -->
    <link rel="stylesheet" href="../css/market-plan.css" type="text/css">

    <?php
    include "profilebar.php";
    include "nav.php";
    include "../backend/1-connectDB.php";
    include "../backend/1-import-link.php";
    $mkr_id = $_GET['mkr_id'];
    $count_n = 1;
    $data2 = "SELECT stall.*, zone.z_color FROM stall JOIN zone ON (stall.z_id = zone.z_id) WHERE (market_id = '$mkr_id')";
    $result3 = mysqli_query($conn, $data2);
    $zone = mysqli_query($conn, "SELECT * FROM `zone`");
    require "../backend/manage-edit-Stall.php";
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
    $row = mysqli_fetch_array($result);
    extract($row);
    ?>

</head>
<script type="text/javascript">
    $(document).ready(function() {

        var $boxstall = $("#plan"),
            $list = $(".liststall");

        // sortable list 
        $("#sortable, #plan").sortable({
            revert: "invalid",
            connectWith: ".connectedSortable",
        }).disableSelection().css("position", "relative");

        // ลาก แก้ไซส์
        $(".stallbox").draggable({
            connectToSortable: "#sortable",
            contaiment: ".liststall #plan",
            cursor: "move",
            revert: "invalid",

        }).resizable({
            contaiment: "parant",
            cursor: "move",
            autoHide: true,

        });

        // ดรอปไปแพลน
        $boxstall.droppable({
            drop: function(event, ui) {
                $(ui.helper).draggable({
                        connectToSortable: "#sortable",
                        contaiment: ".liststall #plan",
                        cursor: "move",
                        revert: "invalid",
                        stack: "#plan div",
                        stop: function(event, ui) {
                            var pos_x = ui.offset.left;
                            var pos_y = ui.offset.top;
                            var need = ui.helper.data("need");

                            console.log(pos_x);
                            console.log(pos_y);
                            console.log(need);
                        }

                    })
                    .css("position", "absolute");
            }
        });

        // ดรอปกลับมาที่ลิส
        $list.droppable({
            classes: {
                accept: "#plan .stallbox"
            },

            drop: function(event, ui) {
                $(ui.helper).draggable({
                        connectToSortable: "#sortable",
                        contaiment: ".liststall #plan",
                        cursor: "move",
                        revert: "invalid",

                    }).css("width", "200")
                    .css("height", "30");
            }
        });

        $('.save-stall').click(function save() {

            $.ajax({
                type: "POST",
                url: "../backend/manage-edit-Stall.php",
                data: {
                    x: pos_x,
                    y: pos_y,
                    skey: need
                },
                success: function(data) {
                    alert(data);
                }
            });

        })


    });

    // $(document).ready(function() {
    //     $('#save').click(function() {
    //         $(ui.helper).on("dragstop", function(event, ui) {
    //             var pos_x =  $(ui.helper).offset.left;
    //             var pos_y =  $(ui.helper).offset.top;
    //             var need =  $(ui.helper).data("need");
    //         });
    //         $.ajax({
    //             type: "POST",
    //             url: "../backend/manage-edit-Stall.php",
    //             data: {
    //                 x: pos_x,
    //                 y: pos_y,
    //                 skey: need
    //             },
    //             success: function(data) {
    //                 alert(data);
    //             }
    //         });

    //     })
    // });
</script>

<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item fs-5 "><a href="edit-Stall.php?mkr_id=<?php echo $row['mkr_id'] ?>" class="text-decoration-none">จัดการข้อมูลแผงค้า<?php echo $row['mkr_name']; ?></a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">จัดการข้อมูลแผงค้า <?php echo $row['mkr_name']; ?></li>
        </ol>
    </nav>

    <h1>แก้ไขแผนผังตลาด</h1>

    <div class="content">
        <div class="plan">
            <div class="w-100 hstack justify-content-between px-1 pt-3">
                <h3 class="ms-3">แผนผังตลาด </h3>
                <button type="button" class="btn btn-outline-success save-stall" id="save">บันทึกแผนผัง</button>
            </div>
            <hr>
            <div id="plan">

            </div>
        </div>
        <div class="list">
            <div class="w-100  pt-3 pb-1">
                <h3 class="center hstack gap-2">รายการแผงค้า <i class='bx bx-info-circle opacity-50 text-primary' data-bs-toggle="modal" data-bs-target="#exampleModal"></i></h3>
            </div>
            <hr>
            <div class="liststall vstack" id="sortable">
                <?php while ($row1 = $result3->fetch_assoc()) : ?>
                    <li class="m-1 ">
                        <div class="stallbox" style="background-color:<?php echo $row1['z_color'] ?> ;" data-need="<?php echo $row1['sKey'] ?>">
                            <div class="text-center stallnum">
                                <div class="mx-auto text-wrap">แผงค้า : <span><?php echo $row1['sID'] ?></span></div>
                            </div>
                        </div>
                    </li>
                <?php endwhile ?>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เกี่ยวกับรายการแผงค้า</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    แผงค้าจะมีสีตามประเภทที่ได้กำหนดไว้ดังนี้
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ประเภท</th>
                                <th scope="col">สี</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($z = $zone->fetch_assoc()) : ?>

                                <tr>
                                    <td> <?php echo $count_n ?></td>
                                    <td><?php echo $z['z_name'] ?></td>
                                    <td>
                                        <div class="text-center rounded" style="background-color:<?php echo $z['z_color'] ?> ;width:150px;color:white;"> ตัวอย่างแผงค้า</div>
                                    </td>

                                <?php $count_n++;
                            endwhile ?>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>


</html>