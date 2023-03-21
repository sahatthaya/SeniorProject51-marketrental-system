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

        switch ($rown['type']) {
            case "4":
                $reply_id = $rown['fk_id'];
                $mkrid = mysqli_query($conn, "SELECT * FROM `reply`JOIN complain ON (complain.comp_id = reply.comp_id) WHERE `rp_id` = $reply_id");
                $mid = mysqli_fetch_array($mkrid);
                extract($mid);
                $fk_id = $mid['mkr_id'];
                $comp_id = $mid['comp_id'];
                $mkr_id = $mid['mkr_id'];
                $path = './thread.php?comp_id=' . $comp_id . '&&mkr_id=' . $mkr_id . '&&my_thread=yes&&newreply=' . $reply_id;
                break;
            case "6":
                $path = './inv_info.php?INV_id=' . $rown['fk_id'];
                break;
            default:
                $path = '#';
        }
    ?>
        <li class="<?php echo $bg ?> border-bottom">
            <a class="dropdown-item" href="<?php echo $path ?>">
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