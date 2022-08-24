<?php
include "../backend/1-connectDB.php";

if (isset($_POST["sKey"])) {
    $sKey = $_POST["sKey"];
    $data = "SELECT * FROM stall WHERE (sKey = '$sKey')";
    $output = '';
    $result = mysqli_query($conn, $data);
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
        <label>รหัสแผงค้า :</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="stallID" aria-label="รหัสแผงค้า" name="sID" title="กรุณากรอกรหัสแผงค้า เช่น รหัสแผงค้า A01"require value=' . $row['sID'] . '>
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
                    <input type="number" class="form-control" name="KeyID" title="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" value=' . $row['sKey'] . ' hidden>         
     ';
    }
    echo $output;
}

if (isset($_POST['edtStall-submit'])) {
    $sKey = $_POST["KeyID"];
    $sID = $_POST['sID'];
    $sWidth = $_POST['sWidth'];
    $sHeight = $_POST['sHeight'];
    $sAreaUnit = $_POST['sAreaUnit'];
    $sDept = $_POST['sDept'];
    $sPayRange = $_POST['sPayRange'];
    $sRent = $_POST['sRent'];

    if (isset($_POST['sID']) != "" && isset($_POST['sWidth']) != "" && isset($_POST['sHeight']) != "" && isset($_POST['sAreaUnit']) != "" && isset($_POST['sDept']) != "" && isset($_POST['sPayRange']) != "") {
        $sqlInsert = "UPDATE `stall` SET `sKey`=$sKey,`sID`='$sID',`sWidth`='$sWidth',`sHeight`='$sHeight',`sAreaUnit`='$sAreaUnit',`sDept`='$sDept',`sRent`='$sRent',`sPayRange`='$sPayRange' WHERE (sKey = '$sKey') ";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1"; />';

        } else {
            echo "<script type='text/javascript'> error(); </script>";

        }
    } else {
        echo "<script type='text/javascript'> error(); </script>";
    }
}


if(isset($_POST['x'])&& isset($_POST['y'])&&isset($_POST['skey'])){
    $x = $_POST['x'];
    $y=$_POST['y'];
    $sKey = $_POST['skey'];

    echo "<script>alert('$x.$y.$skey')</script>";
}
