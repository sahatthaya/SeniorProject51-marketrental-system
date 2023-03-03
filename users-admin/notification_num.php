<?php
session_start();
include "../backend/1-connectDB.php";
$notiqry2 = mysqli_query($conn, "SELECT * FROM `notification` WHERE `status` = '1'  AND `users_id` ='0' ");
$numRownt2 = mysqli_num_rows($notiqry2);
if ($numRownt2 == 0) {
} else {
    if ($numRownt2 <= 99) {
?>

        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?php echo $numRownt2 ?>
            <span class="visually-hidden">unread messages</span>
        </span>
    <?php
    } else {
    ?>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            99+
            <span class="visually-hidden">unread messages</span>
        </span>
<?php
    }
}
?>