<?php
include "../backend/1-connectDB.php";

if (isset($_POST["INV_id"])) {
    $INV_id = $_POST["INV_id"];
    $data = "SELECT
    *
FROM
    inv_cost,
    invoice,
    cost,
    `cost/unit`,
    booking_period,
    stall,
    inv_status
WHERE
    invoice.INV_id = inv_cost.INV_id AND inv_cost.c_id = cost.c_id AND cost.cu_id = `cost/unit`.`cu_id` AND invoice.b_id = booking_period.b_id AND stall.sKey = booking_period.stall_id AND inv_status.INVS_id = invoice.INV_status AND `invoice`.INV_id = '$INV_id' GROUP BY invoice.INV_id";
    $costinv = mysqli_query($conn, "SELECT
    *
FROM
    inv_cost,
    cost,
    `cost/unit`
WHERE
   inv_cost.c_id = cost.c_id AND cost.cu_id = `cost/unit`.`cu_id` AND INV_id = '$INV_id'");
    $datainv = mysqli_query($conn, "SELECT
    *
FROM
    inv_cost,
    invoice,
    cost,
    `cost/unit`,
    booking_period,
    stall,
    inv_status
WHERE
    invoice.INV_id = inv_cost.INV_id AND inv_cost.c_id = cost.c_id AND cost.cu_id = `cost/unit`.`cu_id` AND invoice.b_id = booking_period.b_id AND stall.sKey = booking_period.stall_id AND inv_status.INVS_id = invoice.INV_status AND `invoice`.INV_id = '$INV_id' GROUP BY invoice.INV_id");
    $output1 = '';
    $output2 = '';
    $output3 = '';
    $output4 = '';

    $datainv2 = mysqli_query($conn, "SELECT
    *
FROM
    inv_cost,
    invoice,
    cost,
    `cost/unit`,
    booking_period,
    stall,
    inv_status
WHERE
    invoice.INV_id = inv_cost.INV_id AND inv_cost.c_id = cost.c_id AND cost.cu_id = `cost/unit`.`cu_id` AND invoice.b_id = booking_period.b_id AND stall.sKey = booking_period.stall_id AND inv_status.INVS_id = invoice.INV_status AND `invoice`.INV_id = '$INV_id' GROUP BY invoice.INV_id");
    $row5 = mysqli_fetch_array($datainv2);
    extract($row5);

    $resultdata = mysqli_query($conn, $data);
    while ($row = mysqli_fetch_array($resultdata)) {
        $output1 .= '
        <table class="table table-bordered">
        <tr>
            <h5>ใบเรียกเก็บค่าเช่ารหัส <u>' . $row['INV_id'] . '</u></h5>
        </tr>
        <tr>
            <td width="30%"><label>วันที่ส่ง</label></td>
            <td width="70%">' . date("วันที่ d/m/Y เวลา h:i a", strtotime($row['INV_created'])) . '</td>
        </tr>
        <tr>
            <td width="30%"><label>หมดเขตชำระวันที่</label></td>
            <td width="70%">' . date("วันที่ d/m/Y", strtotime($row['INV_expired'])) . '</td>
        </tr>
        <tr>
        <td width="30%"><label>สถานะการชำระ</label></td>
        <td width="70%">' . $row['INVS_name'] . '</td>
    </tr>
    <td width="30%"><label>รายการค่าใช้จ่าย</label></td>
    <td width="70%">
        <table class="table">
            <tr>
                <td width="30%"><label>ค่าเช่า</label></td>
                <td width="5%" class="text-primary"><label>+</label></td>
                <td width="65%" class="text-primary">' . $row['INV_rentprice'] . ' บาท (' . $row['sRent'] . ' ' . $row['sPayRange'] . ' * ' . $row['INV_days'] . ' วัน)</td>
            </tr>
     ';
    }
    while ($row1 = $costinv->fetch_assoc()) {
        $output2 .= '
                    <tr>
                        <td width="30%"><label>' . $row1['cu_name'] . '</label></td>
                        <td width="5%" class="text-primary"><label>+</label></td>
                        <td width="65%" class="text-primary"> 40 บาท (' . $row1['cu_price'] . ' ' . $row1['cu_type'] . ' * ' . $row1['c_unit'] . ' หน่วย)</td>
                    </tr>
                   
     ';
    }

    while ($row2 = mysqli_fetch_array($datainv)) {
        $output3 .= '
        <tr>
        <td width="30%"><label>ค่ามัดจำ</label></td>
        <td width="5%" class="text-danger"><label>-</label></td>
        <td width="65%" class="text-danger"> ' . $row2['sDept'] . ' บาท</td>
    </tr>
        <tr class="fw-bold">
        <td width="30%"><label>รวมทั้งสิ้น</label></td>
        <td width="5%"><label>=</label></td>
        <td width="65%"> ' . $row2['INV_total'] . ' บาท</td>
    </tr>
</table>
</td>
</tr>
';
    }
    if ($row5['status'] == '1') {
        echo $output1 . $output2 . $output3;
    } else {
        // while ($row2 = mysqli_fetch_array($resultdata)) {
        $output4 .= '
    </table>
        <table class="table table-bordered">
            <tr>
                <h5>การชำระเงิน</h5>
            </tr>
            <tr>
                <td width="30%"><label>ชำระเงินเมื่อวันที่</label></td>
                <td width="70%"></td>
            </tr>
            <tr>
                <td width="30%"><label>จำนวนที่ต้องชำระ</label></td>
                <td width="70%">
                    <table class="table">
                        <tr>
                            <td width="30%"><label>ยอดธุรกรรม</label></td>
                            <td width="5%"><label>+</label></td>
                            <td width="65%">580 บาท</td>
                        </tr>
                        <tr>
                            <td width="30%"><label>ค่าบริการ (4.07%)</label></td>
                            <td width="5%"><label>+</label></td>
                            <td width="65%">20 บาท</td>
                        </tr>
                        <tr class="fw-bold">
                            <td width="30%"><label>รวมทั้งสิ้น</label></td>
                            <td width="5%"><label>=</label></td>
                            <td width="65%"> 600 บาท</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td width="30%"><label>รหัสการชำระ</label></td>
                <td width="70%">chrg_test_5tq8dwa3svwqtixhlj9</td>
            </tr>
        </table>
         ';
        // }
        echo $output1 . $output2 . $output3 . $output4;
    }
}
?>
<div id="bannerdataModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รายละเอียดการเรียกเก็บค่าเช่า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="bannerdetail">

            </div>

        </div>
    </div>
</div>