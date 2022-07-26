<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> sidebar menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="./css/nav.css" type="text/css">
</head>
<?
include "backend/import-link.php";
?>

<body>
    <div class="sidebar close">
        <div class="logo-details">
            <img class="img-menu" src="./asset/contact/logo.png" alt="logo">
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
                    <i class='bx bxs-file-find'></i>
                    <span class="link_name">ตลาดทั้งหมด</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="all-market.php">ตลาดทั้งหมด</a></li>
                </ul>
            </li>
            <li class="navlink">
                <a href="applicant.php">
                    <i class='bx bxs-store-alt'></i>
                    <span class="link_name">สมัครเป็นพาร์ทเนอร์</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="applicant.php">สมัครเป็นพาร์ทเนอร์</a></li>
                </ul>
            </li>
            <li class="navlink">
                <a href="contact.php">
                    <i class='bx bxs-contact'></i>
                    <span class="link_name">ติดต่อเรา</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="contact.php">ติดต่อเรา</a></li>
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
</body>

</html>