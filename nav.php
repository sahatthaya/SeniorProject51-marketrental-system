<!DOCTYPE html>

<html lang="en" dir="ltr">

<?php

include "backend/1-connectDB.php";

$sqllg = "SELECT * FROM contact ";

$resultlg = mysqli_query($conn, $sqllg);

$lg = mysqli_fetch_array($resultlg);

extract($lg);

?>



<head>

    <meta charset="UTF-8">

    <title> MarketRental - sidebar menu</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->

    <link rel="stylesheet" href="./css/nav.css" type="text/css">

</head>

<?

include "backend/1-import-link.php";

?>



<body>

    <div class="sidebar close">

        <div class="logo-details">

            <img class="img-menu" src="./<?php echo $lg['ct_logo'] ?>" alt="logo">

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

                <a href="all-market.php">

                    <i class='bx bx-store'></i>

                    <span class="link_name">ตลาดทั้งหมด</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="all-market.php">ตลาดทั้งหมด</a></li>

                </ul>

            </li>

            <li class="navlink">

                <a href="contact.php">

                    <img src="./asset/contact/logo-icon.png" alt="" style="width:25px;">

                    <span class="link_name">เกี่ยวกับเว็บไซต์</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="contact.php">เกี่ยวกับเว็บไซต์</a></li>

                </ul>

            </li>

        </ul>

    </div>

    <script src="backend/script.js"></script>

    <script>
        //navbar-- nav close------------------------------------------------------------------------------------------------------------

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
            <a class="navbar-brand text-white" href="index.php">Market-Rental</a>

            <div class="d-flex">
                <div class="d-flex prevent-select py-2  border-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" id="showoff">
                    <i class='bx bx-user fs-3 text-white'></i>
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
                        <a href="all-market.php" class="text-decoration-none text-white">
                            <span class="link_name">ตลาดทั้งหมด</span>
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
    </nav>
</body>



</html>