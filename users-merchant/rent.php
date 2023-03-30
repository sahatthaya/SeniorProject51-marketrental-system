<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - จัดการการจอง</title>

    <link rel="stylesheet" href="../css/banner.css" type="text/css">

    <script src='https://code.jquery.com/jquery-3.5.1.js'></script>

    <script src='https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js'></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js'></script>

    <script src='https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js'></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13 .2/jquery-ui.min.js"></script>

    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css" />

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

$users_id = $_SESSION['users_id'];
$count_n = 1;
$querycalendar = mysqli_query($conn, "SELECT * FROM market_detail,booking,stall WHERE booking.stall_id=stall.sKey and stall.market_id = market_detail.mkr_id and booking.users_id = $users_id and status = '1'");
$queryrent = mysqli_query($conn, "SELECT * FROM market_detail,booking,stall WHERE booking.stall_id=stall.sKey and stall.market_id = market_detail.mkr_id and booking.users_id = $users_id and status = '1' ORDER BY `timestamp` DESC");




if (isset($_GET['id-del']) != '') {

    $id = $_GET['id-del'];

    $type = $_GET['type'];
    $sKey = $_GET['sKey'];

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

          window.location.href = 'rent.php?action=confirm&id=" . $id . "&type=" . $type . "&sKey=" . $sKey . "'

        } else{

            window.location.href = './rent.php'

        }

      })";

    echo "</script>";
}

if (isset($_GET['action']) && $_GET['action'] == 'confirm') {

    $id = $_GET['id'];
    $sql = mysqli_query($conn, "UPDATE `booking` SET `status`='0' WHERE `b_id`=$id");

    // $stall_id = $_GET['stall_id'];

    $sKeys = $_GET['sKey'];
    $last_id = mysqli_query($conn, "SELECT *  FROM stall JOIN market_detail ON (market_detail.mkr_id = stall.market_id) WHERE sKey = $sKeys");
    $mid = mysqli_fetch_array($last_id);
    extract($mid);

    $binfo = mysqli_query($conn, "SELECT *  FROM booking WHERE `b_id`=$id");
    $bf = mysqli_fetch_array($binfo);
    extract($bf);
    $b_start = date("d/m/Y", strtotime($bf['b_start']));
    $b_end = date("d/m/Y", strtotime($bf['b_end']));
    $sql = mysqli_query($conn, "UPDATE `booking` SET `status`='0' WHERE `b_id`=$id");

    $mkr_name = $mid['mkr_name'];
    $usersmkr_id = $mid['users_id'];
    $sID = $mid['sID'];
    $n_sub = $mkr_name . ' (แผงค้า :' . $sID . ' )';
    $n_detail = 'การจองช่วงวันที่' . $b_start . '-' . $b_end . 'ถูกยกเลิก';

    $insertnoti = mysqli_query($conn, "INSERT INTO `notification`(`n_sub`, `n_detail`,`status`, `type`, `fk_id`, `users_id`)
    VALUES ('$n_sub','$n_detail','1','5','$id','$usersmkr_id')");


    if ($sql) {

        echo "<script>cancelsuccess()</script>";
    } else {

        echo "<script>alert('error range')</script>";
    }
}
?>





<body>

    <div class="content">

        <h1 id="headline">จัดการการจอง</h1>

        <div>

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

                <div class="d-flex justify-content-between">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-sm-7 align-middle">

                                <div class="hstack gap-2">

                                    <label><span class="text-secondary text-decoration-underline">ค้นหา</span> การเช่าในวันที่ : </label>


                                    <input name="min" id="min" class="form-control w-25" type="text">

                                    <label> ถึง </label>

                                    <input name="max" id="max" class="form-control w-25" type="text">

                                </div>
                            </div>



                            <div class="col-md-5 p-0">
                                <div class="hstack gap-2 float-xl-end float-lg-start rent-btn mt-lg-0 mt-md-5 ms-0">


                                    <!-- Button trigger modal -->
                                    <a type="button" class="btn btn-primary btn-calen" href="./rent-history.php">

                                        ประวัติการจองแผงค้า

                                    </a>

                                    <button type="button" class="btn btn-primary btn-calen" data-bs-toggle="modal" data-bs-target="#exampleModal">

                                        ปฏิทินการจองของ <?php echo $_SESSION['username']; ?>

                                    </button>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <hr>

                <table id="myTable" class="display table table-striped dt-responsive" style="width: 100%;">

                    <thead>

                        <tr>

                            <th scope="col">ลำดับ</th>

                            <th scope="col">วันที่จอง</th>

                            <th scope="col">ชื่อร้านค้า</th>

                            <th scope="col">ชื่อตลาด</th>

                            <th scope="col">รหัสแผงค้า</th>

                            <th scope="col">วันเริ่มเช่า</th>

                            <th scope="col">วันสิ้นสุดการเช่า</th>

                            <th scope="col">รายละเอียด</th>

                            <th scope="col">จัดการ</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($row = $queryrent->fetch_assoc()) : ?>

                            <tr>

                                <td><?php echo $count_n; ?></td>

                                <td><?php echo date("d/m/Y", strtotime($row['timestamp'])) ?></td>

                                <td><?php echo $row['b_shopname']; ?></td>

                                <td><?php echo $row['mkr_name']; ?></td>

                                <td><?php echo $row['sID']; ?></td>

                                <td><?php echo date("d/m/Y", strtotime($row['b_start'])) ?></td>

                                <td><?php echo date("d/m/Y", strtotime($row['b_end'])) ?></td>

                                <?php

                                $curr_date = date('Y/m/d');

                                $start = strtotime(str_replace('-', '/', $row['b_start']));

                                $startdate = date("Y/m/d", strtotime("-7 day", $start));

                                if (strtotime($curr_date) <= strtotime($startdate)) {

                                    $cancel = '<a type="button" class=" btn btn-outline-danger w-100" href="rent.php?id-del=' . $row['b_id'] . '&sKey=' . $row['sKey'] . '&type=range">ยกเลิกการจอง</a>';
                                } else {

                                    $cancel = '<button type="button" class="btn btn-outline-secondary w-100" disabled>ไม่สามารถยกเลิกได้</button>';
                                }

                                ?>

                                <td>

                                    <a name="view" type="button" class="btn btn-outline-primary" href="../ExportPDF-master/reciept-booking.php?b_id=<?php echo $row['b_id']; ?>&&nav=r" id="<?php echo $row['b_id']; ?>">ดูรายละเอียด</a>

                                </td>

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
    // rent calendar
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

            while ($q2 = $querycalendar->fetch_assoc()) : ?> {

                    start: new Date(<?php

                                    $start1 = strtotime(str_replace('-', '/', $q2['b_start']));

                                    echo date("Y,m,d", strtotime("-1 month", $start1))

                                    ?>),

                    end: new Date(<?php

                                    $end1 = strtotime(str_replace('-', '/', $q2['b_end']));

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
        ]

    });


    // table date filter
    $(document).ready(function() {

        $.fn.dataTable.ext.search.push(

            function(settings, data, dataIndex) {

                var min = $('#min').datepicker("getDate");

                var max = $('#max').datepicker("getDate");

                var dateString = data[5];

                var dateParts = dateString.split('/');

                var startDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);



                var enddateString = data[6];

                var enddateParts = enddateString.split('/');

                var endDate = new Date(enddateParts[2], enddateParts[1] - 1, enddateParts[0]);



                if (min == null && max == null) {

                    return true;

                }

                if (min == null && startDate <= max) {

                    return true;

                }

                if (max == null && startDate >= min) {

                    return true;

                }

                if (!(startDate > max || endDate < min)) {

                    return true;

                }

                return false;

            }

        );





        $("#min").datepicker({

            changeMonth: true,

            changeYear: true,

            dateFormat: 'dd/mm/yy'

        });

        $("#max").datepicker({

            changeMonth: true,

            changeYear: true,

            dateFormat: 'dd/mm/yy'

        });

        var table = $('#myTable').DataTable();



        $('#min, #max').change(function() {

            table.draw();

        });

    });
</script>



</html>