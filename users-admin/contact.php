<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - แก้ไขข้อมูลติดต่อ</title>



    <!-- css  -->

    <link rel="stylesheet" href="../css/contact.css">

</head>

<?php

include "profilebar.php";

include "nav.php";

include "../backend/1-connectDB.php";

include "../backend/1-import-link.php";

require "../backend/manage-contact.php";

?>



<body>


    <form method="POST" enctype="multipart/form-data" class="was-validated">

        <h1>แก้ไขข้อมูลเกี่ยวกับเว็บไซต์</h1>

        <div class="parent mt-3">
            <div class="logo_img border shadow-sm rounded p-3">
                <label for="logo" class="mb-2">รูปภาพโลโก้ : </label>
                <input type="file" class="form-control mb-3" name="ct_logo" id="logo" accept="image/png, image/gif, image/jpeg">
                <img src="../<?php echo $row["ct_logo"] ?>" alt="logo_marketremtal" class="img-fluid p-3" id="logoex">

            </div>

            <div class="contentbox web-info border shadow-sm rounded p-3">
                <label for="" class="mb-2">ข้อความเกี่ยวกับเว็บไซต์ : </label>
                <figure class="text-center">

                    <blockquote class="blockquote">

                        <div class="input-group mb-3">

                            <textarea rows="11" class="form-control" name="ct_webinfo" style=" resize: none;"><?php echo $row["ct_webinfo"] ?></textarea>

                        </div>


                    </blockquote>

                    <figcaption class="blockquote-footer">

                        <cite title="Source Title">MarketRental</cite>

                    </figcaption>

                </figure>

            </div>

        </div>

        <div class="boxcard">

            <div class=" cardcontact border shadow-sm rounded p-3" id="ct1">

                <div class="row g-0">

                    <div class="col-md-5">

                        <img src="../<?php echo $row["ct1_pic"] ?>" class="img-fluid rounded-start ctimg" id="con1ex" style=" height: 300px;">

                    </div>

                    <div class="col-md-7">

                        <div class="card-body mt-2 px-3">
                            <div class="mb-1">ชื่อ-นามสกุล</div>
                            <div class="hstack gap-2 mb-2">
                                <input class="form-control" placeholder="ชื่อ" style="width: 48%;" type="text" name="ct1_fname" value="<?php echo $row["ct1_fname"] ?>" required>
                                <input class="form-control" placeholder="นามสกุล" style="width: 48%;" type="text" name="ct1_lname" value="<?php echo $row["ct1_lname"] ?>" required>
                            </div>
                            <div class="mb-1">อีเมล</div>
                            <input class="form-control mb-2" type="email" name="ct1_email" pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$" title="กรุณากรอกอีเมลให้ถูกต้อง" placeholder="อีเมล" value="<?php echo $row["ct1_email"] ?>" required>
                            <div class="mb-1">เบอร์โทรศัพท์</div>
                            <input class="form-control mb-2 tel" id="tel" type="tel" name="ct1_tel" placeholder="เบอร์โทรศัพท์" pattern="[0-9]{10}" title="กรุณากรอกเบอร์โทรศัพท์ หมายเลข (0-9) จำนวน 10 ตัว" value="<?php echo $row["ct1_tel"] ?>" required>
                            <div class="mb-1">รูปภาพ</div>
                            <input type="file" name="ct1_pic" class="form-control" id="con1" accept="image/png, image/gif, image/jpeg">
                        </div>

                    </div>

                </div>

            </div>



            <div class=" cardcontact border shadow-sm rounded p-3" id="ct2">

                <div class="row g-0">

                    <div class="col-md-5">

                        <img src="../<?php echo $row["ct2_pic"] ?>" class="img-fluid rounded-start ctimg" id="con2ex" style=" height: 300px;">

                    </div>

                    <div class="col-md-7">

                        <div class="card-body mt-2 px-3">
                            <div class="mb-1">ชื่อ-นามสกุล</div>
                            <div class="hstack gap-2 mb-2">
                                <input class="form-control" placeholder="ชื่อ" style="width: 48%;" type="text" name="ct2_fname" value="<?php echo $row["ct2_fname"] ?>" required>
                                <input class="form-control" placeholder="นามสกุล" style="width: 48%;" type="text" name="ct2_lname" value="<?php echo $row["ct2_lname"] ?>" required>
                            </div>
                            <div class="mb-1">อีเมล</div>
                            <input class="form-control mb-2 " type="email" name="ct2_email" pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$" title="กรุณากรอกอีเมลให้ถูกต้อง" placeholder="อีเมล" value="<?php echo $row["ct2_email"] ?>" required>
                            <div class="mb-1">เบอร์โทรศัพท์</div>
                            <input class="form-control mb-2 tel" id="tel" type="tel" name="ct2_tel" placeholder="เบอร์โทรศัพท์" pattern="[0-9]{10}" title="กรุณากรอกเบอร์โทรศัพท์ หมายเลข (0-9) จำนวน 10 ตัว" value="<?php echo $row["ct2_tel"] ?>" required>
                            <div class="mb-1">รูปภาพ</div>
                            <input type="file" name="ct2_pic" class="form-control" id="con2" accept="image/png, image/gif, image/jpeg">
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <hr>
        <div class="text-center">
            <button type="submit" class="btn btn-primary w-100" id="save-data" name="bn-submit">บันทึกข้อมูล</button>
        </div>


    </form>



</body>

<script>
    // tel input mask
    $(":input").inputmask();
    $(".tel").inputmask({
        "mask": "9999999999"
    });

    logo.onchange = evt => {

        const [file] = logo.files

        if (file) {

            logoex.src = URL.createObjectURL(file)

        }

    }



    con1.onchange = evt => {

        const [file] = con1.files

        if (file) {

            con1ex.src = URL.createObjectURL(file)

        }

    }

    con2.onchange = evt => {

        const [file] = con2.files

        if (file) {

            con2ex.src = URL.createObjectURL(file)

        }

    }
</script>



</html>