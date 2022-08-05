<?php
include "../backend/1-connectDB.php";


if (isset($_POST['stall-submit'])) {
    $sID = $_POST['sID'];
    $sWidth = $_POST['sWidth'];
    $sHeight = $_POST['sHeight'];
    $sAreaUnit = $_POST['sAreaUnit'];
    $sDept = $_POST['sDept'];
    $sPayRange = $_POST['sPayRange'];
    $sRent = $_POST['sRent'];

    if (isset($_POST['sID']) != "" && isset($_POST['sWidth']) != "" && isset($_POST['sHeight']) != "" && isset($_POST['sAreaUnit']) != "" && isset($_POST['sDept']) != "" && isset($_POST['sPayRange']) != "") {
        $sqlInsert = "INSERT INTO stall (sID,sWidth,sHeight,sAreaUnit,sDept,sPayRange,dropped,market_id,sRent,sStatus) VALUES ('$sID','$sWidth','$sHeight','$sAreaUnit','$sDept','$sPayRange','0', $mkr_id,$sRent,'ว่าง') ";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script>alert('เพิ่มแผงค้าสำเร็จ');</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง55');</script>";
        }
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง);</script>";
    }
}

if (isset($_POST["sKey"])) {
    $sKey = $_POST["sKey"];
    $data = "SELECT * FROM stall WHERE (sKey = '$sKey')";
    $output = '';
    $result = mysqli_query($conn, $data);
    $output .= '<div>';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
        <label>รหัสแผงค้า :</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="stawID" aria-label="รหัสแผงค้า" name="sID" title="กรุณากรอกรหัสแผงค้า เช่น รหัสแผงค้า A01"require value=' . $row['sID'] . '>
                    </div>
                    <label>ขนาดพื้นที่ :</label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="กว้าง" name="sWidth" title="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข"value=' . $row['sWidth'] . ' require>
                        <span class="input-group-text">*</span>
                        <input type="number" class="form-control" placeholder="ยาว" name="sHeight" title="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" value=' . $row['sHeight'] . ' require>
                        <select class="input-group-text" id="inputGroupSelect01" name="sAreaUnit">
                            <option selected value="' . $row['sAreaUnit'] . ' ">' . $row['sAreaUnit'] . ' </option>
                            <option value="เมตร">เมตร</option>
                            <option value="เซนติเมตร">เซนติเมตร</option>
                        </select>
                    </div>
                    <label>ราคามัดจำ :</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="sDept" title="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" value=' . $row['sDept'] . ' require>
                        <span class="input-group-text">บาท</span>
                    </div>
                    <label>ราคาค่าเช่า :</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="sRent" title="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" value=' . $row['sRent'] . ' require>
                        <select class="input-group-text" name="sPayRange">
                            <option selected value="' . $row['sPayRange'] . '">' . $row['sPayRange'] . '</option>
                            <option value="บาท/วัน">บาท/วัน</option>
                            <option value="บาท/เดือน">บาท/เดือน</option>
                        </select>
                    </div>
         
     ';
    }
    $output .= '
</div>  
';
    echo $output;
}
mysqli_close($conn);