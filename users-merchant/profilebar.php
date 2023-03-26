<?php
session_start();
include "../backend/1-import-link.php";

if ($_SESSION['userstype'] == "") {
    echo "<script>plslogin2();</script>;";
} else {
    if ($_SESSION['userstype'] == "1") {
    } else {
        echo "<script>plslogin2();</script>;";
    }
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">



<?php
include "../backend/1-connectDB.php";

$sqllg = "SELECT * FROM contact ";

$resultlg = mysqli_query($conn, $sqllg);

$lg = mysqli_fetch_array($resultlg);

extract($lg);

$users_id = $_SESSION['users_id'];
?>



<head>

    <meta charset="UTF-8">

    <title> MarketRental - user-profile</title>

    <link rel="shortcut icon" type="image/x-icon" href="../<?php echo $lg['ct_logo'] ?>" />

    <link rel="stylesheet" href="../css/profilebar.css" type="text/css">

</head>
<style>
    .noti {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 450px;
    }
</style>




<body>

    <div class="d-flex justify-content-end gap-2 bar">
        <div class="notiicon  dropdown updatenoti" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" id="<?php echo $users_id ?>">
            <a class="position-relative m-1 px-1 pt-1">
                <i class='bx bx-bell fs-5'></i>
                <div id="link_wrapper">

                </div>
            </a>
        </div>
        <ul class="dropdown-menu mt-2 p-0 noti" style=" max-height: 300px;overflow-y: auto;" id="link_wrapper_2">
        </ul>
        <div class="profileicon prevent-select" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">

            <p>ผู้ใช้ทั่วไป : <?php echo $_SESSION['username']; ?></p>

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

<script>
    function loadXMLDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("link_wrapper").innerHTML =
                    this.responseText;
            }
        };
        xhttp.open("GET", "notification_num.php", true);
        xhttp.send();
    }
    setInterval(function() {
        loadXMLDoc();
        // 1sec
    }, 5000);

    window.onload = loadXMLDoc;

    function loadXMLDoc2() {
        var xhttp2 = new XMLHttpRequest();
        xhttp2.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("link_wrapper_2").innerHTML =
                    this.responseText;
            }
        };
        xhttp2.open("GET", "notification_detail.php", true);
        xhttp2.send();
    }
    setInterval(function() {
        loadXMLDoc2();
        // 1sec
    }, 5000);

    window.onload = loadXMLDoc2;

    $(document).ready(function() {

        $("body").on("click", ".updatenoti", function(event) {

            var userid = $(this).attr("id");

            $.ajax({

                url: "../backend/notification.php",

                method: "POST",

                data: {

                    userid: userid

                },
                success: function(data) {

                },
                //on error
                error: function() {}
            });



        })

    });
</script>