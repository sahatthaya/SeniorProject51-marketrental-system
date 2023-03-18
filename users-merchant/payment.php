<?php

include "profilebar.php";

?>
<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - ชำระค่าเช่าแผง</title>

    <link rel="stylesheet" href="../css/banner.css" type="text/css">

    <link rel="stylesheet" href="../css/payment.css" type="text/css">



</head>



<?php

include "nav.php";

include "../backend/1-connectDB.php";


$userid = $_SESSION['users_id'];

$qrybill = mysqli_query($conn, "SELECT `invoice`.*,booking.b_fname,booking.b_lname,stall.sID,market_detail.mkr_name FROM `invoice`,booking,stall,market_detail WHERE (booking.b_id = invoice.b_id AND stall.sKey = booking.stall_id AND market_detail.mkr_id = invoice.mkr_id AND booking.`users_id`= '$userid')");




?>



<body>

    <h1 id="headline">ชำระค่าเช่าแผง</h1>

    <div>

        <div id="table" class="bannertb border p-3 shadow-sm rounded mt-3">

            <table id="myTable" class="display table table-striped dt-responsive" style="width: 100%;">

                <thead>

                    <tr>

                        <th scope="col">ลำดับ</th>

                        <th scope="col">วันที่ส่งใบเรียกเก็บค่าเช่า</th>

                        <th scope="col">รหัสใบเรียกเก็บค่าเช่า</th>

                        <th scope="col">ชื่อตลาด</th>

                        <th scope="col">รหัสแผงค้า</th>

                        <th scope="col">ราคาค่าเช่า</th>

                        <th scope="col">สถานะ</th>

                        <th scope="col">รายละเอียด/ชำระค่าเช่า</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                    $count_n = 1;

                    while ($row = $qrybill->fetch_assoc()) :

                        @$fee = number_format((4.07 / 100) * $row["INV_rentprice"], 2, '.', '');

                        $INV_id = $row['INV_id'];

                        $qrycost = mysqli_query($conn, "SELECT * FROM `inv_cost` WHERE `INV_id`= '$INV_id'");

                        $numRowsop = mysqli_num_rows($qrycost);

                        if ($numRowsop > 0) {

                            $cost = 0;

                            while ($rowc = mysqli_fetch_assoc($qrycost)) {

                                $cost = $cost + $rowc["price"];
                            }

                            $total = $row["INV_rentprice"] - $row["INV_discount"] + $cost + $fee;
                        } else {
                            $total = $row["INV_rentprice"] - $row["INV_discount"] + $fee;
                        }


                    ?>

                        <tr>

                            <td><?php echo $count_n ?></td>

                            <td><?php echo  date("d/m/Y", strtotime($row['INV_created'])) ?></td>

                            <td><?php echo $row['INV_id'] ?></td>

                            <td><?php echo $row['mkr_name'] ?></td>

                            <td><?php echo $row['sID'] ?></td>

                            <td><?php echo number_format(round($total)) ?> บาท</td>

                            </td>

                            <?php

                            if ($row['INV_status'] == '1') {

                                echo '<td class="text-danger">ยังไม่ชำระ</td>';
                            } else {

                                echo '<td class="text-success">ชำระแล้ว</td>';
                            }

                            ?>

                            <td><a type="button" href="../ExportPDF-master/inv_info.php?INV_id=<?php echo $row['INV_id'] ?>" class="btn btn-outline-primary">ดูรายละเอียด</a></td>



                        <?php $count_n++;

                    endwhile; ?>

                </tbody>

            </table>

        </div>

    </div>

</body>

<script src="../backend/script.js"></script>



<script>
    // apply detail popup

    $(document).ready(function() {

        $('.view_data').click(function() {

            var mkrdid = $(this).attr("id");

            $.ajax({

                url: "admin-req-pn-select.php",

                method: "POST",

                data: {

                    mkrdid: mkrdid

                },

                success: function(data) {

                    $('#detail').html(data);

                    $('#dataModal').modal('show');

                }

            });



        })

    });
</script>



</html>