<?php
session_start();
include "../backend/1-connectDB.php";
$users_id = $_SESSION['users_id'];
$notiqry = mysqli_query($conn, "SELECT * FROM `notification` WHERE `users_id` = '$users_id' order by `timestamp` DESC LIMIT 10");
$numRownt = mysqli_num_rows($notiqry);
?>

<?php
if ($numRownt == 0) { ?>
    <li class="p-2">
        <div class="dropdown-item" href="#"><span class="text-secondary">ไม่การแจ้งเตือนในขณะนี้</span></div>
    </li>
    <?php } else {
    while ($rown = $notiqry->fetch_assoc()) :
        if ($rown['status'] == '1') {
            $bg = 'bg-info bg-opacity-10';
        } else {
            $bg = '';
        }
    ?>
        <li class="<?php echo $bg ?> border-bottom">
            <a class="dropdown-item" href="#">
                <span class="text-secondary"><?php echo date("d/m/Y h:ia", strtotime($rown['timestamp'])) ?></span>
                <br><span class="fw-bold"><?php echo $rown['n_sub'] ?></span>
                <br><?php echo $rown['n_detail'] ?>
            </a>
        </li>
    <?php
    endwhile; ?>
<?php
}
?>