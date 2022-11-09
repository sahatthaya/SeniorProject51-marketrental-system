<?php
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
$row1 = mysqli_fetch_array($result);
extract($row1);

$resultCU = mysqli_query($conn, "SELECT * FROM `cost/unit` WHERE mkr_id = '$mkr_id'");
$costunit = mysqli_query($conn, "SELECT * FROM `cost/unit` WHERE mkr_id = '$mkr_id'");
$stall = mysqli_query($conn, "SELECT * FROM `stall` WHERE `show`=1 AND `market_id`=$mkr_id");
$querycost = mysqli_query($conn, "SELECT cost.*,stall.*,`cost/unit`.* FROM `cost` JOIN stall ON (cost.sKey = stall.sKey) JOIN `cost/unit` ON (cost.cu_id = `cost/unit`.cu_id) WHERE cost.`mkr_id`= $mkr_id ORDER BY `cost_period` DESC");
// เพิ่มค่าใช้จ่ายเพิ่มเติม
if (isset($_POST['addcost'])) {
    $cu_name = $_POST['cu_name'];
    $cu_price = $_POST['cu_price'];
    $cu_type = $_POST['cu_type'];
    if (isset($cu_name) != "" && isset($cu_price) != "" && isset($cu_type) != "") {
        $sqladdcost = "INSERT INTO `cost/unit`(cu_name,cu_price,mkr_id,cu_type) VALUES ('$cu_name', '$cu_price', '$mkr_id', '$cu_type')";
        if ($rssqladdcost = mysqli_query($conn, $sqladdcost)) {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1"; URL=../edit-stall.php" />';
        } else {
            echo "<script>error();</script>";
        }
    } else {
        echo "<script>error();</script>";
    }
}


if (isset($_GET['delcu_id']) && isset($_GET['mkr_id'])) {
    $cu_id = $_GET['delcu_id'];
    $mkr_id = $_GET['mkr_id'];

    $delCU = "DELETE FROM `cost/unit` WHERE  cu_id = $cu_id";
    $sqldelCU = mysqli_query($conn, $delCU);
    if ($sqldelCU) {
        echo "<script>";
        echo "
    Swal.fire({
        title: 'ลบข้อมูลสำเร็จ',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
      }).then((result) => {
          window.location.href = 'cost.php?mkr_id=" . $mkr_id . "'
      })";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'> error(); </script>";
    }
}

if (isset($_POST['save-table'])) {
    $cost_period = $_POST['cost_period'];
    $cu_id = $_POST['cu_id'];
    $count_num = $_POST['count_num'];
    $cu_price = $_POST['cu_price'];
    for ($i = 1; $i < $count_num; $i++) {
        $sKeyI = "sKey$i";
        $c_unitI = "c_unit$i";
        $sKey = $_POST[$sKeyI];
        $c_unit = $_POST[$c_unitI];
        @$c_totalbath = $cu_price * $c_unit;

        if (isset($sKey) && isset($c_unit)) {
            $Insert = mysqli_query($conn, "INSERT INTO `cost`(
                `cost_period`,
                `c_unit`,
                `c_totalbath`,
                `sKey`,
                `cu_id`,
                `mkr_id`
            )
            VALUES(
                '$cost_period',
                '$c_unit',
                '$c_totalbath',
                '$sKey',
                '$cu_id',
                '$mkr_id'
            )");
        } else {
            echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง ไม่พบข้อมูลความกว้าง + ยาว')</script>";
        }
    }

    if ($Insert) {
        echo "<script type='text/javascript'> success(); </script>";
        echo '<meta http-equiv="refresh" content="1"; />';
    } else {
        echo "<script>alert('ผิดพลาดกรุณาลองอีกครั้ง sqlerror')</script>";
    }
}

// update cost/unit----------------------------------------------------------------
if (isset($_POST['editcost'])) {
    $cu_id = $_POST['cu_id'];
    $cu_name = $_POST['cu_name'];
    $cu_price = $_POST['cu_price'];
    $cu_type = $_POST['cu_type'];

    if (isset($cu_id) != '' && isset($cu_name) != '' && isset($cu_price) != '' && isset($cu_type) != '') {
        $updatesql = mysqli_query($conn, "UPDATE `cost/unit` SET cu_name ='$cu_name',`cu_price`='$cu_price',`cu_type`='$cu_type' WHERE (`cu_id` = '$cu_id')");

        if ($updatesql != '') {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1"; />';
        } else {
            echo "<script type='text/javascript'> error(); </script>";
        }
    } else {
        echo "<script type='text/javascript'> error(); </script>";
    }
}
