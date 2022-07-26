<?php
// ส่งคำร้องเรียน
if (isset($_POST['post-btn'])) {

    $toppic = $_POST['toppic'];
    $subject = $_POST['subject'];
    $comp_detail = $_POST['comp_detail'];
    $users_id = $_SESSION['users_id'];
    if ($_FILES['compfile']['size'] > 0) {
        date_default_timezone_set('Asia/Bangkok');
        $date = date("Ymd");
        $numrand = (mt_rand());

        // ไฟล์ภาพตลาด
        $compfiletmp = $_FILES['compfile']['tmp_name'];
        $compfileoldname = strrchr($_FILES['compfile']['name'], ".");
        $compfilename = $date . $numrand . $compfileoldname;
        $compfiletype = $_FILES['compfile']['type'];
        $compfilepath = 'asset/complain/' . $compfilename;
        $comppath = '../asset/complain/' . $compfilename;
        if (isset($toppic) != "" && isset($subject) != "" && isset($comp_detail) != "" && isset($compfiletmp) != "") {
            move_uploaded_file($compfiletmp, $comppath);
            $sqlInsert = "INSERT INTO complain (comp_subject,comp_detail,mkr_id,toppic_id,comp_file,users_id) 
            VALUES ('$subject','$comp_detail','$mkr_id','$toppic','$compfilepath','$users_id')";
            if (mysqli_query($conn, $sqlInsert)) {
                echo "<script type='text/javascript'> plslogin(); </script>";
                $conn->close();
            } else {
                echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง');</script>";
            }
        }
    } else {
        if (isset($toppic) != "" && isset($subject) != "" && isset($comp_detail) != "") {
            $sqlInsert_nopic = "INSERT INTO complain (`comp_subject`, `comp_detail`, `mkr_id`, `toppic_id`,`users_id`) 
            VALUES ('$subject','$comp_detail','$mkr_id','$toppic','$users_id')";

            if (mysqli_query($conn, $sqlInsert_nopic)) {
                echo "<script type='text/javascript'> plslogin(); </script>";
                $conn->close();
            } else {
                echo "<script>alert('เกิดข้อผิดพลาดกรุณาลองอีกครั้ง55');</script>";
            }
        }
    }
}
mysqli_close($conn);

?>