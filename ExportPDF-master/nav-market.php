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

                <a href="../users-market/index.php">

                    <i class='bx bxs-home'></i>

                    <span class="link_name">หน้าหลัก</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="../users-market/index.php">หน้าหลัก</a></li>

                </ul>

            </li>

            <li class="navlink">

                <a href="../users-market/status-applicant.php">

                    <i class='bx bxs-plus-circle'></i>

                    <span class="link_name">คำขอเพิ่มตลาดใหม่</span>


                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="../users-market/status-applicant.php">คำขอประชาสัมพันธ์</a></li>

                </ul>

            </li>
            <li class="navlink">

                <a href="../users-market/status-announce.php">

                    <i class='bx bxs-megaphone'></i>

                    <span class="link_name">คำขอประชาสัมพันธ์</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="../users-market/status-announce.php">คำขอประชาสัมพันธ์</a></li>

                </ul>

            </li>
            <li class="navlink">

                <a href="../users-market/contact.php">

                    <img src="../asset/contact/logo-icon.png" alt="" style="width:25px;">

                    <span class="link_name">เกี่ยวกับเว็บไซต์</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="../users-market/contact.php">เกี่ยวกับเว็บไซต์</a></li>

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