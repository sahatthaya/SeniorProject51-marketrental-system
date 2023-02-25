<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - ประวัติการจองแผงค้า</title>

    <link rel="stylesheet" href="../css/banner.css" type="text/css">

    <script src='https://code.jquery.com/jquery-3.5.1.js'></script>

    <script src='https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js'></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js'></script>

    <script src='https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js'></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13 .2/jquery-ui.min.js"></script>

    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css" />

</head>

<?php

include "profilebar.php";

?>

<?php

include "nav.php";

include "../backend/1-connectDB.php";

$users_id = $_SESSION['users_id'];
$count_n = 1;
$queryrent = mysqli_query($conn, "SELECT * FROM market_detail,booking,stall WHERE booking.stall_id=stall.sKey and stall.market_id = market_detail.mkr_id and booking.users_id = $users_id ORDER BY `timestamp` DESC");
?>





<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="../users-merchant/rent.php" class="text-decoration-none">จัดการการจอง</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">ประวัติการจองแผงค้า</li>
        </ol>
    </nav>
    <div class="content">

        <h1 id="headline">ประวัติการจองแผงค้า</h1>

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

                    <div class="hstack gap-2">

                        <label><span class="text-secondary text-decoration-underline">ค้นหา</span> การเช่าในวันที่ : </label>

                        <input name="min" id="min" class="form-control w-25" type="text">

                        <label> ถึง </label>

                        <input name="max" id="max" class="form-control w-25" type="text">

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

                            <th scope="col">หมายเหตุ</th>

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

                                <td>

                                    <a name="view" type="button" class="btn btn-outline-primary" href="../ExportPDF-master/reciept-booking.php?b_id=<?php echo $row['b_id']; ?>&&nav=rh" id="<?php echo $row['b_id']; ?>">ดูรายละเอียด</a>

                                </td>

                                <td>

                                    <?php echo $row['status'] == '1' ? '-' : 'การจองถูกยกเลิก' ?>

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