<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> sidebar menu</title>
    <link rel="stylesheet" href="../css/nav.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?
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
                <a href="index.php">
                    <i class='bx bxs-home'></i>
                    <span class="link_name">หน้าหลัก</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="index.php">หน้าหลัก</a></li>
                </ul>
            </li>
            <li class="navlink">
                <a href="applicant.php">
                    <i class='bx bxs-plus-circle'></i>
                    <span class="link_name">ส่งคำร้องเพิ่มตลาดใหม่</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="applicant.php">ส่งคำร้องเพิ่มตลาดใหม่</a></li>
                </ul>
            </li>
            <li class="navlink">
                <a href="announce.php">
                    <i class='bx bxs-megaphone'></i>
                    <span class="link_name">ส่งคำร้องประชาสัมพันธ์</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="announce.php">ส่งคำร้องประชาสัมพันธ์</a></li>
                </ul>
            </li>
            <li class="navlink arrowdrop">
                <a class="iocn-link">
                    <i class='bx bxs-cog'></i>
                    <span class="link_name">ติดตามสถานะคำร้อง</span><i class='bx bxs-chevron-down arrow'></i>
                </a>

                <ul class="sub-menu dropdown">
                    <li class="drop"><a href="status-applicant.php"><i class='bx bxs-edit-alt'></i>สถานะคำขอพาร์ทเนอร์</a></li>
                    <li class="drop"><a href="status-announce.php"><i class='bx bx-wallet'></i>สถานะคำขอประชาสัมพันธ์</a></li>
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

</html>