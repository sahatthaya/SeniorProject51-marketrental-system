<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตลาดทั้งหมด</title>
    <!-- css  -->
    <link rel="stylesheet" href="./css/all-market.css" type="text/css">
</head>
<?php
include "./profilebar.php";
include "./nav.php";
include "./backend/connectDB.php";
include "backend/import-link.php";
require "./backend/qry-allmarket.php";
?>
<body>
    <div class="wrap">
        <div class="top">
            <h1 id="headline">ตลาดทั้งหมด</h1>
            <div class="search_box">
                <form name="Searchbox " method="POST">
                <label for="#search"><h5>ค้นหา : </h5></label>
                <input class="btn border-secondary" type="text" name="search" id="search" placeholder="กรอกข้อมูลที่ต้องการค้นหา" onkeyup="search(this.value)">
                <input class="btn btn-primary " id="search" type="submit" name="searchsubmit" value="ค้นหา">
                <input class="btn btn-danger" id="reset" type="submit" name="reset" value="รีเซ็ต">
            </form>

            </div>
        </div>
        <div class="box" id="card">
            <?php while ($row = $result->fetch_assoc()) : ?>
                <a id="market-item" class="marketcard radius10" href="market-info.php?mkr_id=<?php echo $row['mkr_id']; ?>">
                    <img src="<?php echo $row['mkr_pic'] ?>" class="radius10 mkrimg " alt="...">
                    <div class="overlay">
                        <h4 style="text-align: center;"><?php echo $row['mkr_name'] ?></h4>
                        <div class="row markettag">
                            <p class="col-6  ptext" style="text-align: center;"><i class='bx bxs-navigation'></i> <?php echo $row['province_name'] ?></p>
                            <p class="col-6  ptext" style="text-align: center;"><i class='bx bxs-info-circle'></i> <?php echo $row['market_type'] ?></p>

                        </div>
                        <p class="ptext">รายละเอียด : <?php echo $row['mkr_descrip'] ?></p>
                        <p class="ptext">เบอร์ติดต่อ : <?php echo $row['tel'] ?></p>
                        <p class="ptext">อีเมล : <?php echo $row['email'] ?></p>
                        <p class="ptext">จำนวนแผงว่าง : 0 จาก 0</p>
                    </div>
                </a>
            <?php
            endwhile ?>
        </div>
    </div>
    <!-- <script type="text/javascript">
        $(document).ready(function() {
            $("#search").keyup(function() {
                var search = $(this).val();
                $.ajax({
                    url: '../backend/qry-allmarket.php',
                    method: 'post',
                    data: {
                        query: search
                    },
                    success: function(response) {
                        $("#card").html(response);
                    }
                });
            });
        });
    </script> -->
</body>

</html>