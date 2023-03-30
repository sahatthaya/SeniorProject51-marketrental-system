<?php

// ส่งคำร้องเรียน

if (isset($_POST['post-btn'])) {

    $toppic = $_POST['toppic'];
    $subject = $_POST['subject'];
    $comp_detail = $_POST['comp_detail'];
    $users_id = $_SESSION['users_id'];

    $usermkr = $_POST['usermkr'];
    $mkrname = $_POST['mkrname'];


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

    if (isset($toppic) != "" && isset($subject) != "" && isset($comp_detail) != "") {
        $sqlInsert = mysqli_query($conn, "INSERT INTO complain (comp_subject,comp_detail,mkr_id,toppic_id,users_id) 
        VALUES ('$subject','$comp_detail','$mkr_id','$toppic','$users_id')");

        if ($sqlInsert) {
            $last_id = mysqli_query($conn, "SELECT MAX(comp_id) AS maxid FROM complain");
            $mid = mysqli_fetch_array($last_id);
            extract($mid);
            $comp_id = $mid['maxid'];
            $username = $_SESSION['username'];
            $n_detail = 'มีคำร้องเรียนใหม่จาก ' . $username;
            $insertnoti = mysqli_query($conn, "INSERT INTO `notification`(`n_sub`, `n_detail`,`status`, `type`, `fk_id`, `users_id`)
            VALUES ('$mkrname','$n_detail','1','3','$comp_id','$usermkr')");

            if ($_FILES['upload']['size'] > 0) {

                date_default_timezone_set('Asia/Bangkok');
                $date = date("Ymd");
                $numrand = (mt_rand());

                // Count # of uploaded files in array
                $total = count($_FILES['upload']['name']);

                // Loop through each file
                for ($i = 0; $i < $total; $i++) {

                    //Get the temp file path
                    $tmpFile = $_FILES['upload']['tmp_name'][$i];
                    $tmpFileoldname = strrchr($_FILES['upload']['tmp_name'][$i], ".");
                    $tmpFilename = 'asset/complain/' . $date . $numrand . $tmpFileoldname . $i;

                    //Make sure we have a file path
                    if ($tmpFile != "") {
                        //Setup our new file path
                        $Path = "../" . $tmpFilename;

                        //Upload the file into the temp dir
                        if (move_uploaded_file($tmpFile, $Path)) {
                            $insertimg = mysqli_query($conn, "INSERT INTO `img`(`img`, `fk_id`,`type`) VALUES ('$tmpFilename','$comp_id','1')");
                        }
                    }
                }
                echo '<meta http-equiv="refresh" content="1";/>';
                echo "<script type='text/javascript'> success(); </script>";
            } else {
                echo '<meta http-equiv="refresh" content="1";/>';
                echo "<script type='text/javascript'> success(); </script>";
            }
        } else {
            echo "<script>error();</script>";
        }
    }
}

// ตอบกลับ
if (isset($_POST['reply-btn'])) {

    $comp_detail = $_POST['comp_detail'];
    $status = $_POST['status'];
    $comp_id = $_POST['comp_id'];
    $users_id = $_SESSION['users_id'];
    $mkr_name = 'ผู้ดูแลตลาด' . $_POST['mkr_name'];

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
    if (isset($status) != "" && isset($comp_detail) != "") {
        $sqlInsert = mysqli_query($conn, "INSERT INTO `reply`(`rp_detail`, `comp_id`,`users_id`,`mkr_name`) VALUES ('$comp_detail','$comp_id','$users_id','$mkr_name')");
        $updatestatus = mysqli_query($conn, "UPDATE `complain` SET `status`='$status' WHERE `comp_id`='$comp_id'");
        if ($sqlInsert) {
            $last_id = mysqli_query($conn, "SELECT MAX(rp_id) AS maxid FROM reply");
            $mid = mysqli_fetch_array($last_id);
            extract($mid);
            $rp_id = $mid['maxid'];

            $merchantid = mysqli_query($conn, "SELECT * FROM `complain` WHERE `comp_id` = $comp_id");
            $mcid = mysqli_fetch_array($merchantid);
            extract($mcid);
            $usersmc = $mcid['users_id'];


            $n_detail = $mkr_name . ' ได้ตอบกลับการร้องเรียนของคุณ';
            $insertnoti = mysqli_query($conn, "INSERT INTO `notification`(`n_sub`, `n_detail`,`status`, `type`, `fk_id`, `users_id`)
            VALUES ('การร้องเรียน','$n_detail','1','4','$rp_id','$usersmc')");

            if (isset($_FILES['upload']['size'])) {

                date_default_timezone_set('Asia/Bangkok');
                $date = date("Ymd");
                $numrand = (mt_rand());

                // Count # of uploaded files in array
                $total = count($_FILES['upload']['name']);

                // Loop through each file
                for ($i = 0; $i < $total; $i++) {

                    //Get the temp file path
                    $tmpFile = $_FILES['upload']['tmp_name'][$i];
                    $tmpFileoldname = strrchr($_FILES['upload']['tmp_name'][$i], ".");
                    $tmpFilename = 'asset/complain/' . $date . $numrand . $tmpFileoldname . $i;

                    //Make sure we have a file path
                    if ($tmpFile != "") {
                        //Setup our new file path
                        $Path = "../" . $tmpFilename;

                        //Upload the file into the temp dir
                        if (move_uploaded_file($tmpFile, $Path)) {
                            $insertimg = mysqli_query($conn, "INSERT INTO `img`(`img`, `fk_id`,`type`) VALUES ('$tmpFilename','$rp_id','2')");
                        }
                    }
                }
                echo '<meta http-equiv="refresh" content="1";/>';
                echo "<script type='text/javascript'> success(); </script>";
            } else {
                echo '<meta http-equiv="refresh" content="1";/>';
                echo "<script type='text/javascript'> success(); </script>";
            }
        } else {
            echo "<script>error();</script>";
        }
    }
}

if (isset($_POST['reply'])) {

    $comp_detail = $_POST['comp_detail'];
    $comp_id = $_POST['comp_id'];
    $users_id = $_SESSION['users_id'];
    $mkr_name = '';

    $usermkr = $_POST['usermkr'];
    $mkrname = $_POST['mkrname'];

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
    $sqlInsert = mysqli_query($conn, "INSERT INTO `reply`(`rp_detail`, `comp_id`,`users_id`,`mkr_name`) VALUES ('$comp_detail','$comp_id','$users_id','$mkr_name')");
    if ($sqlInsert) {
        $last_id = mysqli_query($conn, "SELECT MAX(rp_id) AS maxid FROM reply");
        $mid = mysqli_fetch_array($last_id);
        extract($mid);
        $comp_id = $mid['maxid'];
        $username = $_SESSION['username'];
        $n_detail = $username . ' ได้ตอบกลับการร้องเรียนของเขา';
        $insertnoti = mysqli_query($conn, "INSERT INTO `notification`(`n_sub`, `n_detail`,`status`, `type`, `fk_id`, `users_id`)
        VALUES ('$mkrname','$n_detail','1','4','$comp_id','$usermkr')");

        if ($_FILES['upload']['size'] > 0) {

            date_default_timezone_set('Asia/Bangkok');
            $date = date("Ymd");
            $numrand = (mt_rand());

            // Count # of uploaded files in array
            $total = count($_FILES['upload']['name']);

            // Loop through each file
            for ($i = 0; $i < $total; $i++) {

                //Get the temp file path
                $tmpFile = $_FILES['upload']['tmp_name'][$i];
                $tmpFileoldname = strrchr($_FILES['upload']['tmp_name'][$i], ".");
                $tmpFilename = 'asset/complain/' . $date . $numrand . $tmpFileoldname . $i;

                //Make sure we have a file path
                if ($tmpFile != "") {
                    //Setup our new file path
                    $Path = "../" . $tmpFilename;

                    //Upload the file into the temp dir
                    if (move_uploaded_file($tmpFile, $Path)) {
                        $insertimg = mysqli_query($conn, "INSERT INTO `img`(`img`, `fk_id`,`type`) VALUES ('$tmpFilename','$comp_id','2')");
                    }
                }
            }
            echo '<meta http-equiv="refresh" content="1";/>';
            echo "<script type='text/javascript'> success(); </script>";
        } else {
            echo '<meta http-equiv="refresh" content="1";/>';
            echo "<script type='text/javascript'> success(); </script>";
        }
    } else {
        echo "<script>error();</script>";
    }
}
