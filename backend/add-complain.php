<?php
// ส่งคำร้องเรียน
if (isset($_POST['post-btn'])) {

    $toppic = $_POST['toppic'];
    $subject = $_POST['subject'];
    $comp_detail = $_POST['comp_detail'];
    $users_id = $_SESSION['users_id'];

    $wordchange = ("*");
    $dbquery = mysqli_query($conn, "SELECT * FROM `rude`");
    $rude = array();
    while ($rword = $dbquery->fetch_assoc()) {
        array_push($rude, $rword['rude_word']);
    }
    $num_rows = mysqli_num_rows($dbquery);
    $i = 0;

    for ($i = 0; $i < count($rude); $i++) {
        $comp_detail = preg_replace('/' . $rude[$i] . '/', '***', $comp_detail);
    }

    for ($i = 0; $i < count($rude); $i++) {
        $subject = preg_replace('/' . $rude[$i] . '/', '***', $subject);
    }

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
            $chack = mysqli_query($conn, $sqlInsert);
            if ($chack) {
                echo '<meta http-equiv="refresh" content="1";/>';
                echo "<script type='text/javascript'> success(); </script>";
                $conn->close();
            } else {
                echo "<script>error();</script>";
            }
        }
    } else {
        if (isset($toppic) != "" && isset($subject) != "" && isset($comp_detail) != "") {
            $sqlInsert_nopic = "INSERT INTO complain (`comp_subject`, `comp_detail`, `mkr_id`, `toppic_id`,`users_id`) 
            VALUES ('$subject','$comp_detail','$mkr_id','$toppic','$users_id')";
            $chack = mysqli_query($conn, $sqlInsert_nopic);
            if ($chack) {
                echo '<meta http-equiv="refresh" content="1";/>';
                echo "<script type='text/javascript'> success(); </script>";
                $conn->close();
            } else {
                echo "<script>error();</script>";
            }
        }
    }
}
