<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/complain.css">
    <link rel="stylesheet" href="./css/banner.css">
</head>
<?php
include "profilebar.php";
include "nav.php";
include "backend/1-connectDB.php";
include "backend/1-import-link.php";
if ($_GET['mkr_id']) {
    $mkr_id = $_GET['mkr_id'];
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
}

$query_toppic = "SELECT * FROM toppic";
$result_toppic = mysqli_query($conn, $query_toppic);

//qry
$data = "SELECT complain.*, toppic.toppic,users.username FROM complain 
JOIN toppic ON (complain.toppic_id = toppic.toppic_id)
JOIN users ON (complain.users_id = users.users_id)
WHERE (mkr_id = '$mkr_id')
ORDER BY comp_id DESC";
$result = mysqli_query($conn, $data);

?>

<body onload="plslogin( event );">
<div>
        <h1 id="headline">ระบบร้องเรียน <?php echo $row['mkr_name'] ?></h1>
        <div class="postbox">
            <!-- <form method="POST" enctype="multipart/form-data"> -->
                <h5>เพิ่มการร้องเรียนใหม่</h5>
                <label>หัวข้อ :</label>
                <select name="toppic" data-width="100%" data-style="btn-outline-secondary" data-size="5" disabled>
                    <?php while ($row1 = mysqli_fetch_array($result_toppic)) :; ?>
                        <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                    <?php endwhile; ?>
                </select>

                <label>หัวเรื่อง : </label>
                <input class="subject" name="subject" type="text" disabled>
                <input class="compfile" name="compfile" type="file" disabled>
                <br>
                <label>เรื่องร้องเรียน : </label>
                <br>
                <textarea name="comp_detail" disabled></textarea>
                <button name="post-btn" class="btn btn-light" onclick="plslogin();signIn();">ส่ง <i class='bx bxs-paper-plane'></i></button>
            <!-- </form> -->
        </div>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="commentbox">
                <div class="row">
                    <div class="col-md-4">
                        <img src="../<?php echo $row['comp_file']; ?>" class="imgcomment" alt="">
                    </div>
                    <div class="col-md-8">
                        <p class="float-end" id="timestamp"><?php echo $row['timestamp'] ?></p>
                        <h2 id="subj"><?php echo $row['comp_subject']; ?></h2>
                        <p id="toppic">หัวข้อ : <?php echo $row['toppic'] ?></p>
                        <p><?php echo $row['comp_detail'] ?></p>
                    </div>
                </div>
            </div>
            <div class="reply-box">
                <label class="reply-head">การตอบกลับจากผู้ดูแล : </label>
                <label class="reply_detail"><?php echo $row['reply'] ?></label>
            </div>
        <?php endwhile; ?>
    </div>

</body>


</html>