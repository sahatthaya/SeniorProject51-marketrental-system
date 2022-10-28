
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - ชำระค่าเช่าแผง</title>
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
    <link rel="stylesheet" href="../css/payment.css" type="text/css">

</head>
<?php
include "profilebar.php";
?>
<?php
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";

?>

<body>
    <h1 id="headline">ชำระค่าเช่าแผง</h1>
    <div>
        <div id="table" class="bannertb border p-3 shadow-sm rounded mt-3">
            <table id="myTable" class="display " style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">รหัสแผงค้า</th>
                        <th scope="col">ระยะเวลาเช่า</th>
                        <th scope="col">งวดวันที่</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col">ราคาค่าเช่า</th>
                        <th scope="col">ชำระค่าเช่า</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>A01</td>
                        <td>2 เดือน</td>
                        <td>08/08/2022</td>
                        <td>ยังไม่ชำระ</td>
                        <td><button name="view" type="button" class="view_data btn btn-outline-primary  " id="<?php echo $row['req_partner_id']; ?>">ดูรายละเอียด</button>
                        </td>
                        <td>
                            <div style="justify-content: center;">
                                <a class=" btn btn-outline-info " style="margin-left: 2px;font-size:14px;" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">ชำระค่าเช่า</a>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <div class="modal fade modal-payment" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">ชำระค่าเช่าแผงค้า</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="content">
                        <div class="pay-rent-info">
                            <div class="hstack gap-3">
                                <p class="des-pay">งวดวันที่</p>:<input type="date" class="form-control" value="01/08/2022" disabled>
                            </div>
                            <div class="hstack gap-3">
                                <p class="des-pay">ผู้เช่า</p>:<input type="text" class="form-control" value="สหัสทยา เทียนมงคล" disabled>
                            </div>
                            <div class="hstack gap-3">
                                <p class="des-pay">รหัสแผงค้า</p>:<input type="text" class="form-control" value="A10" disabled>
                            </div>
                            <div class="hstack gap-3">
                                <p class="des-pay">ตลาด</p>:<input type="text" class="form-control" value="เปิดท้าย มข" disabled>
                            </div>
                            <div class="hstack gap-3">
                                <p class="des-pay">ราคา</p>:<input type="text" class="form-control" value="1000 บาท/เดือน" disabled>
                            </div>
                            <div class="hstack gap-3">
                                <p class="des-pay">ค่าใช้จ่ายอื่นๆ</p>:<input type="text" class="form-control" value="- " disabled>
                            </div>
                            <div class="hstack gap-3">
                                <p class="des-pay">รวมทั้งสิ้น</p>:<input type="text" class="form-control" value="1000 บาท" disabled>
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="confirm" type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">เสร็จสิ้น</button>

                    </div>
                </div>
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