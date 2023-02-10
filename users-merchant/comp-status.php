<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - ติดตามสถานะคำร้องเรียน</title>

    <link rel="stylesheet" href="../css/banner.css" type="text/css">



</head>

<?php

include "profilebar.php";

?>

<?php

include "nav.php";

include "../backend/1-connectDB.php";



// req status

$count_n = 1;

$userid = $_SESSION['users_id'];

$count_n = 1;

$data = "SELECT complain.*, toppic.toppic , comp_status.*,market_detail.* FROM complain 

JOIN toppic ON (complain.toppic_id = toppic.toppic_id)

JOIN comp_status ON (complain.status = comp_status.cs_id)
JOIN market_detail ON (market_detail.mkr_id = complain.mkr_id)

 WHERE (complain.users_id = '$userid') ORDER BY `timestamp` DESC";

$result = mysqli_query($conn, $data);

?>



<body>

    <div class="content">

        <h1 id="headline">ติดตามสถานะคำร้องเรียน</h1>

        <div>

            <div id="table" class="bannertb border p-3 shadow-sm rounded mt-3">

                <table id="myTable" class="display table table-striped dt-responsive" style="width: 100%;">

                    <thead>

                        <tr>

                            <th scope="col">ลำดับ</th>

                            <th scope="col">วันที่ร้องเรียน</th>

                            <th scope="col">ตลาด</th>

                            <th scope="col">วันที่มีการโต้ตอบล่าสุด</th>

                            <th scope="col">ประเภทการร้องเรียน</th>

                            <th scope="col">หัวข้อการร้องเรียน</th>

                            <th scope="col">สถานะ</th>

                            <th scope="col">ดูรายละเอียด</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while ($row = $result->fetch_assoc()) :
                            $comp_id = $row['comp_id'];
                            $sql2 = "SELECT reply.*,users.username FROM reply 
                               JOIN users ON (reply.users_id = users.users_id) 
                               WHERE (comp_id = '$comp_id')";
                            $query2 = mysqli_query($conn, $sql2);
                            $total_record = mysqli_num_rows($query2);
                            if ($total_record > 0) {
                                $last_id = mysqli_query($conn, "SELECT MAX(timestamp) AS maxid FROM reply WHERE comp_id = $comp_id");
                                $mid = mysqli_fetch_array($last_id);
                                extract($mid);
                                $comp_id = $mid['maxid'];
                                $rpdate = date("d/m/Y", strtotime($comp_id));
                            } else {
                                $rpdate = '<i class="text-secondary">ยังไม่มีการโต้ตอบ</i>';
                            }
                        ?>

                            <tr>

                                <td><?php echo $count_n; ?></td>

                                <td><?php echo date("d/m/Y", strtotime($row['timestamp'])) ?></td>

                                <td><?php echo $row['mkr_name'] ?></td>

                                <td><?php echo $rpdate ?></td>

                                <td><?php echo $row['toppic'] ?></td>

                                <td><?php echo $row['comp_subject'] ?></td>

                                <td>

                                    <div class="p-1 rounded <?php echo $row['cs_color']; ?>"><?php echo $row['cs_name']; ?></div>

                                </td>

                                <td>
                                    <a type="button" class="btn btn-outline-primary modal_data1" href="thread.php?comp_id=<?php echo $row['comp_id']; ?>&&mkr_id=<?php echo $row['mkr_id'] ?>&&my_thread=yes">
                                        ดูรายละเอียด
                                    </a>
                                </td>

                            </tr>

                        <?php $count_n++;

                        endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>

<script src="../backend/script.js"></script>

</html>