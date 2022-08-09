<?php
include "profilebar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการการจอง</title>
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
</head>
<?php
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";

?>

<body>
    <div class="content">
        <h1 id="headline">จัดการข้อมูลการจอง</h1>
        <div>
            <div id="table">
                <table id="myTable" class="display " style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">ชื่อบัญชีผู้ใช้</th>
                            <th scope="col">รหัสแผงค้า</th>
                            <th scope="col">วันที่เริ่มเช่า</th>
                            <th scope="col">ประเภทร้านค้า</th>
                            <th scope="col">ระยะเวลาเช่า</th>
                            <th scope="col">ใบเสร็จค่ามัดจำ</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>สหัสทยา</td>
                            <td>A01</td>
                            <td>01/08/2022</td>
                            <td>ร้านขายน้ำ</td>
                            <td>2 เดือน</td>
                            <td><a name="view" type="button" class="view_data btn btn-outline-primary  " >ดูรายละเอียด</a>
                            </td>
                            <td>
                                <div style="justify-content: center;">
                                <a href="rentEdit.php" class=" btn btn-outline-info " style="margin-left: 2px;font-size:14px;">แก้ไขข้อมูล</a>
                                    <a href="admin-req-pn-denied.php?req_partner_id=<?php echo $row['req_partner_id']; ?>" onclick="return confirm('คุณต้องการปฏิเสธคำร้องนี้หรือไม่')" class=" btn btn-outline-danger " style="margin-left: 2px;font-size:14px;">ยกเลิกการจอง</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="../backend/script.js"></script>

<script>
    // apply detail popup
    $(document).ready(function() {
        $('.view_data').click(function() {
            var mkrdid = $(this).attr("id");
            $.ajax({
                url: "admin-req-pn-select.php",
                method: "POST",
                data: {
                    mkrdid: mkrdid
                },
                success: function(data) {
                    $('#detail').html(data);
                    $('#dataModal').modal('show');
                }
            });

        })
    });
</script>

</html>