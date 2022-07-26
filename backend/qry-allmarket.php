<?php
// mkr query
$data = "SELECT market_detail.*,province.province_name , market_type.market_type FROM market_detail 
JOIN province ON (market_detail.province_id = province.province_id)
JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)
ORDER BY mkr_id DESC";
$result = mysqli_query($conn, $data);

if (isset($_POST["searchsubmit"])) {
    $searchkey = $_POST['search'];
    $data = "SELECT market_detail.*,province.province_name , market_type.market_type FROM market_detail 
    JOIN province ON (market_detail.province_id = province.province_id)
    JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)
    WHERE (mkr_name LIKE '%" . $searchkey . "%' or mkr_name LIKE '%" . $searchkey . "%' or province_name LIKE '%" . $searchkey . "%' or market_type LIKE '%" . $searchkey . "%')";
    $result = mysqli_query($conn, $data);
} else {
    $data = "SELECT market_detail.*,province.province_name , market_type.market_type FROM market_detail 
    JOIN province ON (market_detail.province_id = province.province_id)
    JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)
    ORDER BY mkr_id DESC";
    $result = mysqli_query($conn, $data);
}
if (isset($_POST["reset"])) {
    $data = "SELECT market_detail.*,province.province_name , market_type.market_type FROM market_detail 
    JOIN province ON (market_detail.province_id = province.province_id)
    JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)
    ORDER BY mkr_id DESC";
    $result = mysqli_query($conn, $data);
}
// $output ='';

// if(isset($_POST['query'])){
//     $search = $_POST['query'];
//     $stmt =$conn->prepare("SELECT market_detail.*,province.province_name , market_type.market_type FROM market_detail 
//     JOIN province ON (market_detail.province_id = province.province_id)
//     JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)
//     WHERE (mkr_name LIKE CONCAT('%',?,'%') or mkr_name LIKE CONCAT('%',?,'%') or province_name LIKE CONCAT('%',?,'%') or market_type LIKE CONCAT('%',?,'%')");
//     $stmt->bind_param("ss",$search,$search);
// }else{
//     $stmt=$conn->prepare("SELECT market_detail.*,province.province_name , market_type.market_type FROM market_detail 
//     JOIN province ON (market_detail.province_id = province.province_id)
//     JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)
//     ORDER BY mkr_id DESC");
// }

// $stmt->execute();
// $result=$stmt->get_result();

// if($result->num_rows>0){
//     $output = " <div class='box'>";
//     while ($row = $result->fetch_assoc()){
//         $output.='
//          <a id="market-item" class="marketcard radius10" href="all-mkr-mkrInfo.php?mkr_id='.$row['mkr_id'].'">
//                     <img src="'.$row['mkr_pic'].'" class="radius10 mkrimg " alt="...">
//                     <div class="overlay">
//                         <h4 style="text-align: center;">'. $row['mkr_name'].'</h4>
//                         <div class="row markettag">
//                             <p class="col-6  ptext" style="text-align: center;"><i class="bx bxs-navigation"></i>'.$row['province_name'].'</p>
//                             <p class="col-6  ptext" style="text-align: center;"><i class="bx bxs-info-circle"></i>'. $row['market_type'].'</p>

//                         </div>
//                         <p class="ptext">รายละเอียด : '.$row['mkr_descrip'].'</p>
//                         <p class="ptext">เบอร์ติดต่อ : '.$row['tel'].'</p>
//                         <p class="ptext">อีเมล : '.$row['email'].'</p>
//                         <p class="ptext">จำนวนแผงว่าง : 0 จาก 0</p>
//                     </div>
//                 </a>
//         ';
//     }
//     echo $output;

// }else{
//     echo "<h3> ไม่พบข้อมูล </h3>";
// }
?>