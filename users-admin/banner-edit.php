<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - Document</title>
    <link rel="shortcut icon" type="image/x-icon" href="../asset/contact/logo.png" />
    <link rel="stylesheet" href="../css/applicant.css" type="text/css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
include "../backend/edit-banner.php";

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row1 = mysqli_fetch_array($result);
extract($row1);
$users_id = $row1['users_id'];

if (isset($_GET["bn_id"])) {
    $id = $_GET["bn_id"];
    $data = "SELECT * FROM banner WHERE bn_id = '$id'";
    $resultdata = mysqli_query($conn, $data);
    $row2 = mysqli_fetch_array($resultdata);
    extract($row2);
}


?>

<body>
    <div class="applybox">
        <form id="applyform" method="POST" enctype="multipart/form-data">
            <div class="form-outer" style="overflow: visible;">
                <h1 id="headline">แก้ไขข้อมูลแบนเนอร์</h1>

                <!-- form--1 -->
                <div id="stepOne" class="row border shadow-sm p-5 mt-3 mb-3 rounded">
                    <div class="des_input">หัวข้อ</div>
                    <input class="form-control col-6" type="text" placeholder="หัวข้อ" name="bn_toppic" value="<?php echo $row2['bn_toppic'] ?>" required>

                    <div class="des_input">รายละเอียด</div>
                    <textarea name="bn_detail" class=" form-control" placeholder="รายละเอียด" id="" cols="30" rows="5" style="border-radius: 5px;resize: none; margin-left:5px;" required> <?php echo $row2['bn_detail'] ?></textarea>

                    <div class="des_input">รูปภาพ</div>
                    <input class="sqr-input col-12 form-control" type="file" aria-label="แนบรูปภาพ" name="bn_pic" id="imgInp">
                    <div class="des_input">รูปภาพปัจุบัน : </div>
                    <div class="p-0">
                        <img style="width:750px;margin-top:10px;" class="img-fluid rounded" src='../<?php echo $row2["bn_pic"] ?>' id="blah">
                    </div>
                    <input class="form-control col-6" type="text" placeholder="หัวข้อ" name="bn_id" value="<?php echo $row2['bn_id'] ?>" hidden>

                    <input type="submit" class="btn btn-primary" id="add-data" name="bn-submit" value="บันทึกข้อมูล">
                </div>
            </div>
        </form>
    </div>
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