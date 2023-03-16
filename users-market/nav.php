<!DOCTYPE html>

<html lang="en" dir="ltr">

<?php

include "../backend/1-connectDB.php";

$sqllg = "SELECT * FROM contact ";

$resultlg = mysqli_query($conn, $sqllg);

$lg = mysqli_fetch_array($resultlg);

extract($lg);

?>



<head>

    <meta charset="UTF-8">

    <title> MarketRental - sidebar menu</title>



    <link rel="stylesheet" href="../css/nav.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<?

include "../backend/1-import-link.php";

?>



<body>

    <div class="sidebar close">

        <div class="logo-details">

            <img class="img-menu" src="../<?php echo $lg['ct_logo'] ?>" alt="logo">

            <span class="logo_name">Market Rental</span>

        </div>

        <ul class="nav-links">

            <li class="navlink">

                <a href="index.php">

                    <i class='bx bxs-home'></i>

                    <span class="link_name">หน้าหลัก</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="index.php">หน้าหลัก</a></li>

                </ul>

            </li>

            <li class="navlink">

                <a href="status-applicant.php">

                    <i class='bx bxs-plus-circle'></i>

                    <span class="link_name">คำขอเพิ่มตลาดใหม่</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="status-applicant.php">คำขอเพิ่มตลาดใหม่</a></li>

                </ul>

            </li>
            <li class="navlink">

                <a href="status-announce.php">

                    <i class='bx bxs-megaphone'></i>

                    <span class="link_name">คำขอประชาสัมพันธ์</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="status-announce.php">คำขอประชาสัมพันธ์</a></li>

                </ul>

            </li>
            <li class="navlink">

                <a href="contact.php">

                    <img src="../asset/contact/logo-icon.png" alt="" style="width:25px;">

                    <span class="link_name">เกี่ยวกับเว็บไซต์</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="contact.php">เกี่ยวกับเว็บไซต์</a></li>

                </ul>

            </li>

        </ul>

    </div>



</body>

<script>
    let sidebar = document.querySelector(".sidebar");

    let sidebarBtn = document.querySelector(".img-menu");

    console.log(sidebarBtn);

    sidebarBtn.addEventListener("click", () => {

        sidebar.classList.toggle("close");

    });

    let arrow = document.querySelectorAll(".arrowdrop");

    for (var i = 0; i < arrow.length; i++) {

        arrow[i].addEventListener("click", (e) => {

            let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow

            arrowParent.classList.toggle("showMenu");

        });

    }
</script>

<!-- <nav class="nv-bar navbar navbar-expand-lg bg-body-tertiary fixed-top ">
    <div class="container-fluid">
        <div class="d-flex">
            <button class="navbar-toggler border-0 me-2 " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class='bx bx-menu text-white fs-2'></i>
            </button>
        </div>
        <a class="navbar-brand text-white" href="index.php">Market-Rental</a>

        <div class="d-flex">
            <div class="dropdown dd-show">
                <button class="btn dropdown pe-1 border-0 position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class='bx bx-bell fs-3 text-white me-1'></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        99+
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </button>
                <ul class="dropdown-menu ">
                    <li><a class="dropdown-item" href="#"><span class="text-secondary">10/10/2023 15:25 </span><br>ตลาดโดมเขียว <br> มีการจองใหม่แผงค้า A01 </a></li>
                    <li>
                        <hr>
                    </li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
            <div class="dropdown dd-show">
                <button class="btn dropdown-toggle pe-1 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class='bx bx-user fs-3 text-white me-1'></i>
                </button>
                <ul class="dropdown-menu ">
                    <li><a class="dropdown-item" href="edit-profile.php"><i class='bx bxs-user-detail'></i>แก้ไขโปรไฟล์</a></li>
                    <li><a class="dropdown-item" href="password.php"><i class='bx bx-key'></i>เปลี่ยนรหัสผ่าน</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" style="color: red;" href="../backend/auth-logout.php"><i class='bx bx-log-out-circle'></i>ออกจากระบบ</a></li>
                </ul>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item mx-3 mt-2">
                    <a href="index.php" class="text-decoration-none text-white">
                        <span class="link_name">หน้าหลัก</span>
                    </a>
                </li>
                <hr class="text-white">
                <li class="nav-item mx-3 mt-2">
                    <a href="applicant.php" class="text-decoration-none text-white">
                        <span class="link_name">ส่งคำร้องเพิ่มตลาดใหม่</span>
                    </a>
                </li>
                <hr class="text-white">
                <li class="nav-item mx-3 mt-2">
                    <a href="announce.php" class="text-decoration-none text-white">
                        <span class="link_name">ส่งคำร้องประชาสัมพันธ์</span>
                    </a>
                </li>
                <hr class="text-white">
                <li class="nav-item mx-3 mt-2">
                    <a href="status-applicant.php" class="text-decoration-none text-white">
                        <span class="link_name">สถานะคำขอเพิ่มตลาดใหม่</span>
                    </a>
                </li>
                <hr class="text-white">
                <li class="nav-item mx-3 mt-2">
                    <a href="status-announce.php" class="text-decoration-none text-white">
                        <span class="link_name">สถานะคำขอประชาสัมพันธ์</span>
                    </a>
                </li>
                <hr class="text-white">
                <li class="nav-item mx-3 mt-2">
                    <a href="contact.php" class="text-decoration-none text-white">
                        <span class="link_name">เกี่ยวกับเว็บไซต์</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav> -->

</html>