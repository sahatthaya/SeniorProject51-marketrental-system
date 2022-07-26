<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลักสำหรับผู้ดูแลระบบ</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/connectDB.php";
include "../backend/import-link.php";
require "../backend/managebanner.php";
?>

<body>
    <h1 id="headline">จัดการแบบเนอร์</h1>
    <!-- carousel -->
    <div id="labelbn" class="col-12 toptb">
        <div id="labelbn" class="col-10">
        </div>
        <!-- Button modal -->
        <div id="addbn" class="col-2">
            <button id="addbn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class='bx bxs-plus-circle'></i> เพิ่มแบนเนอร์
            </button>
        </div>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide topcontent" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php
            $i = 0;
            foreach ($result as $row) {
                $actives = '';
                if ($i == 0) {
                    $actives = 'active';
                }
            ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo $actives; ?> "></button>
            <?php $i++;
            } ?>
        </div>
        <div class="carousel-inner">
            <?php
            $i = 0;
            foreach ($result as $row) {
                $actives = '';
                if ($i == 0) {
                    $actives = 'active';
                }
            ?>
                <div class="carousel-item <?php echo $actives; ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $row['bn_toppic'] ?></h5>
                        <p><?php echo $row['bn_detail'] ?></p>
                    </div>
                    <a href="<?php echo $row['bn_link'] ?>">
                        <img class="d-block w-100" src="../<?php echo $row['bn_pic']; ?>">
                    </a>
                </div>
            <?php
                $i++;
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div id="bottomcontent">
        <div id="leftcontent" class="topcontent row">
            <div class="toptb">

            </div>
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">เพิ่มแบนเนอร์</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <h6>หัวข้อ</h6>
                                <input type="text" class="form-control" placeholder="หัวข้อ" name="bn_toppic" require>
                                <h6>รายละเอียด</h6>
                                <textarea type="text" class="form-control" placeholder="รายละเอียด" name="bn_detail" require></textarea>
                                <h6>เพิ่มรูปภาพ</h6>
                                <input type="file" class="form-control" name="bn_img">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                                <button type="submit" class="btn btn-primary" name="bn-submit">เพิ่มข้อมูล</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="table" class="bannertb">
                <table id="myTable" class="display" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">หัวข้อ</th>
                            <th scope="col">ดูรายละเอียด</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result2->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $count_n; ?></td>
                                <td><?php echo $row['bn_toppic']; ?></td>
                                <td><button name="view" type="button" class="modal_data btn btn-outline-primary" id="<?php echo $row['bn_id']; ?>">ดูรายละเอียด</button></td>
                                <td> <a href="../backend/managebanner.php?bn_id=<?php echo $row['bn_id']; ?>" onclick="return confirm('คุณต้องการลบแบบเนอร์นี้หรือไม่')" class=" btn btn-outline-danger" style="margin-left: 5px;">ลบ</a></td>
                            </tr>
                        <?php $count_n++;
                        endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require '../backend/banner-modal.php' ?>
</body>
<script>
      //detail popup
      $(document).ready(function() {
        $('.modal_data').click(function() {
            var bannerid = $(this).attr("id");
            $.ajax({
                url: "../backend/managebanner.php",
                method: "POST",
                data: {
                    bannerid: bannerid
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