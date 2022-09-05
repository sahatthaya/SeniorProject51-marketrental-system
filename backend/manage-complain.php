<?php
include "../backend/1-connectDB.php";

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $data = "SELECT complain.*, toppic.toppic,users.username FROM complain 
    JOIN toppic ON (complain.toppic_id = toppic.toppic_id)
    JOIN users ON (complain.users_id = users.users_id)
     WHERE (comp_id = '$id')";
    $output = '';
    $result = mysqli_query($conn, $data);
    $output .= '<div class="table-responsive">  <table class="table table-bordered">';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
        <div class="row mw-100">
        <div class="col-4 rounded" style="height:180px;overflow:hidden;">
        <img src="../' . $row['comp_file'] . '"class="img-fluid"alt="" style="width:255px;">
    </div>
    <div class="col-8">
        <h2>หัวข้อ : ' . $row['comp_subject'] . '</h2>
        <p>ประเภท : ' . $row['toppic'] . '</p>
        รายละเอียด : 
        <p> ' . $row['comp_detail'] . '</p>
        <div class="d-flex justify-content-between">
            <p >ผู้ร้องเรียน : ' . $row['username'] . '</p>
            <p>วันที่ร้องเรียน : ' . $row['timestamp'] . '</p>
        </div>
    </div>
        </div>
        <div class="mw-100 mt-3">
                        <h6>การตอบกลับ : </h6><input type="text" name="reply" class="form-control" placeholder="ตอบกลับการร้องเรียน" value=' . $row['reply'] . '>
                        <input type="number" class="form-control" name="comp_id" title="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" value=' . $row['comp_id'] . ' hidden>         
        </div>
     ';
    }
    echo $output;
} else {
}

if (isset($_POST["seeid"])) {
    $id = $_POST["seeid"];
    $data = "SELECT complain.*, toppic.toppic,users.username FROM complain 
    JOIN toppic ON (complain.toppic_id = toppic.toppic_id)
    JOIN users ON (complain.users_id = users.users_id)
     WHERE (comp_id = '$id')";
    $output = '';
    $result = mysqli_query($conn, $data);
    $output .= '<div class="table-responsive">  <table class="table table-bordered">';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '
        <div class="row mw-100">
                        <div class="col-4 rounded" style="height:180px;overflow:hidden;">
                            <img src="../' . $row['comp_file'] . '"class="img-fluid"alt="" style="width:255px;">
                        </div>
                        <div class="col-8">
                            <h2>หัวข้อ : ' . $row['comp_subject'] . '</h2>
                            <p>ประเภท : ' . $row['toppic'] . '</p>
                            รายละเอียด : 
                            <p> ' . $row['comp_detail'] . '</p>
                            <div class="d-flex justify-content-between">
                                <p >ผู้ร้องเรียน : ' . $row['username'] . '</p>
                                <p>วันที่ร้องเรียน : ' . $row['timestamp'] . '</p>
                            </div>
                        </div>
        </div>
        <hr>
        <div class="mw-100 mt-3">
                        <h6>การตอบกลับ : </h6><input type="text" name="reply" class="form-control" placeholder="ตอบกลับการร้องเรียน" value=' . $row['reply'] . ' disabled>
                        <input type="number" class="form-control" name="comp_id" title="กรุณากรอกจำนวนที่ต้องการเป็นตัวเลข" value=' . $row['comp_id'] . ' hidden>         
        </div>
     ';
    }
    echo $output;
} else {
}
if (isset($_POST['submit'])) {
    $comp_id = $_POST["comp_id"];
    $reply = $_POST['reply'];

    if (isset($_POST['reply']) != "") {
        $sqlInsert = "UPDATE complain SET reply='$reply',status='ตอบกลับแล้ว' WHERE (comp_id = '$comp_id')";
        if (mysqli_query($conn, $sqlInsert)) {
            echo "<script>success(); </script>";
        } else {
            echo "<script>error();</script>";
        }
    } else {
        echo "<script>error();</script>";
    }
} else {
}
