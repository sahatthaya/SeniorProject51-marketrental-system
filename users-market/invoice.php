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
?>

<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item fs-5 "><a href="./rent.php?mkr_id=<?php echo $mkr_id ?>" class="text-decoration-none">จัดการค่าเช่า</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">การเรียกเก็บค่าเช่า <?php echo $row['mkr_name']; ?></li>
        </ol>
    </nav>
    <h1 class="head_contact">การเรียกเก็บค่าเช่า</h1>
    <div id="content">
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
            <!-- <hr> -->
            <table id="myTable" class="display " style="width: 100%;">
                <thead>
                    <tr>
                        <th style=" width:4%;" class="text-center">
                            เลือก
                        </th>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">วันที่เริ่มเช่า</th>
                        <th scope="col">วันที่สิ้นสุด</th>
                        <th scope="col">รหัสแผงค้า</th>
                        <th scope="col">ผู้จอง</th>
                        <th scope="col">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $query->fetch_assoc()) :

                    ?>
                        <tr>
                            <td class='text-center'><input type='checkbox' class='form-check-input table-checked' checked></td>
                            <td><?php echo $count_n ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['start'])) ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['end'])) ?></td>
                            <td><?php echo $row['sID'] ?></td>
                            <td><?php echo $row['b_fname'] . ' ' . $row['b_lname'] ?></td>
                            <td>
                                <?php $date = date('Y-m-d');
                                if ($row['start'] <= $date) {
                                    if ($row['end'] < $date) {
                                        echo '<button class="btn btn-info w-100" disabled>อยู่ในระหว่างการเช่า</button>';
                                    } else {
                                        echo '<button class="btn btn-secondary w-100" disabled>การเช่าสิ้นสุดแล้ว</button>';
                                    }
                                } ?></td>
                        </tr>
                    <?php $count_n++;
                    endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../backend/script.js"></script>

</body>
<script>
    function checked() {
        // if (document.getElementById("checkall").checked) {

        // } else {
        //     var ele = document.getElementsByClassName("table-checked");
        //     for (var i = 0; i < ele.length; i++) {
        //         if (ele[i].type == 'checkbox')
        //             ele[i].checked = false;

        //     }
        // }

        document.getElementsByClassName("table-checked").checked = true;

    }
</script>


</html>