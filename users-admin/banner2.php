<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - หน้าหลัก(ผู้ดูแลระบบ)</title>

    <link rel="stylesheet" href="../css/banner.css" type="text/css">

</head>

<?php

include "profilebar.php";

include "nav.php";

include "../backend/1-connectDB.php";

require "../backend/manage-banner.php";

?>





<body>

    <h1 id="headline">จัดการแบนเนอร์</h1>


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

                    <div class="carousel-caption d-md-block">

                        <h5><?php echo $row['bn_toppic'] ?></h5>

                        <p><?php echo $row['bn_detail'] ?></p>

                    </div>

                    <a href="<?php echo $retVal = ($row["bn_link"] == "") ?  '#' :  '../'.$row["bn_link"];?>">

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

            <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                <div class="modal-dialog modal-lg modal-dialog-centered">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title" id="staticBackdropLabel">เพิ่มแบนเนอร์</h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </div>

                        <form method="post" enctype="multipart/form-data" class="was-validated">

                            <div class="modal-body">

                                <h6 class="mt-2">หัวข้อ</h6>

                                <input type="text" class="form-control" placeholder="หัวข้อ" name="bn_toppic">

                                <h6 class="mt-2">รายละเอียด</h6>

                                <textarea type="text" class="form-control" placeholder="รายละเอียด" name="bn_detail"></textarea>

                                <div class="form-group">

                                    <h6 class="mt-2">เพิ่มรูปภาพ <span class="text-secondary fs-8">( ขนาดแนะนำ 1278 x 400 )</span></h6>

                                    <input type="file" class="form-control" name="bn_img" id="imgInp" accept="image/png, image/gif, image/jpeg" required>

                                    <div class="valid-feedback"></div>

                                    <div class="invalid-feedback">กรุณาเลือกรูปภาพ</div>

                                </div>

                                <img style="width:750px;margin-top:10px;" class="img-fluid rounded" id="blah">

                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>

                                <button type="submit" class="btn btn-primary" name="bn-submit">เพิ่มข้อมูล</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

            <div class="content">

                <div id="table" class="bannertb mt-3 border p-3 shadow-sm rounded">
                    <div class="d-flex justify-content-between">
                        <h4>
                            ข้อมูลแบนเนอร์
                        </h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">

                            <i class='bx bxs-plus-circle'></i> เพิ่มแบนเนอร์

                        </button>
                    </div>
                    <hr>
                    <table id="myTable" class="display " style="width: 100%;">

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

                                    <td>

                                        <a href="./banner-edit.php?bn_id=<?php echo $row['bn_id']; ?>" class=" btn btn-outline-warning btnac" style="margin-left: 5px;">แก้ไข</a>

                                        <a href="../backend/manage-banner.php?delbn_id=<?php echo $row['bn_id']; ?>" onclick="return confirm('คุณต้องการลบแบบเนอร์นี้หรือไม่')" class=" btn btn-outline-danger btnac" style="margin-left: 5px;">ลบ</a>

                                    </td>

                                </tr>

                            <?php $count_n++;

                            endwhile ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <?php require '../backend/modal-banner.php' ?>

</body>

<script>
    //detail popup

    $(document).ready(function() {

        $("body").on("click", ".modal_data", function(event) {

            var bannerid = $(this).attr("id");

            $.ajax({

                url: "../backend/modal-banner.php",

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



    imgInp.onchange = evt => {

        const [file] = imgInp.files

        if (file) {

            blah.src = URL.createObjectURL(file)

        }

    }
</script>





</html>