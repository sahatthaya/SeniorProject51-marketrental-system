<?php

include "../backend/1-connectDB.php";



if (isset($_POST["bannerid"])) {

    $id = $_POST["bannerid"];

    $data = "SELECT * FROM banner WHERE bn_id = '$id'";

    $output = '';

    $resultdata = mysqli_query($conn, $data);

    $output .= '<div class="table-responsive">  <table class="table table-bordered">';

    while ($row = mysqli_fetch_array($resultdata)) {

        $output .= '

          <tr>  

               <td width="30%"><label>หัวข้อเรื่อง</label></td>  

               <td width="70%">' . $row["bn_toppic"] . '</td>  

          </tr>  

          <tr>  

               <td width="30%"><label>รายละเอียด</label></td>  

               <td width="70%">' . $row["bn_detail"] . '</td>  

          </tr>    

          <tr>  

               <td width="30%"><label>รูปภาพแบนเนอร์</label></td>  

               <td width="70%"><img style="width:300px;" src=../' . $row["bn_pic"] . '></td>  

          </tr>  

          

     ';

    }

    $output .= '  

     </table>  

</div>  

';

    echo $output;

}

?>

<div id="bannerdataModal" class="modal fade" role="dialog">

    <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">รายละเอียดแบนเนอร์</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body" id="bannerdetail">



            </div>



        </div>

    </div>

</div>