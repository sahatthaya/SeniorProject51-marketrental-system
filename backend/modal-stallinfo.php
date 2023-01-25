<?php
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";

if (isset($_POST["s_id"])) {
    $id = $_POST["s_id"];
    $data = "SELECT stall.*, zone.*,market_detail.* FROM stall JOIN zone ON (stall.z_id = zone.z_id)  JOIN market_detail ON (stall.market_id = market_detail.mkr_id) WHERE  sKey = '$id'";
    $output = '';
    $result = mysqli_query($conn, $data);
    $output .= '<table class="table">
    <tbody>
        ';
    while ($row1 = mysqli_fetch_array($result)) {
        $row1['opening'] == 'เปิดทำการทุกวัน' ? $path = '../users-merchant/booking-form.php' : $path = '../users-merchant/booking-form-period.php';
        $output .= '
        <tr>
            <td>รหัสแผงค้า</td>
            <td>' . $row1['sID'] . '</td>
        </tr>
        <tr>
            <td>ขนาดแผงค้า</td>
            <td>' . number_format($row1['sWidth']) . ' * ' . number_format($row1['sHeight']) . ' เมตร</td>
        </tr>
        <tr>
            <td>ค่ามัดจำ</td>
            <td>' . number_format($row1['sDept']) . ' บาท</td>
        </tr>
        <tr>
            <td>ค่าเช่า</td>
            <td>' . number_format($row1['sRent']) . ' ' . $row1['sPayRange'] . '</td>
        </tr>
        <tr>
            <td>โซน/ประเภทร้านค้า</td>
            <td>' . $row1['z_name'] . '</td>
        </tr>
    </tbody>
</table>
    <div class="text-end">
        <button type="button" class="btn btn-secondary" id="cancel" data-bs-dismiss="modal">ยกเลิก</button>
        <a type="button" class="btn btn-primary" href="' . $path . '?s_id=' . $row1['sKey'] . '&&mkr_id=' . $row1['market_id'] . '" >จองแผงค้า</a>
    </div>
     ';
    }
    echo $output;
};

if (isset($_POST["s_id_no"])) {
    $id = $_POST["s_id_no"];
    $data = "SELECT stall.*, zone.*,market_detail.* FROM stall JOIN zone ON (stall.z_id = zone.z_id)  JOIN market_detail ON (stall.market_id = market_detail.mkr_id) WHERE  sKey = '$id'";
    $output = '';
    $result = mysqli_query($conn, $data);
    $output .= '<table class="table">
    <tbody>
        ';
    while ($row1 = mysqli_fetch_array($result)) {
        $row1['opening'] == 'เปิดทำการทุกวัน' ? $path = '../users-merchant/booking-form.php' : $path = '../users-merchant/booking-form-period.php';
        $output .= '
        <tr>
            <td>รหัสแผงค้า</td>
            <td>' . $row1['sID'] . '</td>
        </tr>
        <tr>
            <td>ขนาดแผงค้า</td>
            <td>' . number_format($row1['sWidth']) . ' * ' . number_format($row1['sHeight']) . ' เมตร</td>
        </tr>
        <tr>
            <td>ค่ามัดจำ</td>
            <td>' . number_format($row1['sDept']) . ' บาท</td>
        </tr>
        <tr>
            <td>ค่าเช่า</td>
            <td>' . number_format($row1['sRent']) . ' ' . $row1['sPayRange'] . '</td>
        </tr>
        <tr>
            <td>โซน/ประเภทร้านค้า</td>
            <td>' . $row1['z_name'] . '</td>
        </tr>
        <tr>
            <td>สถานะ</td>
            <td>ว่าง</td>
        </tr>
    </tbody>
</table>
    <div class="text-end">
        <button type="button" class="btn btn-secondary" id="cancel" data-bs-dismiss="modal">ยกเลิก</button>
        <a type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="plslogin( event )">จองแผงค้า</a>
    </div>
     ';
    }
    echo $output;
};
?>
<script src="../backend/script.js"></script>
<div id="bannerdataModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">รายละเอียดแผงค้า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="bannerdetail">

            </div>
        </div>
    </div>
</div>