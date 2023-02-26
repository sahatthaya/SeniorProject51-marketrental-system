<?php
session_start();
if ($_SESSION['userstype'] == "") {
    echo "<script>plslogin2();</script>;";
} else {
    if ($_SESSION['userstype'] == "2") {
    } else {
        echo "<script>plslogin2();</script>;";
    }
}
include "../backend/1-import-link.php";

?>

<!DOCTYPE html>

<html lang="en" dir="ltr">



<?php

if (($_SESSION["userstype"] != "2")) {

    echo "<script>plslogin();window.location='../index.php';";
}

include "../backend/1-connectDB.php";

$sqllg = "SELECT * FROM contact ";

$resultlg = mysqli_query($conn, $sqllg);

$lg = mysqli_fetch_array($resultlg);

extract($lg);

?>



<head>

    <meta charset="UTF-8">

    <title> MarketRental - user-profile</title>

    <link rel="shortcut icon" type="image/x-icon" href="../<?php echo $lg['ct_logo'] ?>" />

    <link rel="stylesheet" href="../css/profilebar.css" type="text/css">

</head>



<body>

    <div class="d-flex justify-content-end gap-2 bar">
        <div class="notiicon  dropdown p-2 " type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
            <div class="position-relative px-1 pt-1">
                <i class='bx bx-bell fs-5'></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    99+
                    <span class="visually-hidden">unread messages</span>
            </div>
        </div>
        <ul class="dropdown-menu mt-2" style=" max-height: 300px;overflow-y: auto;">
            <li><a class="dropdown-item" href="#"><span class="text-secondary">10/10/2023 15:25 </span><br>ตลาดโดมเขียว <br> มีการจองใหม่แผงค้า A01 </a></li>
            <li>
                <hr>
            </li>
            <li><a class="dropdown-item" href="#"><span class="text-secondary">10/10/2023 15:25 </span><br>ตลาดโดมเขียว <br> มีการจองใหม่แผงค้า A01 </a></li>
            <li>
                <hr>
            </li>
            <li><a class="dropdown-item" href="#"><span class="text-secondary">10/10/2023 15:25 </span><br>ตลาดโดมเขียว <br> มีการจองใหม่แผงค้า A01 </a></li>
            <li>
                <hr>
            </li>
            <li><a class="dropdown-item" href="#"><span class="text-secondary">10/10/2023 15:25 </span><br>ตลาดโดมเขียว <br> มีการจองใหม่แผงค้า A01 </a></li>
            <li>
                <hr>
            </li>
            <li><a class="dropdown-item" href="#"><span class="text-secondary">10/10/2023 15:25 </span><br>ตลาดโดมเขียว <br> มีการจองใหม่แผงค้า A01 </a></li>
            <li>
                <hr>
            </li>
            <li><a class="dropdown-item" href="#"><span class="text-secondary">10/10/2023 15:25 </span><br>ตลาดโดมเขียว <br> มีการจองใหม่แผงค้า A01 </a></li>
            <li>
                <hr>
            </li>
            <li><a class="dropdown-item" href="#"><span class="text-secondary">10/10/2023 15:25 </span><br>ตลาดโดมเขียว <br> มีการจองใหม่แผงค้า A01 </a></li>
            <li>
                <hr>
            </li>
            <li><a class="dropdown-item" href="#"><span class="text-secondary">10/10/2023 15:25 </span><br>ตลาดโดมเขียว <br> มีการจองใหม่แผงค้า A01 </a></li>
            <li>
                <hr>
            </li>
            <li><a class="dropdown-item" href="#"><span class="text-secondary">10/10/2023 15:25 </span><br>ตลาดโดมเขียว <br> มีการจองใหม่แผงค้า A01 </a></li>
            <li>
                <hr>
            </li>
            <li><a class="dropdown-item" href="#"><span class="text-secondary">10/10/2023 15:25 </span><br>ตลาดโดมเขียว <br> มีการจองใหม่แผงค้า A01 </a></li>
            <li>
                <hr>
            </li>
            <li><a class="dropdown-item" href="#"><span class="text-secondary">10/10/2023 15:25 </span><br>ตลาดโดมเขียว <br> มีการจองใหม่แผงค้า A01 </a></li>
            <li>
                <hr>
            </li>
        </ul>
        <div class="profileicon prevent-select" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">

            <p>เจ้าของตลาด : <?php echo $_SESSION['username']; ?></p>

            <i id="profileicon" class='bx bxs-user-circle bx-md'></i>

        </div>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">

            <li><a class="dropdown-item" href="edit-profile.php"><i class='bx bxs-user-detail'></i>แก้ไขโปรไฟล์</a></li>

            <li><a class="dropdown-item" href="password.php"><i class='bx bx-key'></i>เปลี่ยนรหัสผ่าน</a></li>

            <li>

                <hr class="dropdown-divider">

            </li>

            <li><a class="dropdown-item" style="color: red;" href="../backend/auth-logout.php"><i class='bx bx-log-out-circle'></i>ออกจากระบบ</a></li>

        </ul>

    </div>

</body>



</html>

<? ob_end_flush() ?>