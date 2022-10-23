<?php
include "../backend/1-connectDB.php";

if (isset($_POST["s_id"])) {
    $id = $_POST["s_id"];
    $data = "SELECT stall.*, zone.* FROM stall JOIN zone ON (stall.z_id = zone.z_id) WHERE  sKey = '$id'";
    $output = '';
    $result = mysqli_query($conn, $data);
    $output .= '<table class="table">
    <tbody>
        ';
    while ($row1 = mysqli_fetch_array($result)) {
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
        <a type="button" class="btn btn-primary" href="../users-merchant/booking-form.php?s_id=' . $row1['sKey'] . '&&mkr_id='.$row1['market_id'].'" >จองแผงค้า</a>
    </div>
     ';
    }
    echo $output;
};
