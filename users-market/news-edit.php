<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจองทั้งหมด</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>

<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
require "../backend/news.php";

?>

<body>
    <h1 class="head_contact mb-3">แก้ไขข่าวสาร</h1>

    <form method="POST" enctype="multipart/form-data" class="add-info p-4 mb-5 border rounded shadow-sm">
        <h4 class="mb-2">กรอกข้อมูลที่ต้องการแก้ไข</h4>
        <hr>
        <div class="mt-4 mb-3 row">
            <label class="col-sm-2 col-form-label">หัวเรื่อง</label>
            <input type="text" class="form-control" name="n_id" value="<?php echo $edit['n_id'] ?>" hidden>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="n_sub" value="<?php echo $edit['n_sub'] ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">รายละเอียด</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none;" name="n_detail"><?php echo $edit['n_detail'] ?></textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">ไฟล์ที่เกี่ยวข้อง</label>
            <div class="col-sm-10">
                <input class="form-control" type="file" id="imgInp" name="n_file">
            </div>

        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label"></label>

            <div class="col-sm-10">
                <img style="width:350px;margin-top:10px;" class="img-fluid rounded img-thumbnail" src='../<?php echo $edit["n_file"] ?>' id="blah">
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary " style="width: 150px;" type="submit" name="edit-news-submit">บันทึกข้อมูล</button>
        </div>
    </form>
</body>

<script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }
</script>

</html>