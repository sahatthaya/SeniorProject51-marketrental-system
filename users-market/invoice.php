<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - จัดการค่าเช่า</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>
<?php
include "./profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
require "../backend/invoice.php";
$open = $row['opening'];
?>

<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item fs-5 "><a href="./rent.php?mkr_id=<?php echo $mkr_id ?>" class="text-decoration-none">จัดการค่าเช่า</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">การเรียกเก็บค่าเช่า <?php echo $row['mkr_name']; ?></li>
        </ol>
    </nav>
    <h1 class="head_contact">การเรียกเก็บค่าเช่า</h1>
    <div id="content">
        <form method="post">
            <div id="table2" class="border mt-3 p-3 shadow-sm rounded">
                <!-- <form method="post">
                <div class="hstack gap-2">
                    ค้นหาการเช่าในช่วงวันที่ :
                    <div style="width: 15.5%;">
                        <input type="date" class="form-control">
                    </div>
                    ถึง
                    <div style="width: 15.5%;">
                        <input type="date" class="form-control">
                    </div>
                    <button type="button" class="btn btn-outline-primary">ค้นหา</button>
                </div>
            </form> -->
                <div class="d-flex justify-content-between">
                    <div class="hstack gap-2">
                        วันที่ :
                        <div style="width: 20%;">
                            <input id="date" name="cost_period" class="form-control" value="<?php echo date("Y-m-d"); ?>" disabled />
                        </div>
                        ชำระภายในวันที่ :
                        <div style="width:20%;">
                            <input id="date" name="INV_expired" class="form-control" value="<?php echo date('Y-m-d', strtotime(date("Y-m-d") . ' + 7 days')); ?>" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="save-table"><i class='bx bx-send me-2'></i>ส่งใบเรียกเก็บค่าเช่า</button>
                </div>
                <hr>
                <table id="myTable_nosort" class="display " style="width: 100%;">
                    <thead>
                        <tr>
                            <th style=" width:4%;" class="text-center">
                                <input type="checkbox" id="checkall" onClick="toggle(this)" class='form-check-input table-checked' checked />
                            </th>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">วันที่เริ่มเช่า</th>
                            <th scope="col">วันที่สิ้นสุด</th>
                            <th scope="col">รหัสแผงค้า</th>
                            <th scope="col">จำนวนวันที่เช่า (วัน)</th>
                            <th scope="col">ผู้จอง</th>
                            <th scope="col">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while ($row = $query->fetch_assoc()) :
                        ?>
                            <tr>
                                <td class='text-center'><input type='checkbox' class='form-check-input table-checked chk' name="chk[]" value="<?php echo $row['b_id'] ?>" checked></td>
                                <!-- <td><?php echo $row['b_id'] ?></td> -->
                                <td><?php echo $count_n ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['start'])) ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['end'])) ?></td>
                                <td><?php echo $row['sID'] ?></td>
                                <td><?php echo $row['day'] ?></td>
                                <td><?php echo $row['b_fname'] . ' ' . $row['b_lname'] ?></td>
                                <td>
                                    <?php $date = date('Y-m-d');
                                    if ($row['start'] <= $date) {
                                        if ($row['end'] >= $date) {
                                            echo '<button class="btn btn-info w-100" disabled>อยู่ในระหว่างการเช่า</button>';
                                        } else {
                                            echo '<button class="btn btn-secondary w-100" disabled>การเช่าสิ้นสุดแล้ว</button>';
                                        }
                                    } ?>
                                </td>
                            </tr>
                        <?php $count_n++;
                        endwhile; ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <script src="../backend/script.js"></script>

</body>
<script type="text/javascript">
    function toggle(source) {
        checkboxes = document.getElementsByClassName('chk');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }
    mobiscroll.datepicker('#date', {
        controls: ['date'],
        dateFormat: 'DD/MM/YYYY',
        themeVariant: 'light',
        locale: mobiscroll.localeTh,
    });
</script>

</html>