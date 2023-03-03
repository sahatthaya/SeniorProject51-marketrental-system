<?php

include "../backend/1-connectDB.php";



if (isset($_POST["b_id"])) {

    $id = $_POST["b_id"];

    $data = "SELECT * FROM market_detail,booking_range,stall WHERE booking_range.stall_id=stall.sKey and stall.market_id = market_detail.mkr_id and b_id = '$id'";

    $output = '';

    $resultdata = mysqli_query($conn, $data);

    $output .= '<div class="table-responsive">  ';

    while ($row = mysqli_fetch_array($resultdata)) {

        $output .= '

        <table class="table table-bordered">

        <tr><h5>ข้อมูลการจอง</h5></tr>

        <tr>  

               <td width="30%"><label>ตลาด</label></td>  

               <td width="70%">' . $row["mkr_name"] . '</td>  

          </tr>  

          <tr>  

               <td width="30%"><label>รหัสแผงค้า</label></td>  

               <td width="70%">' . $row["sID"] . '</td>  

          </tr>  

          <tr>  

               <td width="30%"><label>ช่วงวันที่จอง</label></td>  

               <td width="70%">' . date("d/m/Y", strtotime($row['start'])) . ' - ' . date("d/m/Y", strtotime($row['end'])) . '</td>  

          </tr>  

          <tr>  

               <td width="30%"><label>ระยะเวลาที่จอง</label></td>  

               <td width="70%">' . $row["day"] . ' วัน</td>  

        </tr>  

        <tr>  

               <td width="30%"><label>ราคาค่าเช่าแผง</label></td>  

               <td width="70%">' . $row["sRent"] . ' ' . $row["sPayRange"] . '</td>  

        </tr>   

        <tr>  

               <td width="30%"><label>ราคาค่ามัดจำ</label></td>  

               <td width="70%">' . $row["sDept"] . ' บาท</td>  

        </tr>   

        </table>  

        <table class="table table-bordered">

        <tr><h5>ข้อมูลการชำระเงิน</h5></tr>

        <tr>  

               <td width="30%"><label>ชำระเงินเมื่อวันที่</label></td>  

               <td width="70%">' . date("d/m/Y เวลา h:ia", strtotime($row['timestamp'])) . '</td>  

          </tr> 

          <tr>  

               <td width="30%"><label>รหัสการชำระ</label></td>  

               <td width="70%">' . $row["code_pay"] . '</td>  

          </tr>

          <tr>  

               <td width="30%"><label>ค่ามัดจำ</label></td>  

               <td width="70%">' . $row["dept_pay"] . ' บาท</td>  

          </tr>

          <tr>  

               <td width="30%"><label>ค่าบริการและภาษี <span class="text-secondary">(4.07%)</span></label></td>  

               <td width="70%">' . $row["fee_pay"] . ' บาท</td>  

          </tr> 

          <tr>  

          <td width="30%"><label>รวมทั้งสิ้น</label></td>  

          <td width="70%">' . $row["total_pay"] . ' บาท</td>  

     </tr>   

        </table>  



     ';

    }

    $output .= '  

    

</div>  

';

    echo $output;

}



if (isset($_POST["b_id2"])) {

    $id = $_POST["b_id2"];

    $data = "SELECT * FROM market_detail,booking_period,opening_period,stall WHERE booking_period.op_id=opening_period.id and opening_period.mkr_id = market_detail.mkr_id and booking_period.stall_id = stall.sKey and b_id = '$id'";

    $output = '';

    $resultdata = mysqli_query($conn, $data);

    $output .= '<div class="table-responsive">  ';

    while ($row = mysqli_fetch_array($resultdata)) {

        $output .= '

        <table class="table table-bordered">

        <tr><h5>ข้อมูลการจอง</h5></tr>

        <tr>  

               <td width="30%"><label>ตลาด</label></td>  

               <td width="70%">' . $row["mkr_name"] . '</td>          

        </tr>   

          <tr>  

               <td width="30%"><label>รหัสแผงค้า</label></td>  

               <td width="70%">' . $row["sID"] . '</td>  

          </tr> 

          <tr>  

            <td width="30%"><label>ผู้จอง</label></td>  

            <td width="70%">' . $row["b_fname"] . ' ' . $row["b_lname"] . '</td>  

          </tr>  

          <tr>  

               <td width="30%"><label>ช่วงวันที่จอง</label></td>  

               <td width="70%">' . date("d/m/Y", strtotime($row['start'])) . ' - ' . date("d/m/Y", strtotime($row['end'])) . '</td>  

          </tr>  

          <tr>  

               <td width="30%"><label>ระยะเวลาที่จอง</label></td>  

               <td width="70%">' . $row["day"] . ' วัน</td>  

        </tr>  

        <tr>  

               <td width="30%"><label>ราคาค่าเช่าแผง</label></td>  

               <td width="70%">' . $row["sRent"] . ' ' . $row["sPayRange"] . '</td>  

        </tr>   

        <tr>  

               <td width="30%"><label>ราคาค่ามัดจำ</label></td>  

               <td width="70%">' . $row["sDept"] . ' บาท</td>  

        </tr>   

        </table>  

        <table class="table table-bordered">

        <tr><h5>ข้อมูลการชำระเงิน</h5></tr>

          <tr>  

          <td width="30%"><label>ชำระเงินเมื่อวันที่</label></td>  

          <td width="70%">' . date("d/m/Y เวลา h:ia", strtotime($row['timestamp'])) . '</td>  

        </tr> 

          <tr>  

               <td width="30%"><label>รหัสการชำระ</label></td>  

               <td width="70%">' . $row["code_pay"] . '</td>  

          </tr>

          <tr>  

               <td width="30%"><label>ค่ามัดจำ</label></td>  

               <td width="70%">' . $row["dept_pay"] . ' บาท</td>  

          </tr>

          <tr>  

               <td width="30%"><label>ค่าบริการและภาษี <span class="text-secondary">(4.07%)</span></label></td>  

               <td width="70%">' . $row["fee_pay"] . ' บาท</td>  

          </tr> 

          <tr>  

          <td width="30%"><label>รวมทั้งสิ้น</label></td>  

          <td width="70%">' . $row["total_pay"] . ' บาท</td>  

     </tr>   

        </table>  



     ';

    }

    $output .= '  

    

</div>  

';

    echo $output;

}

?>

<div id="bannerdataModal" class="modal fade" role="dialog">

    <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">รายละเอียดการจอง</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body" id="bannerdetail">



            </div>



        </div>

    </div>

</div>