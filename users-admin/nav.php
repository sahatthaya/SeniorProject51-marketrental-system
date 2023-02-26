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

<?php

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

                <a href="../users-admin/banner.php">

                    <i class='bx bxs-home'></i>

                    <span class="link_name">จัดการแบนเนอร์</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="../users-admin/banner.php">จัดการแบนเนอร์</a></li>

                </ul>

            </li>

            <li class="navlink">

                <a href="./annouce.php">

                    <i class='bx bx-clipboard'></i>

                    <span class="link_name">คำร้องประชาสัมพันธ์</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="./annouce.php">คำร้องประชาสัมพันธ์</a></li>

                </ul>

            </li>

            <li class="navlink">

                <a href="partner.php">

                    <i class='bx bxs-store-alt'></i>

                    <span class="link_name">จัดการคำร้องเพิ่มตลาด</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="partner.php">จัดการคำร้องเพิ่มตลาด</a></li>

                </ul>

            </li>

            <li class="navlink">

                <a href="contact.php">

                    <img src="../asset/contact/logo-icon.png" alt="" style="width:25px;">

                    <span class="link_name">แก้ไขข้อมูลเกี่ยวกับเว็บไซต์</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="contact.php">แก้ไขข้อมูลเกี่ยวกับเว็บไซต์</a></li>

                </ul>

            </li>

        </ul>

    </div>

    <script>
        let sidebar = document.querySelector(".sidebar");

        let sidebarBtn = document.querySelector(".img-menu");

        console.log(sidebarBtn);

        sidebarBtn.addEventListener("click", () => {

            sidebar.classList.toggle("close");

        });
    </script>


    <nav class="nv-bar navbar navbar-expand-lg bg-body-tertiary fixed-top ">
        <div class="container-fluid">
            <div class="d-flex">
                <button class="navbar-toggler border-0 me-2 " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class='bx bx-menu text-white fs-2'></i>
                </button>
            </div>
            <a class="navbar-brand text-white" href="banner.php">Market-Rental</a>

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
                    <button class="btn dropdown pe-1 border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                        <a href="banner.php" class="text-decoration-none text-white">
                            <span class="link_name">จัดการแบนเนอร์</span>
                        </a>
                    </li>
                    <hr class="text-white">
                    <li class="nav-item mx-3 mt-2">
                        <a href="annouce.php" class="text-decoration-none text-white">
                            <span class="link_name">คำร้องประชาสัมพันธ์</span>
                        </a>
                    </li>
                    <hr class="text-white">
                    <li class="nav-item mx-3 mt-2">
                        <a href="partner.php" class="text-decoration-none text-white">
                            <span class="link_name">จัดการคำร้องเพิ่มตลาด</span>
                        </a>
                    </li>
                    <hr class="text-white">
                    <li class="nav-item mx-3 mt-2">
                        <a href="contact.php" class="text-decoration-none text-white">
                            <span class="link_name">แก้ไขข้อมูลเกี่ยวกับเว็บไซต์</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>



</html>