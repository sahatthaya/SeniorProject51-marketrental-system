<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - Document</title>
    <link rel="stylesheet" href="./css/complain.css">
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

$perpage = 10;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start = ($page - 1) * $perpage;

//qry
$data = "SELECT complain.*, toppic.toppic,users.username FROM complain 
JOIN toppic ON (complain.toppic_id = toppic.toppic_id)
JOIN users ON (complain.users_id = users.users_id)
WHERE (mkr_id = '$mkr_id')
ORDER BY comp_id DESC";
$result = mysqli_query($conn, $data);

$sql2 = "SELECT complain.*, toppic.toppic,users.username FROM complain 
JOIN toppic ON (complain.toppic_id = toppic.toppic_id)
JOIN users ON (complain.users_id = users.users_id)
WHERE (mkr_id = '$mkr_id')";
$query2 = mysqli_query($conn, $sql2);
?>

<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./all-market.php" class="text-decoration-none">ตลาดทั้งหมด</a></li>
            <li class="breadcrumb-item fs-5 "><a href="market-info.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none"><?php echo $row['mkr_name']; ?></a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">ระบบร้องเรียน<?php echo $row['mkr_name']; ?></li>
        </ol>
    </nav>
    <div>
        <h1 id="headline">ระบบร้องเรียน <?php echo $row['mkr_name'] ?></h1>
        <div class="border rounded shadow-sm p-3">
            <h5>เพิ่มการร้องเรียนใหม่</h5>
            <hr>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">หัวข้อ :</label>
                <div class="col-sm-10">
                    <select name="toppic" class="form-select" data-width="100%" data-style="btn-outline-secondary" data-size="5" disabled required>
                        <?php while ($row1 = mysqli_fetch_array($result_toppic)) :; ?>
                            <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">หัวเรื่อง :</label>
                <div class="col-sm-10">
                    <input class="form-control" name="subject" type="text" disabled required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">รูปภาพที่เกี่ยวข้อง :</label>
                <div class="col-sm-10">
                    <input class="form-control ps-3" name="compfile" type="file" accept="image/png, image/gif, image/jpeg" disabled>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">เรื่องร้องเรียน :</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="comp_detail" disabled required></textarea>
                </div>
            </div>
            <div class="text-end">
                <button name="post-btn" type="submit" class="btn btn-primary w-25" onclick="plslogin();signIn();">ส่ง <i class='bx bxs-paper-plane'></i></button>
            </div>

        </div>
        <?php
        $total_record = mysqli_num_rows($query2);
        $total_page = ceil($total_record / $perpage);
        ?>
        <div class="my-3" style="display: <?php echo $total_record > 0 ? 'block' : 'none'; ?>;">
            <nav aria-label="Page navigation example " style="height: 38px;">
                <ul class="pagination justify-content-end">
                    <li class="page-item">
                        <a class="page-link" href="complain.php?page=1&&mkr_id=<?php echo $mkr_id; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <li class="page-item"><a class="page-link" href="complain.php?page=<?php echo $i; ?>&&mkr_id=<?php echo $mkr_id; ?>"><?php echo $i; ?></a></a></li>
                    <?php } ?>
                    <li class="page-item">
                        <a class="page-link" href="complain.php?page=<?php echo $total_page; ?>&&mkr_id=<?php echo $mkr_id; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <hr style="display: <?php echo $total_record > 0 ? 'block' : 'none'; ?>;">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="border rounded-top shadow-sm p-3">
                <div class="row">
                    <div class="col-md-4">
                        <img src="./<?php echo $row['comp_file']; ?>" class="w-100 img-fluid rounded " alt="">
                    </div>
                    <div class="col-md-8">
                        <p class="float-end" id="timestamp"><?php echo date("วันที่ d/m/Y เวลา h:i a", strtotime($row['timestamp'])) ?></p>
                        <h2 id="subj"><?php echo $row['comp_subject']; ?></h2>
                        <p id="toppic">หัวข้อ : <?php echo $row['toppic'] ?></p>
                        <p><?php echo $row['comp_detail'] ?></p>
                    </div>
                </div>
            </div>
            <div class="border rounded-bottom shadow-sm p-3">
                <label class="reply-head">การตอบกลับจากผู้ดูแล : </label>
                <label class="reply_detail"><?php
                                            if ($row['status'] == '1') {
                                                echo "ยังไม่มีการตอบกลับจากผู้ดูแล";
                                            } else {
                                                echo $row['reply'];
                                            }
                                            ?></label>
            </div>
        <?php endwhile; ?>
    </div>
    <hr style="display: <?php echo $total_record > 0 ? 'block' : 'none'; ?>;">
    <div class="my-3" style="display: <?php echo $total_record > 0 ? 'block' : 'none'; ?>;">
        <nav aria-label="Page navigation example " style="height: 38px;">
            <ul class="pagination justify-content-end">
                <li class="page-item">
                    <a class="page-link" href="complain.php?page=1&&mkr_id=<?php echo $mkr_id; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                    <li class="page-item"><a class="page-link" href="complain.php?page=<?php echo $i; ?>&&mkr_id=<?php echo $mkr_id; ?>"><?php echo $i; ?></a></a></li>
                <?php } ?>
                <li class="page-item">
                    <a class="page-link" href="complain.php?page=<?php echo $total_page; ?>&&mkr_id=<?php echo $mkr_id; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</body>


</html>