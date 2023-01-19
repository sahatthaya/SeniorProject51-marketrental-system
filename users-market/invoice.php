<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - จัดการค่าเช่า</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/banner.css" type="text/css">
    <link rel="stylesheet" href="../css/applicant.css" type="text/css">
</head>
<?php
include "./profilebar.php";
include "nav.php";
include "../backend/1-connectDB.php";
include "../backend/1-import-link.php";

$mkr_id = $_GET['mkr_id'];
$sql = "SELECT market_detail.*,users.username ,
    provinces.province_name,
    amphures.amphure_name,
    districts.district_name , 
    market_type.market_type
    FROM market_detail 
        JOIN users ON (market_detail.users_id = users.users_id)
        JOIN provinces ON (market_detail.province_id = provinces.id)
        JOIN amphures ON (market_detail.	amphure_id = amphures.id)
        JOIN districts ON (market_detail.district_id = districts.id)
        JOIN market_type ON (market_detail.market_type_id = market_type.market_type_id)
         WHERE (a_id='1' AND mkr_id = '$mkr_id') ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
extract($row);

$count_n = 1;
if ($row['opening'] == 'เปิดทำการทุกวัน') {
    $query = mysqli_query($conn, "SELECT * FROM `booking_range`JOIN `stall` ON (booking_range.stall_id = stall.sKey) WHERE `stall`.market_id = $mkr_id ORDER BY `start` DESC");
} else {
    $query = mysqli_query($conn, "SELECT * FROM `booking_period`JOIN `stall` ON (booking_period.stall_id = stall.sKey)JOIN `opening_period` ON (booking_period.op_id = opening_period.id) WHERE `stall`.market_id = $mkr_id ORDER BY `start` DESC");
}
?>

<body>
    <nav aria-label="breadcrumb mb-3">
        <ol class="breadcrumb ">
            <li class="breadcrumb-item fs-5 "><a href="./index.php?mkr_id=<?php echo $row['mkr_id']; ?>" class="text-decoration-none">หน้าหลัก</a></li>
            <li class="breadcrumb-item fs-5 "><a href="./rent.php?mkr_id=<?php echo $mkr_id ?>" class="text-decoration-none">จัดการค่าเช่า</a></li>
            <li class="breadcrumb-item active fs-5" aria-current="page">การเรียกเก็บค่าเช่า <?php echo $row['mkr_name']; ?></li>
        </ol>
    </nav>
    <h1 class="head_contact">สร้างใบเรียกเก็บค่าเช่า</h1>
    <div class="form-outer-lg">
        <div class="form-outer form-group " style="overflow: visible;">
            <!-- form--1 -->
            <div id="stepOne" class="row border shadow-sm p-3 mt-3 mb-3 rounded">
                <h4 class="p-0"><span class="text-secondary">ขั้นที่ 1</span> กรอกข้อมูลเพื่อสร้างใบเรียกเก็บค่าเช่า</h4>
                <div class="progress p-0 my-2 mb-3">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">1/2 </div>
                </div>
                <h5 class="px-0">1. เลือกแผงค้า</h5>
                <hr>
                <div class="d-flex justify-content-between px-0">
                    <div class="hstack gap-2 px-0 mb-3">
                        <label style="width: 165px;"><span>ค้นหา : </span>การเช่าในวันที่</label>
                        <input name="min" id="min" class="form-control" type="text" style="width: 165px;">
                        <label> ถึง </label>
                        <input name="max" id="max" class="form-control" type="text" style="width: 165px;">
                    </div>
                </div>
                <div class=" mb-3 border p-3">
                    <table id="myTable" class="display px-0" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style=" width:4%;" class="text-center"> <input type="checkbox" id="checkall" onClick="toggle(this)" class='form-check-input table-checked' checked /></th>
                                <th scope="col">รหัสการจอง</th>
                                <th scope="col">รหัสแผงค้า</th>
                                <th scope="col">วันที่เริ่มจอง</th>
                                <th scope="col">วันที่สิ้นสุด</th>
                                <th scope="col">ผู้จอง</th>
                                <th scope="col">ค่าเช่าแผง</th>
                                <th scope="col">รอบบิลปัจุบัน (บาท)</th>
                                <th scope="col">หมายเหตุ</th>
                                <th scope="col">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $query->fetch_assoc()) :
                                $b_id = $row['b_id'];
                                $qryinv = mysqli_query($conn, "SELECT * FROM `invoice` WHERE `b_id`= $b_id ORDER BY `INV_created`DESC LIMIT 1");
                                $numRowinv = mysqli_num_rows($qryinv);

                                $now = date('Y-m-d');

                                if ($numRowinv == 0) {
                                    if ($row['start'] >  $now) {
                                        $rentbill =  0;
                                        $ps = "-";
                                    } else {
                                        if ($row['end'] <  $now) {
                                            $date1 = date_create($row['end']);
                                            $date2 = date_create($row['start']);
                                            $diff = date_diff($date1, $date2);
                                            $day = $diff->format("%a") + 1;
                                        } else {
                                            $date1 = date_create($now);
                                            $date2 = date_create($row['start']);
                                            $diff = date_diff($date1, $date2);
                                            $day = $diff->format("%a") + 1;
                                        }

                                        $rent =  $day * $row['sRent'];
                                        $rentbill = $rent - $row['dept_pay'];
                                        $ps = "หักค่ามัดจำแล้ว -" . $row['dept_pay'] . " บาท";
                                    }
                                } else {
                                    $rowinv = mysqli_fetch_array($qryinv);
                                    extract($rowinv);

                                    if ($row['end'] <  $now) {
                                        $date1 = date_create($row['end']);
                                        $date2 = date_create($rowinv['INV_created']);
                                        $diff = date_diff($date1, $date2);
                                        $day = $diff->format("%a") + 1;
                                    } else {
                                        $date1 = date_create($now);
                                        $date2 = date_create($rowinv['INV_created']);
                                        $diff = date_diff($date1, $date2);
                                        $day = $diff->format("%a") + 1;
                                    }

                                    $rentbill =  $day * $row['sRent'];
                                    $ps = "-";
                                }
                            ?>
                                <tr>
                                    <td class='text-center'><input type='checkbox' class='form-check-input table-checked chk' name="chk[]" value="<?php echo $row['b_id'] ?>" checked></td>
                                    <td>BK<?php echo $row['b_id'] ?></td>
                                    <td><?php echo $row['sID'] ?></td>
                                    <td><?php echo  date('d/m/Y', strtotime($row['start'])) ?></td>
                                    <td><?php echo  date('d/m/Y', strtotime($row['end'])) ?></td>
                                    <td><?php echo $row['b_fname'] . ' ' . $row['b_lname'] ?></td>
                                    <td><?php echo number_format($row['sRent']) . ' ' . $row['sPayRange'] ?></td>
                                    <td><?php echo number_format($rentbill) ?></td>
                                    <td><i><?php echo $ps ?></i></td>
                                    <td>
                                        <?php
                                        $curr_date = date("Y-m-d");
                                        if ($row['start'] >  $curr_date) {
                                            echo '<div class="p-1 rounded text-center bg-secondary text-light">ยังไม่เริ่ม</div>';
                                        } else {
                                            if ($row['end'] <  $curr_date) {
                                                echo '<div class="p-1 rounded text-center bg-danger text-light">สิ้นสุดแล้ว</div>';
                                            } else {
                                                echo '<div class="p-1 rounded text-center bg-primary text-light">ดำเนินการอยู่</div>';
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php $count_n++;
                            endwhile; ?>
                        </tbody>
                        </tbody>
                    </table>
                </div>
                <h5 class="px-0">2. กรอกค่าใช้จ่ายเพิ่มเติม <span class="text-secondary fs-6">(หากไม่มีค่าใช้จ่ายเพิ่มเติม สามารถเว้นไว้ได้)</span></h5>
                <hr>
                <div class="hstack gap-2 mb-2 px-0">
                    <label style="width: 165px;">ค่าใช้จ่ายเพิ่มเติม :</label>
                    <input style="width: 165px;" id="costname" type="text" class="form-control" placeholder="เช่น ค่าไฟ ค่าน้ำ" onchange="canclick()">
                    <input style="width: 165px;" id="price" type="number" class="form-control" placeholder="จำนวนเงิน" onchange="canclick()">
                    <select class="form-select" id="unit" style="width: 155px;" onchange="checkunit()">
                        <option value="1">เหมาจ่าย</option>
                        <option value="2">บาท/หน่วย</option>
                    </select>
                    <button id="addcost" type="button" class="btn btn-primary" disabled> เพิ่ม</button>
                    <label id="lebelunit" class="text-danger" style="display: none;">เนื่องจากเป็นรายการที่ราคาแตกต่างกันในแต่ละแผงค้า <br>คุณสามารถกรอกข้อมูลแต่ละแผงค้าได้ในขั้นตอนถัดไป</label>
                </div>
                <div id="cost" class="px-0">

                </div>
                <input type="button" name="next" class=" btn btn-primary action-button" value="ถัดไป" onclick="GetSelected();nextbtn();" id="next">
            </div>
            <!-- form--2 -->
            <div id="stepTwo" class="row border shadow-sm p-3 mt-3 mb-3 rounded">

                <h4 class="p-0"><span class="text-secondary"> ขั้นที่ 2</span> ตรวจสอบและแก้ไขข้อมูล</h4>
                <div class="progress p-0 my-2 mb-3">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">2/2 </div>
                </div>
                <form action="" class="was-validated">
                    <div class="hstack gap-2">
                        <div style="width: 165px;">วันที่สร้าง :</div>
                        <input type="date" class="form-control" name="" id="createdate" value="<?php echo date("Y-m-d") ?>" style="width: 165px;margin:5px 0 !important;" required>
                    </div>
                    <div class="hstack gap-2 mb-3">
                        <div style="width: 165px;">วันครบกำหนดชำระ :</div>
                        <input type="date" class="form-control" name="" id="exp" min="<?php echo date("Y-m-d") ?>" value="<?php echo date('Y-m-d', strtotime(date("Y-m-d"). ' + 10 days')) ?>" style="width: 165px;margin:5px 0 !important;" required>
                    </div>
                    <div class="d-flex mb-3">
                        <div style="width: 165px;">ค่าใช้จ่ายเพิ่มเติม :</div>
                        <div id="costlist" class="px-0">
                        </div>
                    </div>
                    <hr>
                    <div id="parsed_csv_list" class="border rounded p-3">
                    </div>
                </form>
                <input type="button" name="previous" class="btn btn-primary action-button" value="ย้อนกลับ" onclick="previousbtn()" id="back">
                <input type="submit" name="submit-apply" class="btn btn-success submitBtn" id="submit" value="ยืนยันการส่งคำร้อง" disabled>
            </div>
        </div>
    </div>
    <script src="../backend/script.js"></script>

</body>
<script type="text/javascript">
    function GetSelected() {
        //Reference the Table.
        var grid = document.getElementById("myTable");
        var numcost = document.getElementById("cost").getElementsByClassName('costtag').length + 1;

        //Reference the CheckBoxes in Table.
        var checkBoxes = grid.getElementsByTagName("INPUT");

        var costinfo = '<div class="px-3">';
        if (document.getElementById("cost").getElementsByClassName('costtag').length == 0) {
            costinfo += '<div class="text-center">ไม่พบข้อมูลค่าใช้จ่ายเพิ่มเติม</div>';
        } else {
            for (var i = 1; i < numcost; i++) {
                var costname = document.getElementById("cost" + i).innerHTML;
                var price = document.getElementById("price" + i).innerHTML;
                var unit = document.getElementById("unit" + i).innerHTML;
                costinfo += '<div class="hstack gap-2">';
                costinfo += '<div id="" style="width: 165px;">';
                costinfo += costname;
                costinfo += '</div>';
                costinfo += '<div id="" style="width: 85px;">';
                costinfo += price;
                costinfo += '</div><div style="width: 80px;"> บาท </div>';
                costinfo += '<div id="" style="width: 85px;">';
                costinfo += unit;
                costinfo += '</div>';
                costinfo += '</div>';

            }
        }
        costinfo += "</div>";
        // costinfo += "<hr>";

        var table = "<table id='example' class='table display' style='width: 100%;'>";
        var header = "<thead><tr>";
        header += "<th>รหัสการจอง</th>";
        header += "<th>รหัสแผงค้า</th>";
        header += "<th>วันที่เริ่มจอง</th>";
        header += "<th>วันที่สิ้นสุด</th>";
        header += "<th>ค่าเช่าแผง</th>";
        header += "<th>รอบบิลปัจุบัน (บาท)</th>";
        header += "<th>หมายเหตุ</th>";

        for (var i = 1; i < numcost; i++) {
            var cosnameold = document.getElementById("cost" + i).innerHTML;
            var cosname = cosnameold.replace(/-/g, '');
            var unit = document.getElementById("unit" + i).innerHTML;
            header += "<th>";
            header += cosname;
            header += "(บาท)";
            header += "</th>";
        }
        header += "</tr></thead>";
        table += header;
        table += "<tbody>";

        // //Loop through the CheckBoxes.
        for (var i = 1; i < checkBoxes.length; i++) {
            if (checkBoxes[i].checked) {
                var row = checkBoxes[i].parentNode.parentNode;
                var rentcomma = row.cells[7].innerHTML;
                var rent = rentcomma.replace(/,/g, '');
                table += "<tr>";
                table += "<td>";
                table += row.cells[1].innerHTML;
                table += "</td>";
                table += "<td>";
                table += row.cells[2].innerHTML;
                table += "</td>";
                table += "<td>";
                table += row.cells[3].innerHTML;
                table += "</td>";
                table += "<td>";
                table += row.cells[4].innerHTML;
                table += "</td>";
                table += "<td>";
                table += row.cells[6].innerHTML;
                table += "</td>";
                table += "<td>";
                table += '<input type="number" name="" id="" class="form-control" value="' + rent + '" required>';
                table += "</td>";
                table += "<td>";
                table += row.cells[8].innerHTML;
                table += "</td>";
                for (var x = 1; x < numcost; x++) {
                    var unit = document.getElementById("unit" + x).innerHTML;
                    if (unit == "(เหมาจ่าย)") {
                        var pricewithcomma = document.getElementById("price" + x).innerHTML;
                        var price = pricewithcomma.replace(/,/g, '');
                    } else {
                        price = "";
                    }

                    table += "<td>";
                    table += '<input type="number" name="" id="" class="form-control" value="' + price + '" required/>';
                    table += "</td>";
                }
                table += "</tr>";
            }
        }
        table += "</tbody>";
        table += "</table>";
        $("#costlist").html(costinfo);
        $("#parsed_csv_list").html(table);
        $(document).ready(function() {
            $("#example").DataTable({
                scrollCollapse: true,
                paging: true,
                lengthChange: false,
                "language": {
                    "search": "ค้นหา :",
                    "zeroRecords": "ไม่พบข้อมูลที่ค้นหา",
                    "info": "แสดงผลลัพธ์ _PAGE_ จาก _PAGES_ หน้า",
                    "infoEmpty": "ไม่พบตารางที่ค้นหา",
                    "infoFiltered": "(ค้นหาจากทั้งหมด _MAX_ ตาราง)",
                    "paginate": {
                        "previous": "ก่อนหน้า",
                        "next": "หน้าถัดไป",

                    }
                },
                "bDestroy": true
            });

        });
    }

    const buttons = document.getElementsByTagName("button");
    const buttonPressed = e => {
        var btnid = e.target.id;
        document.getElementById("parent" + btnid).remove();
    }

    function canclick() {
        var cost = document.getElementById("costname").value;
        var price = document.getElementById("price").value;

        if (cost != "" && price != "") {
            document.getElementById("addcost").disabled = false;
        } else {
            document.getElementById("addcost").disabled = true;
        }
    }

    function toggle(source) {
        checkboxes = document.getElementsByClassName('chk');
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    function checkunit() {
        var u = document.getElementById("unit").value;
        if (u == "2") {
            document.getElementById("lebelunit").style.display = "block";
        } else {
            document.getElementById("lebelunit").style.display = "none";
        }

    }
    document.getElementById("addcost").onclick = function() {

        var number = document.getElementById("cost").getElementsByClassName('costtag').length + 1;
        var numberOfChildren;
        if (number > 1) {
            var lastChild = document.getElementById("cost").lastChild.id;
            var lastChildID = lastChild.replace(/\D/g, '');
            numberOfChildren = parseInt(lastChildID) + 1;
        } else {
            numberOfChildren = 1;
        }

        var cost = document.getElementById("costname").value;
        var pricing = document.getElementById("price").value;
        var price = pricing.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        var unitinput = document.getElementById("unit").value;
        var unit;
        if (unitinput == "1") {
            unit = "เหมาจ่าย";
        } else {
            unit = "บาท/หน่วย";
        }
        var textcost = document.createTextNode("- " + cost + " ");
        var textprice = document.createTextNode(price);
        var textbath = document.createTextNode(" บาท ");
        var textunit = document.createTextNode("(" + unit + ")");
        var btntextnode = document.createTextNode("ลบ");

        let parent = document.createElement("div");
        var elm0 = document.createElement("div");
        var elm1 = document.createElement("div");
        var elm2 = document.createElement("div");
        var elm3 = document.createElement("div");
        var elm4 = document.createElement("div");
        var btn = document.createElement("button");

        elm0.style.width = "165px";
        elm1.style.width = "165px";
        elm2.style.width = "85px";
        elm3.style.width = "80px";
        elm4.style.width = "85px";

        elm1.appendChild(textcost);
        elm2.appendChild(textprice);
        elm3.appendChild(textbath);
        elm4.appendChild(textunit);
        btn.appendChild(btntextnode);

        btn.classList.add("text-danger");
        btn.classList.add("btn");
        btn.classList.add("btn-link");
        btn.classList.add("p-0");
        parent.id = "parent" + numberOfChildren;
        elm1.id = "cost" + numberOfChildren;
        elm2.id = "price" + numberOfChildren;
        elm4.id = "unit" + numberOfChildren;
        btn.id = numberOfChildren;
        btn.addEventListener("click", buttonPressed);
        parent.classList.add("costtag");
        parent.classList.add("hstack");
        parent.classList.add("gap-2");
        parent.classList.add("mb-2");
        parent.appendChild(elm0);
        parent.appendChild(elm1);
        parent.appendChild(elm2);
        parent.appendChild(elm3);
        parent.appendChild(elm4);
        parent.appendChild(btn);

        document.getElementById("cost").appendChild(parent);
        document.getElementById("costname").value = "";
        price = document.getElementById("price").value = "";
        document.getElementById("unit").selectedIndex = 0;
        document.getElementById("lebelunit").style.display = "none";
        document.getElementById("addcost").disabled = true;

    };

    mobiscroll.datepicker('#range', {
        select: 'range',
        startInput: '#start',
        endInput: '#end'
    });

    $(document).ready(function() {
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = $('#min').datepicker("getDate");
                var max = $('#max').datepicker("getDate");
                var dateString = data[2];
                var dateParts = dateString.split('/');
                var startDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);

                var enddateString = data[3];
                var enddateParts = enddateString.split('/');
                var endDate = new Date(enddateParts[2], enddateParts[1] - 1, enddateParts[0]);

                if (min == null && max == null) {
                    return true;
                }
                if (min == null && startDate <= max) {
                    return true;
                }
                if (max == null && startDate >= min) {
                    return true;
                }
                if (!(startDate > max || endDate < min)) {
                    return true;
                }
                return false;
            }
        );


        $("#min").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd/mm/yy'
        });
        $("#max").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd/mm/yy'
        });
        var table = $('#myTable').DataTable();

        $('#min, #max').change(function() {
            table.draw();
        });
    });
</script>

</html>