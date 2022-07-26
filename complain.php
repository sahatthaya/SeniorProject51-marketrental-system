<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/complain.css">
</head>
<?php
include "profilebar.php";
include "nav.php";
include "backend/connectDB.php";
include "backend/import-link.php";
if ($_GET['mkr_id']) {
    $mkr_id = $_GET['mkr_id'];
    $sql = "SELECT market_detail.*,province.province_name , market_type.market_type FROM market_detail 
  JOIN province ON (market_detail.province_id = province.province_id)
  JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id) WHERE (mkr_id = '$mkr_id') ";
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
ORDER BY comp_id DESC";
$result = mysqli_query($conn, $data);

?>

<body onload="plslogin( event );">
    <div>
        <h1 id="headline">ระบบร้องเรียน <?php echo $row['mkr_name'] ?></h1>
        <div class="postbox">
            <form method="POST" enctype="multipart/form-data">
                <h5>เพิ่มการร้องเรียนใหม่</h5>
                <label>หัวข้อ :</label>
                <select name="toppic" data-width="100%" data-style="btn-outline-secondary" data-size="5" required>
                    <?php while ($row1 = mysqli_fetch_array($result_toppic)) :; ?>
                        <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                    <?php endwhile; ?>
                </select>

                <label>หัวเรื่อง : </label>
                <input name="subject" type="text" required>
                <input name="compfile" type="file">
                <br>
                <label>เรื่องร้องเรียน : </label>
                <br>
                <textarea name="comp_detail" required></textarea>
                <button type="button" name="post-btn" onclick="plslogin( event );" class="btn btn-light">ส่ง <i class='bx bxs-paper-plane'></i></button>
            </form>
        </div>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="commentbox">

                <div class="row">
                    <div class="col-4">
                        <img src="<?php echo $row['comp_file']; ?>" class="imgcomment" alt="">
                    </div>
                    <div class="col-8">
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
<script>
    function plslogin() {
        Swal.fire({
            title: 'คุณยังไม่ได้เข้าสู่ระบบ',
            text: 'กรุณาเข้าสู่ระบบเพื่อส่งเรื่องร้องเรียน',
            icon: 'warning',
            showConfirmButton: false,
            timer: 3000
        })
    }
</script>

</html>