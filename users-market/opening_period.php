<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - จัดการรอบการเปิดทำการตลาด</title>

    <!-- css  -->
    <link rel="stylesheet" href="../css/overview.css" type="text/css">
    <link rel="stylesheet" href="../css/banner.css" type="text/css">

</head>
<?php
include "profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
include "../backend/qry-overview.php";
if (isset($_GET['delop_id'])) {
    $id = $_GET['delop_id'];
    $del = mysqli_query($conn, "DELETE FROM `opening_period` WHERE `id`= $id ");
    if ($del) {
        echo "<script type='text/javascript'> delsuccess(); </script>";
    } else {
        echo "<script>error();</script>";
    }
}
?>
<script src="../backend/script.js"></script>



<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item fs-5 "><a href="./overview.php?mkr_id=<?php echo $mkr_id ?>" class="text-decoration-none">ภาพรวมตลาด <?php echo $row['mkr_name']; ?></a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">จัดการรอบการเปิดทำการตลาด</li>
        </ol>
    </nav>

    <h1>จัดการรอบการเปิดทำการตลาด <?php echo $row['mkr_name']; ?></h1>
    <!-- <?php echo $opening_period ?> -->
    <div class="border rounded shadow-sm mt-4 p-3 ">
        <h4 class="mt-2 mb-2">เพิ่มรอบการเปิดทำการ</h4>
        <div class="w-100">
            <form action="" method="post">
                <input id="demo-range-selection" name="daterange" hidden />
                <div class="text-end">
                    <button type="submit" class="btn btn-primary mt-2" name="sdate">เพิ่มรอบ</button>
                </div>
            </form>
        </div>
    </div>


    <div id="table" class="bannertb border p-3 shadow-sm rounded mt-3">
        <h4 class="mt-2">รอบการเปิดทำการ</h4>
        <hr>
        <div class="table-responsive-lg">
            <table id="myTable" class="display table" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">รอบที่</th>
                        <th scope="col">วันที่เริ่ม</th>
                        <th scope="col">วันที่สุดท้าย</th>
                        <th scope="col">จำนวน (วัน)</th>
                        <th scope="col">หมายเหตุ</th>
                        <th scope="col">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row1 = $qryperiod->fetch_assoc()) : ?>
                        <tr>
                            <td class="border"><?php echo $count_n; ?></td>
                            <td class="border"><?php echo date("d/m/Y", strtotime($row1['start'])) ?></td>
                            <td class="border"><?php echo date("d/m/Y", strtotime($row1['end'])) ?></td>
                            <td class="border">
                                <?php
                                echo $row1['day'];
                                ?>
                            </td>
                            <td class="border">
                               <span class="fst-italic" ><?php echo $row1['edit_time'] ?></span>
                            </td>
                            <td class="border">
                                <div class="box">
                                    <a type="button" class="btn btn-outline-warning modal_data1" id="<?php echo $row1['id']; ?>">แก้ไข</a>
                                    <a type="button" class="btn btn-outline-danger" href="./opening_period.php?delop_id=<?php echo $row1['id'] ?>&mkr_id=<?php echo $row1['mkr_id'] ?>" onclick="return confirm('คุณต้องการลบรอบวันที่ <?php echo  date('d/m/Y', strtotime($row1['start'])) ?> - <?php echo  date('d/m/Y', strtotime($row1['start'])) ?> หรือไม่')">ลบ</a>
                                </div>
                            </td>
                        </tr>
                    <?php $count_n++;
                    endwhile ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
<?php require '../backend/modal-edit-opening-period.php' ?>

<script>
    $(document).ready(function() {
        $("body").tooltip({
            selector: '[data-toggle=tooltip]',
            placement: 'right'
        });
    });

    // datepicker

    mobiscroll.setOptions({
        locale: mobiscroll.localeTh,
        theme: 'ios',
        themeVariant: 'light'
    });
    var colorset = [
        '#abdee6',
        '#cbaacb',
        '#ffffb5',
        '#ffccb6',
        '#f3b0c3',
        '#c6dbda',
        '#fee1e8',
        '#fed7c3',
        '#f6eac2',
        '#ecd5e3',
        'ff968a'
    ];

    mobiscroll.datepicker('#demo-range-selection', {
        controls: ['calendar'],
        display: 'inline',
        rangeSelectMode: 'wizard',
        select: 'range',
        showRangeLabels: false,
        colors: [
            <?php
            $countcolor = 0;
            while ($q = $qrycalendar->fetch_assoc()) : ?> {
                    start: new Date(<?php
                                    $start = strtotime(str_replace('-', '/', $q['start']));
                                    echo date("Y,m,d", strtotime("-1 month", $start))
                                    ?>),
                    end: new Date(<?php
                                    $end = strtotime(str_replace('-', '/', $q['end']));
                                    echo date("Y,m,d", strtotime("-1 month", $end))
                                    ?>),
                    background: colorset[<?php echo $countcolor; ?>]


                },
            <?php
                $countcolor++;
                if ($countcolor > 10) {
                    $countcolor = 0;
                }
            endwhile ?>
        ]

    });

    //detail req popup
    $(document).ready(function() {
        $("body").on("click", ".modal_data1", function(event) {
            var anid = $(this).attr("id");
            $.ajax({
                url: "../backend/modal-edit-opening-period.php",
                method: "POST",
                data: {
                    anid: anid
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