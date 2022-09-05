<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - การจองทั้งหมด</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>

<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
require "../backend/news.php";
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

<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">จัดการข่าวสาร <?php echo $row['mkr_name']; ?></li>
        </ol>
    </nav>
    <h1 class="head_contact mb-3">จัดการข่าวสารตลาด</h1>

    <form method="POST" enctype="multipart/form-data" class="add-info p-4 mb-5 border rounded shadow-sm">
        <h4 class="mb-2">เพิ่มข่าวสารใหม่</h4>
        <hr>
        <div class="mt-4 mb-3 row">
            <label class="col-sm-2 col-form-label">หัวเรื่อง</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="n_sub">
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">รายละเอียด</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none;" name="n_detail"></textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-2 col-form-label">ไฟล์ที่เกี่ยวข้อง</label>
            <div class="col-sm-10">
                <input class="form-control" type="file" id="formFile" name="n_file">
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary " style="width: 150px;" type="submit" name="add-news">เพิ่ม</button>
        </div>
    </form>


    <div id="table2" class="border p-3 shadow-sm rounded">
        <h4 class="mb-2">ข่าวสารทั้งหมด</h4>
        <hr>
        <table id="myTable" class="display " style="width: 100%;">
            <thead>
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">วันที่เพิ่มข่าว</th>
                    <th scope="col">หัวเรื่อง</th>
                    <th scope="col">รายละเอียด</th>
                    <th scope="col">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row1 = $result3->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $count_n; ?></td>
                        <td><?php echo $row1['timestamp'] ?></td>
                        <td><?php echo $row1['n_sub']; ?></td>
                        <td><button name="view" type="button" class="modal_data1 btn btn-outline-primary w-100" id="<?php echo $row1['n_id']; ?>">ดูรายละเอียด</button></td>
                        <td>
                            <div class="hstack gap-2">
                                <a href="news-edit.php?edit-news=<?php echo $row1['n_id']; ?>;&mkr_id=<?php echo $row1['mkr_id']; ?>;" class=" btn btn-outline-warning w-50">แก้ไข</a>
                                <a href="news.php?del=<?php echo $row1['n_id']; ?>;&mkr_id=<?php echo $row1['mkr_id']; ?>;" onclick="return confirm('คุณต้องการลบข่าวสารนี้หรือไม่')" class=" btn btn-outline-danger w-50">ลบ</a>
                            </div>
                        </td>
                    <?php $count_n++;
                endwhile ?>
            </tbody>
        </table>
    </div>

    <script src="../backend/script.js"></script>
    <?php require '../backend/modal-news.php' ?>
</body>
<script>
    //detail popup
    $(document).ready(function() {
        $('.modal_data1').click(function() {
            var newsid = $(this).attr("id");
            $.ajax({
                url: "../backend/news.php",
                method: "POST",
                data: {
                    newsid: newsid
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