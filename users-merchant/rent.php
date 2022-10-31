<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - จัดการการจอง</title>
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>
<script>
    var message = "โปรดทราบ\n หากคุณทำการยกเลิกการจอง\n คุณจะไม่ได้รับเงินมัดจำคืน";
</script>
<?php
include "profilebar.php";
?>
<?php
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";
$users_id = $_SESSION['users_id'];
$count_n = 1;
$queryrangecalen = mysqli_query($conn, "SELECT * FROM market_detail,booking_range,stall WHERE booking_range.stall_id=stall.sKey and stall.market_id = market_detail.mkr_id and booking_range.users_id = $users_id and status = '1'");
$queryperiodcalen = mysqli_query($conn, "SELECT * FROM market_detail,booking_period,opening_period,stall WHERE booking_period.op_id=opening_period.id and opening_period.mkr_id = market_detail.mkr_id and booking_period.stall_id = stall.sKey and booking_period.users_id = $users_id and status = '1'");

$queryrange = mysqli_query($conn, "SELECT * FROM market_detail,booking_range,stall WHERE booking_range.stall_id=stall.sKey and stall.market_id = market_detail.mkr_id and booking_range.users_id = $users_id and status = '1'");
$queryperiod = mysqli_query($conn, "SELECT * FROM market_detail,booking_period,opening_period,stall WHERE booking_period.op_id=opening_period.id and opening_period.mkr_id = market_detail.mkr_id and booking_period.stall_id = stall.sKey and booking_period.users_id = $users_id and status = '1'");

if (isset($_GET['id-del']) != '') {
    $id = $_GET['id-del'];
    $type = $_GET['type'];
    echo "<script>";
    echo "
    Swal.fire({
        title: 'ต้องการยกเลิกการจอง?',
        html: '<strong>โปรดทราบ !</strong> หากผู้จองทำการยกเลิกการจอง<br />ผู้จองจะ<strong><u>ไม่ได้รับเงินมัดจำคืน</u></strong>',
        text: message,
        icon: 'warning',
        confirmButtonColor: '#d33',
        confirmButtonText: 'ฉันต้องการยกเลิกการจอง',
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'rent.php?action=confirm&id=" . $id . "&type=" . $type . "'
        } else{
            window.location.href = './rent.php'
        }
      })";
    echo "</script>";
}
if (isset($_GET['action']) && $_GET['action'] == 'confirm') {
    $id = $_GET['id'];
    $type = $_GET['type'];

    if ($type == 'range') {
        $sql = mysqli_query($conn, "UPDATE `booking_range` SET `status`='0' WHERE `b_id`=$id");
        if ($sql) {
            echo "<script>cancelsuccess()</script>";
        } else {
            echo "<script>alert('error range')</script>";

        }
    } else {
        $sql = mysqli_query($conn, "UPDATE `booking_period` SET `status`='0' WHERE `bp_id`=$id");
        if ($sql) {
            echo "<script>cancelsuccess()</script>";
        } else {
            echo "<script>alert('error period')</script>";

        }
    }
}

?>


<body>
    <div class="content">
        <h1 id="headline">จัดการการจอง</h1>
        <div>
            <div class="text-end mt-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    ปฏิทินการจองของ <?php echo $_SESSION['username']; ?>
                </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">ปฏิทินการจองของ คุณ <?php echo $_SESSION['username']; ?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class=" border rounded" id="demo-events-labels"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="table" class="bannertb border p-3 shadow-sm rounded mt-2">
                <table id="myTable" class="display " style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">วันที่จอง</th>
                            <th scope="col">ชื่อร้านค้า</th>
                            <th scope="col">ชื่อตลาด</th>
                            <th scope="col">รหัสแผงค้า</th>
                            <th scope="col">วันเริ่มเช่า</th>
                            <th scope="col">วันสิ้นสุดการเช่า</th>
                            <th scope="col">ระยะเวลา <br>(วัน)</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $queryrange->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $count_n; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($row['timestamp'])) ?></td>
                                <td><?php echo $row['shopname']; ?></td>
                                <td><?php echo $row['mkr_name']; ?></td>
                                <td><?php echo $row['sID']; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($row['b_start'])) ?></td>
                                <td><?php echo date("d/m/Y", strtotime($row['b_end'])) ?></td>
                                <td><?php echo $row['day']; ?></td>
                                <?php
                                $curr_date = date('Y/m/d');
                                $start = strtotime(str_replace('-', '/', $row['b_start']));
                                $startdate = date("Y/m/d", strtotime("-7 day", $start));
                                if (strtotime($curr_date) < strtotime($startdate)) {
                                    $cancel = '<a type="button" class=" btn btn-outline-danger w-100" href="rent.php?id-del=' . $row['b_id'] . '&type=range">ยกเลิกการจอง</a>';
                                } else {
                                    $cancel = '<button type="button" class="btn btn-outline-secondary w-100" disabled>ไม่สามารถยกเลิกได้</button>';
                                }
                                ?>
                                <td>
                                    <?php echo $cancel; ?>
                                </td>
                            </tr>
                        <?php $count_n++;
                        endwhile; ?>
                        <?php while ($row2 = $queryperiod->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $count_n; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($row2['timestamp'])) ?></td>
                                <td><?php echo $row2['b_shopname']; ?></td>
                                <td><?php echo $row2['mkr_name']; ?></td>
                                <td><?php echo $row2['sID']; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($row2['start'])) ?></td>
                                <td><?php echo date("d/m/Y", strtotime($row2['end'])) ?></td>
                                <td><?php echo $row2['day']; ?></td>
                                <?php
                                $curr_date = date('Y/m/d');
                                $start = strtotime(str_replace('-', '/', $row2['start']));
                                $startdate = date("Y/m/d", strtotime("-7 day", $start));
                                if (strtotime($curr_date) < strtotime($startdate)) {
                                    $cancel = '<a type="button" class=" btn btn-outline-danger w-100" href="rent.php?id-del=' . $row['b_id'] . '&type=period">ยกเลิกการจอง</a>';
                                } else {
                                    $cancel = '<button type="button" class="btn btn-outline-secondary w-100" disabled>ไม่สามารถยกเลิกได้</button>';
                                }
                                ?>
                                <td>
                                    <?php echo $cancel; ?>
                                </td>
                            </tr>
                        <?php $count_n++;
                        endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="../backend/script.js"></script>

<script>
    mobiscroll.setOptions({
        locale: mobiscroll.localeTh,
        theme: 'ios',
        themeVariant: 'light',
        clickToCreate: false,
        dragToCreate: false,
        dragToMove: false,
        dragToResize: false,
        eventDelete: false
    });

    var now = new Date();
    var day = now.getDay();
    var monday = now.getDate() - day + (day == 0 ? -6 : 1);
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

    var colorset1 = [
        '#998888',
        '#f0e4d7',
        '#f3d8d1',
        '#ced6e0',
        '#c7bbbc',
        '#d5cdde',
        '#f2efef',
        '#f4ded9',
        '#c6d5c2',
        '#f2cbf2',
        'ad80a2'
    ];
    mobiscroll.eventcalendar('#demo-events-labels', {
        eventOrder: function(event) {
            return event.accepted ? 1 : -1;
        },
        data: [
            <?php
            $countcolor1 = 0;
            while ($q2 = $queryperiodcalen->fetch_assoc()) : ?> {
                    start: new Date(<?php
                                    $start1 = strtotime(str_replace('-', '/', $q2['start']));
                                    echo date("Y,m,d", strtotime("-1 month", $start1))
                                    ?>),
                    end: new Date(<?php
                                    $end1 = strtotime(str_replace('-', '/', $q2['end']));
                                    echo date("Y,m,d", strtotime("-1 month", $end1))
                                    ?>),
                    title: 'ตลาด<?php echo $q2['mkr_name'] . ' รหัสแผงค้า: ' . $q2['sID']; ?>',
                    color: colorset1[<?php echo $countcolor1; ?>],
                    allDay: true,
                    accepted: false

                },
            <?php
                $countcolor1++;
                if ($countcolor1 > 10) {
                    $countcolor1 = 0;
                }
            endwhile ?>
            <?php
            $countcolor = 0;
            while ($q1 = $queryrangecalen->fetch_assoc()) : ?> {
                    start: new Date(<?php
                                    $start1 = strtotime(str_replace('-', '/', $q1['b_start']));
                                    echo date("Y,m,d", strtotime("-1 month", $start1))
                                    ?>),
                    end: new Date(<?php
                                    $end1 = strtotime(str_replace('-', '/', $q1['b_end']));
                                    echo date("Y,m,d", strtotime("-1 month", $end1))
                                    ?>),
                    title: 'ตลาด<?php echo $q1['mkr_name'] . ' รหัสแผงค้า: ' . $q1['sID']; ?>',
                    color: colorset[<?php echo $countcolor; ?>],
                    allDay: true,
                    accepted: false

                },
            <?php
                $countcolor++;
                if ($countcolor > 10) {
                    $countcolor = 0;
                }
            endwhile ?>

        ]
    });
</script>

</html>