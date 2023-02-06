<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - ระบบร้องเรียน</title>

    <link rel="stylesheet" href="./css/complain.css">

</head>

<?php

include "profilebar.php";

include "nav.php";

include "backend/1-connectDB.php";

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

$data = "SELECT complain.*, toppic.toppic,users.username,comp_status.* FROM complain 

JOIN toppic ON (complain.toppic_id = toppic.toppic_id)

JOIN users ON (complain.users_id = users.users_id)
JOIN comp_status ON (comp_status.cs_id = complain.status)
WHERE (mkr_id = '$mkr_id')

ORDER BY comp_id DESC limit {$start} , {$perpage}";

$result = mysqli_query($conn, $data);



$sql2 = "SELECT complain.*, toppic.toppic,users.username FROM complain 

JOIN toppic ON (complain.toppic_id = toppic.toppic_id)

JOIN users ON (complain.users_id = users.users_id)

WHERE (mkr_id = '$mkr_id')";

$query2 = mysqli_query($conn, $sql2);

$query2 = mysqli_query($conn, $sql2);

?>



<body>
    <div>

        <h1 id="headline">ระบบร้องเรียน <?php echo $row['mkr_name'] ?></h1>

        <div class="border rounded shadow-sm p-3">

            <form method="POST" enctype="multipart/form-data" class="was-validated">

                <h5>เพิ่มการร้องเรียนใหม่</h5>

                <hr>

                <div class="mb-3 row">

                    <label for="staticEmail" class="col-sm-2 col-form-label">หัวข้อ :</label>

                    <div class="col-sm-10">

                        <select name="toppic" class="form-select" data-width="100%" data-style="btn-outline-secondary" data-size="5" required>

                            <?php while ($row1 = mysqli_fetch_array($result_toppic)) :; ?>

                                <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                </div>



                <div class="mb-3 row">

                    <label for="staticEmail" class="col-sm-2 col-form-label">หัวเรื่อง :</label>

                    <div class="col-sm-10">

                        <input class="form-control" name="subject" type="text" maxlength="85" required>

                    </div>

                </div>

                <div class="mb-3 row">

                    <label for="staticEmail" class="col-sm-2 col-form-label">เรื่องร้องเรียน :</label>

                    <div class="col-sm-10">

                        <textarea class="form-control" name="comp_detail" required></textarea>

                    </div>

                </div>
                <div class="mb-3 row">

                    <label for="staticEmail" class="col-sm-2 col-form-label">รูปภาพที่เกี่ยวข้อง : <br> <span class="text-secondary fs-6">(สามารถเลือกได้หลายไฟล์)</span></label>

                    <div class="col-sm-10">

                        <input class="form-control" name="upload[]" type="file" accept="image/png, image/gif, image/jpeg" title="สามารถเลือกได้หลายไฟล์" multiple>

                    </div>

                </div>
                <div class="text-end">

                    <button name="post-btn" type="" class="btn btn-primary w-25" onclick="plslogin();">ส่ง <i class='bx bxs-paper-plane'></i></button>

                </div>

            </form>

        </div>

        <?php

        $total_record = mysqli_num_rows($query2);

        $total_page = ceil($total_record / $perpage);

        ?>

        <hr style="display: <?php echo $total_record > 0 ? 'block' : 'none'; ?>;">

        <?php
        if (mysqli_num_rows($result) == 0) { ?>
            <h2 class="text-inline mt-5">
                <i><span class="text-secondary fs-5"> ยังไม่มีการร้องเรียนในขณะนี้ </span></i>
            </h2>

            <?php
        } else {
            while ($row = $result->fetch_assoc()) :
                $comp_id = $row['comp_id'];
                $reply = mysqli_query($conn, "SELECT * FROM `reply` WHERE `comp_id` = '$comp_id'");
                $numRowr = mysqli_num_rows($reply);
            ?>
                <a href="thread.php?comp_id=<?php echo $comp_id; ?>&&mkr_id=<?php echo $mkr_id ?>" class="text-decoration-none text-reset hover-card">
                    <div class="border rounded shadow-sm p-3 my-2 comp-card">
                        <div class="d-flex justify-content-between">
                            <h4 class=""><?php echo $row['comp_subject']; ?></h4>
                            <div class="<?php echo $row['cs_color']; ?>">
                                <?php echo $row['cs_name']; ?>
                                <i class='bx bxs-circle'></i>
                            </div>
                        </div>
                        <div class="">
                            <?php echo $row['toppic']; ?>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex hstck gap-2">

                                <div>
                                    โดย: <?php echo $row['username']; ?>
                                </div>
                                <div class="text-secondary opacity-50">
                                    <?php echo date("วันที่ d/m/Y เวลา h:i a", strtotime($row['timestamp'])) ?>
                                </div>
                            </div>
                            <div class="text-secondary">
                                <i class='bx bx-message-square-dots'></i> <?php echo $numRowr ?>
                            </div>
                        </div>
                    </div>
                </a>
        <?php endwhile;
        } ?>
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