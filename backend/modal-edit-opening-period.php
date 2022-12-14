<div id="bannerdataModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขรอบการเปิดทำการ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" class="was-validated">
                <div class="modal-body" id="bannerdetail">

                </div>
                <div class="modal-footer">
                    <div class="text-end px-1">
                        <button type="submit" class="btn btn-primary" name="submit-edit">บันทึกการแก้ไข</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include "../backend/1-connectDB.php";
// แก้ไขรอบ
if (isset($_POST["anid"])) {
    $id = $_POST["anid"];
    $data = mysqli_query($conn, "SELECT * FROM `opening_period` WHERE id = $id");
    $output = '';
    $output .= '<div class="table-responsive">  <table class="table table-bordered">';
    while ($row = mysqli_fetch_array($data)) {
        $date1 = strtr($row['start'], '/', '-');
        $start = date('Y-m-d', strtotime($date1));
        $date2 = strtr($row['end'], '/', '-');
        $end = date('Y-m-d', strtotime($date2));
        $curr_date = date('Y-m-d');
        
        $output .= '
            <input type="text" class="form-control" name="id" value="' . $row['id'] . '" hidden>
            <div class=" row p-1 mw-100 m-0">
                <label for="inputPassword" class="col-sm-2 col-form-label">วันที่เริ่มรอบ</label>
                <div class="col-sm-10 p-0">
                    <input type="date" class="form-control" name="start" min="'.$curr_date.'" value="' . $start . '" required>
                </div>
            </div> 
            <div class="row p-1 mw-100 m-0">
                <label for="inputPassword" class="col-sm-2 col-form-label">วันที่สิ้นสุดรอบ</label>
                <div class="col-sm-10 p-0">
                    <input type="date" class="form-control" name="end" min="'.$curr_date.'" value="' . $end . '" required>
                </div>
            </div>
            
     ';
    }
    echo $output;
} else {
}

if (isset($_POST['submit-edit'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];
    $id = $_POST['id'];
    $update = 'แก้ไขเมื่อวันที่ ' . date("d/m/Y เวลา h:ia");
    if ((isset($start) && isset($end) && isset($id)) != "") {
        $updatesql = mysqli_query($conn, "UPDATE `opening_period` SET `start`='$start',`end`='$end',`edit_time`='$update' WHERE `id`='$id'");
        if ($updatesql) {
            echo "<script type='text/javascript'> success(); </script>";
            echo '<meta http-equiv="refresh" content="1";/>';
        } else {
            echo "<script>error();</script>";
        }
    } else {
        echo "<script>error();</script>";
    }
}
?>