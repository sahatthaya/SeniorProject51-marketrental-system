<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> sidebar menu</title>
    <link rel="stylesheet" href="../css/nav.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
include "../backend/import-link.php";
?>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <img class="img-menu" src="../asset/contact/logo.png" alt="logo">
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
                    <i class='bx bxs-contact'></i>
                    <span class="link_name">จัดการข้อมูลติดต่อ</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="contact.php">จัดการข้อมูลติดต่อ</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <script src="../backend/script.js"></script>
    <script>
        //navbar-- nav close------------------------------------------------------------------------------------------------------------
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".img-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>
</body>

</html>