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

                <a href="all-market.php">

                    <i class='bx bx-store text-light'></i>

                    <span class="link_name">ตลาดทั้งหมด</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="all-market.php">ตลาดทั้งหมด</a></li>

                </ul>

            </li>
            <li class="navlink">

                <a href="rent.php">

                    <i class='bx bx-calendar-edit text-light'></i>

                    <span class="link_name">จัดการการจอง</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="rent.php">จัดการการจอง</a></li>

                </ul>

            </li>
            <li class="navlink">

                <a href="payment.php">
                    <i class='bx bx-wallet' style='color:#ffffff'></i>

                    <span class="link_name">ชำระค่าเช่า</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="payment.php">ชำระค่าเช่า</a></li>

                </ul>

            </li>
            <li class="navlink">
                <a href="comp-status.php">

                    <i class='bx bxs-megaphone'></i>

                    <span class="link_name">ติดตามคำร้องเรียน</span>

                </a>

                <ul class="sub-menu blank">

                    <li><a class="link_name" href="comp-status.php">ติดตามคำร้องเรียน</a></li>

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
</body>

</html>