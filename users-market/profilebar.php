<?php
session_start();?>
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
    <div>
        <div class="profileicon " type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
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