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

        if ($rown['type'] == '1') {
            $path = '../users-market/annouce.php?fk_id=' . $rown['fk_id'];
        } else {
            $path = '../users-market/partner.php?fk_id=' . $rown['fk_id'];
        }

        switch ($rown['type']) {
            case "1":
                $path = '../users-market/status-applicant.php?fk_id=' . $rown['fk_id'];
                break;
            case "2":
                $path = '../users-market/status-applicant.php?fk_id=' . $rown['fk_id'];
                break;
            case "3":
                $comp_id = $rown['fk_id'];
                $mkrid = mysqli_query($conn, "SELECT * FROM `complain` WHERE `comp_id` = $comp_id");
                $mid = mysqli_fetch_array($mkrid);
                extract($mid);
                $fk_id = $mid['mkr_id'];
                $path = '../users-market/thread.php?comp_id=' . $rown['fk_id'] . '&&mkr_id=' . $fk_id . '&&newpost=1';
                break;
            case "4":
                $reply_id = $rown['fk_id'];
                $mkrid = mysqli_query($conn, "SELECT * FROM `reply`JOIN complain ON (complain.comp_id = reply.comp_id) WHERE `rp_id` = $reply_id");
                $mid = mysqli_fetch_array($mkrid);
                extract($mid);
                $fk_id = $mid['mkr_id'];
                $comp_id = $mid['comp_id'];
                $mkr_id = $mid['mkr_id'];
                $path = '../users-market/thread.php?comp_id=' . $comp_id . '&&mkr_id=' . $mkr_id . '&&newreply=' . $reply_id;
                break;
            case "5":
                $path = './reciept-booking-m.php?b_id=' . $rown['fk_id'];
                break;
            case "6":
                $path = './inv_info-m.php?INV_id=' . $rown['fk_id'];
                break;
            case "7":
                $path = './index.php?mkr_id=' . $rown['fk_id'];
                break;
            default:
                $path = '#';
        }
    ?>
        <li class="<?php echo $bg ?> border-bottom">
            <a class="dropdown-item" href="<?php echo $path ?>">
                <span class="text-secondary"><?php echo date("d/m/Y h:ia", strtotime($rown['timestamp'])) ?></span>
                <br><span class="fw-bold"><?php echo $rown['n_sub'] ?></span>
                <br><span class="text-break"><?php echo $rown['n_detail'] ?></span>
            </a>
        </li>
    <?php
    endwhile; ?>
<?php
}
?>