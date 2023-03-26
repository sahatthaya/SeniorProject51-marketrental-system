<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - จัดการแผงค้า</title>

    <!-- css  -->
    <link rel="stylesheet" href="../css/editStall.css" type="text/css">

</head>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
$mkr_id = $_GET['mkr_id'];
$count_n = 1;
$data2 = "SELECT stall.*, zone.* FROM stall JOIN zone ON (stall.z_id = zone.z_id) WHERE (market_id = '$mkr_id')";
$result3 = mysqli_query($conn, $data2);

$z_qry = "SELECT * FROM zone";
$z = mysqli_query($conn, $z_qry);
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
require "../backend/manage-edit-Stall.php";




// เพิ่มแผงค้า
if (isset($_POST['stall-submit'])) {
    $sID = $_POST['sID'];
    $sWidth = $_POST['sWidth'];
    $sHeight = $_POST['sHeight'];
    $sDept = $_POST['sDept'];
    $sPayRange = 'บาท/วัน';
    $sRent = $_POST['sRent'];
    $z_id = $_POST['z_id'];
    if (!isset($_POST['show'])) {
        $show = "0";
    } else {
        $show = "1";
    }

    if (isset($_POST['sID']) != "" && isset($_POST['sWidth']) != "" && isset($_POST['sHeight']) != "" && isset($_POST['sDept']) != "" && isset($_POST['z_id']) != "" && $show != "") {
        $sqlCheck = "SELECT * FROM stall WHERE (market_id = '$mkr_id')AND (sID = '$sID')";
        $rsCheck = mysqli_query($conn, $sqlCheck);
        $rowCheck = mysqli_num_rows($rsCheck);
        if ($rowCheck > 0) {
            echo "<script type='text/javascript'> stalldoubly(); </script>";
            echo '<meta http-equiv="refresh" content="1"; URL=../users-market/edit-stall.php" />';
        } else {
            $sqlInsert = "INSERT INTO `stall` (`sID`, `sWidth`, `sHeight`, `sDept`, `sRent`, `sPayRange`, `market_id`, `z_id`, `show`, `left`, `top`) VALUES ('$sID','$sWidth','$sHeight','$sDept','$sRent','$sPayRange', '$mkr_id','$z_id','$show','','') ";
            $sql = mysqli_query($conn, $sqlInsert);
            if ($sql) {
                echo "<script type='text/javascript'> success(); </script>";
                echo '<meta http-equiv="refresh" content="1"; URL=../users-market/edit-stall.php" />';
            } else {
                echo "<script>error();</script>";
                // echo "<script>alert('1');</script>";

            }
        }
    } else {
        echo "<script>error();</script>";
        // echo "<script>alert('2');</script>";

    }
}

// ลบแผงค้า
if (isset($_GET['delstall'])) {
    $sKey = $_GET['delstall'];
    $mkr_id = $_GET['mkr_id'];

    $qrybooking = mysqli_query($conn, "SELECT * FROM booking WHERE sKey = ' $sKey' ");
    $numRows = mysqli_num_rows($qrybooking);
    if ($numRows > 0) {
        echo "<script>";
        echo "
        Swal.fire({
        title: 'ไม่สามารถลบแผงค้าได้',
        text: 'ไม่สามารถลบแผงค้าได้ เนื่องจากแผงค้ามีผู้เช่า/จอง ทำการจองอยู่'
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
      }).then((result) => {
          window.location.href = '../users-market/news.php?mkr_id=" . $mkr_id . "'
      })";
        echo "</script>";
    }
    $sqlDelUsers = "DELETE FROM stall WHERE sKey = ' $sKey'";
    if (mysqli_query($conn, $sqlDelUsers)) {
        echo "<script type='text/javascript'> delsuccess(); </script>";
    } else {
        echo "<script type='text/javascript'> error(); </script>";
    }
}

?>
<script src="../backend/script.js"></script>
<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var options = {
            height: 300,
            animation: {
                duration: 1000,
                easing: 'out'
            },
            Response: {
                resize: (50, 20)
            },
            backgroundColor: '',
            chartArea: {
                'left': 20,
                'top': 15,
                'right': 0,
                'bottom': 0
            },
            fontSize: '16',

        };
        var data = google.visualization.arrayToDataTable([
            ['ประเภทแผงค้า', 'จำนวนแผงค้า'],
            <?php
            $queryz = "SELECT zone.* , COUNT(stall.z_id) AS countZ  FROM stall JOIN zone ON (stall.z_id = zone.z_id) WHERE (market_id = '$mkr_id') GROUP BY stall.z_id ";
            $rsz = mysqli_query($conn, $queryz);
            foreach ($rsz as $rs_c) {
                echo "['" . $rs_c['z_name'] . "'," . $rs_c['countZ'] . "],";
            }
            ?>

        ]);
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
    $(window).resize(function() {
        drawBackgroundColor();
        drawChart();
    });
</script>


<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">จัดการข้อมูลแผงค้า <?php echo $row['mkr_name']; ?></li>
        </ol>
    </nav>

    <h1>จัดการข้อมูลแผงค้า</h1>

    <div id="quick-menu2" class="hstack mt-3">
        <a type="button" class="btn btn-primary add-btn" id="merchant-btn" href="marketPlan.php?mkr_id=<?php echo $mkr_id = $_GET['mkr_id']; ?>">
            <i class='bx bxs-message-square-edit'></i>ปรับแก้แผนผังตลาด
        </a>
    </div>


    <!-- content -->
    <div class="top">
        <div class="border rounded shadow-sm p-3 mt-3">
            <h3>จำนวนของแผงค้าในแต่ละประเภท</h3>
            <div class="chartcanvas center " id="piechart"></div>
        </div>
        <div class="border rounded shadow-sm p-3 mt-3">
            <form method="POST" class="was-validated">
                <h3 class="modal-title">เพิ่มแผงค้า</h3>
                <label class="hstack mt-2">รหัสแผงค้า :
                    <div data-toggle="tooltip" title="รหัสแผงค้าภายในตลาดเดียวกัน จะไม่สามารถซ้ำกันได้" class="mt-1 ms-2">
                        <i class='bx bx-info-circle'></i>
                    </div>
                </label>
                <div class="input-group">
                    <input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" id="stallID" aria-label="รหัสแผงค้า" name="sID" placeholder="กรุณากรอกรหัสแผงค้า เช่น รหัสแผงค้า A01" required>
                </div>
                <label for="" class="mt-2">ประเภทแผงค้า</label>
                <div class="search_select_box">
                    <select class="selectpicker dropdown" title="เลือกประเภท" name="z_id" data-live-search="true" data-width="100%" data-size="5" required>
                        <?php while ($zone = mysqli_fetch_array($z)) :; ?>
                            <option value="<?php echo $zone['z_id']; ?>"><?php echo $zone['z_name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <label class="mt-2">ขนาดพื้นที่ :</label>
                <div class="input-group">
                    <input type="number" class="form-control " placeholder="กว้าง" name="sWidth" placeholder="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" required>
                    <span class="input-group-text">*</span>
                    <input type="number" class="form-control" placeholder="ยาว" name="sHeight" placeholder="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" required>
                    <span class="input-group-text">เมตร</span>

                </div>
                <label class="mt-2">ราคามัดจำ :</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="sDept" placeholder="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" required>
                    <span class="input-group-text">บาท</span>
                </div>
                <label class="mt-2">ราคาค่าเช่า :</label>
                <div class="input-group">
                    <input type="number" class="form-control" name="sRent" placeholder="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" required>
                    <span class="input-group-text">บาท/วัน</span>
                </div>
                <div class="mt-2 hstack gap-2">
                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="show" checked>
                    <label class="form-check-label" for="flexCheckDefault">
                        แสดงแผงค้านี้บนแผนผังตลาด
                    </label>
                </div>
                <div class="text-danger">*หมายเหตุ* <br /> 1. เมื่อทำการบันทึกข้อมูล รหัสแผงค้าจะไม่สามารถแก้ไขได้ <br>2. แผงค้าใดที่มีผู้เช่าหรือจองอยู่จะไม่สามารถลบแผงค้าได้</div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary mt-3" name="stall-submit">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>
    <div id="content" class="mt-3">
        <div id="table2" class="bannertb border  p-3 shadow-sm rounded mt-3">
            <h3 class="modal-title">ข้อมูลแผงค้า</h3>
            <table id="myTable" class="display table table-striped dt-responsive" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">รหัส</th>
                        <th scope="col">ประเภทร้านค้า</th>
                        <th scope="col">ขนาดพื้นที่ (เมตร)</th>
                        <th scope="col">ราคามัดจำ</th>
                        <th scope="col">ราคาค่าเช่า</th>
                        <th scope="col">การแสดงแผงค้า</th>
                        <th scope="col">แก้ไขข้อมูล</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row1 = $result3->fetch_assoc()) : ?>
                        <tr>
                            <td style="width:5% ;"><?php echo $count_n; ?></td>
                            <td><?php echo $row1['sID'] ?></td>
                            <td><?php echo $row1['z_name'] ?></td>
                            <td><?php echo number_format($row1['sWidth']) . ' * ' . number_format($row1['sHeight']) ?></td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <?php echo number_format($row1['sDept']) ?>
                                    <div>บาท</div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <?php echo number_format($row1['sRent']); ?>
                                    <div>
                                        (<?php echo $row1['sPayRange']; ?>)
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="p-2 rounded text-center" style="color: <?php echo ($row1['show'] == "1" ? "green" : "grey"); ?> ;">
                                    <?php echo ($row1['show'] == "1" ? "แสดง" : "ซ่อนอยู่"); ?>
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-outline-success modal_data w-100" href="edit-Stall-info.php?sKey=<?php echo $row1['sKey']; ?>;&mkr_id=<?php echo $row1['market_id']; ?>;">แก้ไข</a>
                            </td>

                        </tr>

                    <?php $count_n++;
                    endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $("body").tooltip({
            selector: '[data-toggle=tooltip]',
            placement: 'right'
        });
    });
</script>

</html>