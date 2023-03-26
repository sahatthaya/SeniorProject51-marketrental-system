<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
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

require "../backend/invoice.php";
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

    <div class="form-outer-lg ms-2 me-2">

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

                        <label style="width: 165px;"><span class="text-decoration-underline">เลือก</span> การเช่าในวันที่</label>

                        <input name="min" id="min" class="form-control" type="text" style="width: 165px;" value="<?php echo '01/' . date('m/Y') ?>">

                        <label> ถึง </label>

                        <input name="max" id="max" class="form-control" type="text" style="width: 165px;" value="<?php echo date('t/m/Y') ?>">

                    </div>

                </div>

                <div class=" mb-3 border p-3">

                    <table id="myTable" class="display table table-striped dt-responsive px-0" style="width: 100%;">

                        <thead>

                            <tr>

                                <th style=" width:4%;" class="text-center"> <input type="checkbox" id="checkall" onClick="toggle(this)" class='form-check-input table-checked' checked /></th>

                                <th scope="col">รหัสการจอง</th>

                                <th scope="col">แผงค้า</th>

                                <th scope="col">ผู้จอง</th>

                                <th scope="col">วันที่เริ่มเช่า</th>

                                <th scope="col">วันที่สิ้นสุด</th>

                                <!-- <th scope="col">จำนวนวันที่เช่าในเดือนนี้</th> -->

                                <th scope="col">ค่าเช่าแผง</th>

                                <!-- <th scope="col">ค่าเช่าในเดือนนี้</th>

                                <th scope="col">หมายเหตุ</th> -->


                            </tr>

                        </thead>

                        <tbody id="tbo">

                            <?php while ($row = $query->fetch_assoc()) :

                                $b_id = $row['b_id'];

                                $qryinv = mysqli_query($conn, "SELECT * FROM `invoice` WHERE `b_id`= $b_id ORDER BY `INV_created`DESC LIMIT 1");

                                $numRowinv = mysqli_num_rows($qryinv);

                                // เช็คบิลแรก
                                if ($numRowinv == 0) {
                                    $dept = $row['sDept'];
                                } else {
                                    $dept = 0;
                                }

                            ?>

                                <tr>

                                    <td class='text-center'><input type='checkbox' class='form-check-input table-checked chk' name="chk[]" value="<?php echo $row['b_id'] ?>" checked></td>

                                    <td id="<?php echo $dept ?>"><?php echo $row['b_id'] ?></td>

                                    <td><?php echo $row['sID'] ?></td>

                                    <td id="<?php echo $row['users_id'] ?>"><?php echo $row['b_fname'] . ' ' . $row['b_lname'] ?></td>

                                    <td><?php echo  date('d/m/Y', strtotime($row['b_start'])) ?></td>

                                    <td><?php echo  date('d/m/Y', strtotime($row['b_end'])) ?></td>

                                    <td><?php echo number_format($row['sRent']) . ' ' . $row['sPayRange'] ?></td>


                                </tr>

                            <?php $count_n++;

                            endwhile; ?>

                        </tbody>

                        </tbody>

                    </table>

                </div>

                <h5 class="px-0">2. กรอกค่าใช้จ่ายเพิ่มเติม <span class="text-secondary fs-6">(หากไม่มีค่าใช้จ่ายเพิ่มเติม สามารถเว้นไว้ได้)</span></h5>

                <hr>

                <div class="hstack cost gap-2 mb-2 px-0">

                    <label class="cost">ค่าใช้จ่ายเพิ่มเติม :</label>

                    <input id="costname" type="text" class="form-control cost" placeholder="เช่น ค่าไฟ ค่าน้ำ" onchange="canclick()">

                    <input id="price" type="number" class="form-control cost" placeholder="จำนวนเงิน" onchange="canclick()">

                    <select class="form-select cost-formselect" id="unit" style="width: 155px;" onchange="checkunit()">

                        <option value="1">เหมาจ่าย</option>

                        <option value="2">บาท/หน่วย</option>

                    </select>

                    <but ton id="addcost" type="button" class="btn btn-primary cost-btn" disabled> เพิ่ม</but>

                    <label id="lebelunit" class="text-danger" style="display: none;">เนื่องจากเป็นรายการที่ราคาแตกต่างกันในแต่ละแผงค้า <br>คุณสามารถกรอกข้อมูลแต่ละแผงค้าได้ในขั้นตอนถัดไป</label>

                </div>

                <div id="cost" class="px-0">



                </div>

                <input id="checkBtn" type="button" name="next" class=" btn btn-primary action-button" value="ถัดไป" onclick="" id="next">

            </div>

            <!-- form--2 -->

            <form method="post" class="was-validated">

                <div id="stepTwo" class="row border shadow-sm p-3 mt-3 mb-3 rounded">

                    <input type="text" class="form-control" name="mkr_id" id="createdate" value="<?php echo $mkr_id ?>" style="width: 165px;margin:5px 0 !important;" hidden required>



                    <h4 class="p-0"><span class="text-secondary"> ขั้นที่ 2</span> ตรวจสอบและแก้ไขข้อมูล</h4>

                    <div class="progress p-0 my-2 mb-3">

                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-label="Basic example" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">2/2 </div>

                    </div>

                    <div class="hstack gap-2">

                        <div style="width: 165px;">วันที่สร้าง :</div>

                        <input type="date" class="form-control" name="INV_created" id="createdate" value="<?php echo date("Y-m-d") ?>" style="width: 165px;margin:5px 0 !important;" required disabled>

                    </div>

                    <div class="hstack gap-2 mb-3">

                        <div style="width: 165px;">วันครบกำหนดชำระ :</div>

                        <input type="date" class="form-control" name="INV_expired" id="exp" min="<?php echo date("Y-m-d") ?>" value="<?php echo date('Y-m-d', strtotime(date("Y-m-d") . ' + 10 days')) ?>" style="width: 165px;margin:5px 0 !important;" required>

                    </div>

                    <div class="d-flex mb-3">

                        <div style="width: 165px;">ค่าใช้จ่ายเพิ่มเติม :</div>

                        <div id="costlist" class="px-0">

                        </div>

                    </div>

                    <hr>

                    <div id="parsed_csv_list" class="border rounded p-3">

                    </div>

                    <input type="button" name="previous" class="btn btn-primary action-button" value="ย้อนกลับ" onclick="previousbtn()" id="back">

                    <button type="submit" name="submit-inv" class="btn btn-success submitBtn" id="submit">สร้างและส่งใบแจ้งค่าเช่า</button>

                </div>

            </form>

        </div>

    </div>

    <script src="../backend/script.js"></script>

</body>



</html>

<script type="text/javascript">
    // date diff
    function dateDiffInDays(date1, date2) {
        const oneDay = 24 * 60 * 60 * 1000; // milliseconds in a day
        const diffInMilliseconds = Math.abs(date2.getTime() - date1.getTime());
        return Math.floor(diffInMilliseconds / oneDay);
    }
    // convert dd/mm/yyyy to yyyy-mm-dd
    function convertDateFormat(dateString) {
        const parts = dateString.split("/");
        const day = parts[0];
        const month = parts[1];
        const year = parts[2];
        const convertedDate = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
        return convertedDate;
    }
    // ต้องเลือกแงค้าเพื่อกดถัดไป
    $(document).ready(function() {
        $('#checkBtn').click(function() {
            let grid = document.getElementById("myTable");
            let checkBoxes = grid.getElementsByTagName("INPUT");

            let checked = 0;

            for (var i = 1; i < checkBoxes.length; i++) {

                if (checkBoxes[i].checked) {
                    checked += 1;
                }
            }
            if (checked == '0') {
                Swal.fire({

                    title: 'กรุณาเลือกแผงค้า',

                    icon: 'warning',

                    text: 'กรุณาเลือกแผงค้าที่ต้องการสร้างใบเรียกเก็บค่าเช่า',

                    showConfirmButton: false,

                    timer: 3000

                });
            } else {
                GetSelected();
                nextbtn();

            }

        });
    });

    // สร้างตารางใหม่
    function GetSelected() {

        let grid = document.getElementById("myTable");

        let numcost = document.getElementById("cost").getElementsByClassName('costtag').length + 1;

        let checkBoxes = grid.getElementsByTagName("INPUT");

        let datemin = document.getElementById("min").value;
        let datemax = document.getElementById("max").value;

        // label ค่าใช้จ่าย

        let numcostcal = numcost - 1;

        let costinfo = '<div class="px-3">';

        costinfo += '<input type="number" name="numcost" id="" class="form-control" value="' + numcostcal + '" required hidden />';

        if (document.getElementById("cost").getElementsByClassName('costtag').length == 0) {

            costinfo += '<div class="text-center">ไม่พบข้อมูลค่าใช้จ่ายเพิ่มเติม</div>';

        } else {

            for (var i = 1; i < numcost; i++) {

                var costname = document.getElementById("cost" + i).innerHTML;

                var price = document.getElementById("price" + i).innerHTML;

                var unit = document.getElementById("unit" + i).innerHTML;

                costinfo += '<input type="text" name="costname' + i + '" id="" class="form-control" value="' + costname.replace(/-/g, '') + '" required hidden>';

                costinfo += '<input type="text" name="price' + i + '" id="" class="form-control" value="' + price + '" required hidden>';

                costinfo += '<input type="text" name="unit' + i + '" id="" class="form-control" value="' + unit + '" required hidden>';



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


        // headerตารางค่าเช่า
        var table = "<h5>แผงค้าที่เลือกจากช่วงวันที่ " + datemin + " - " + datemax + " <span class='text-secondary fs-6'>( จำนวนวันเช่า และค่าเช่า จะคำนวนจากช่วงวันที่ได้เลือกไว้ )</span></h5>";
        table += "<table id='example' class='display table table-striped dt-responsive' style='width: 100%;'>";

        var header = "<thead><tr>";

        header += "<th>รหัสการจอง</th>";

        header += "<th>แผงค้า</th>";

        header += "<th>วันที่เริ่มเช่า</th>";

        header += "<th>วันที่สิ้นสุด</th>";

        header += "<th>ค่าเช่าแผง</th>";

        header += "<th>จำนวนวันเช่า</th>";

        header += "<th>ค่าเช่าในรอบนี้ (บาท)</th>";


        // header cost loop
        for (var i = 1; i < numcost; i++) {

            var cosnameold = document.getElementById("cost" + i).innerHTML;

            var cosname = cosnameold.replace(/-/g, '');

            var unit = document.getElementById("unit" + i).innerHTML;

            header += "<th>";

            header += cosname;

            header += "(บาท)";

            header += "</th>";

        }
        header += "<th>หมายเหตุ</th>";
        header += "</tr></thead>";

        table += header;


        // body ตารางค่าเช่า
        table += "<tbody>";

        var countr = 0;

        // checkbox loop create table
        for (var i = 1; i < checkBoxes.length; i++) {

            if (checkBoxes[i].checked) {
                var row = checkBoxes[i].parentNode.parentNode;

                // Convert the date strings into Date objects
                let startdate = new Date(row.cells[4].innerHTML.split("/").reverse().join("-"));
                let enddate = new Date(row.cells[5].innerHTML.split("/").reverse().join("-"));
                let mindate = new Date(datemin.split("/").reverse().join("-"));
                let maxdate = new Date(datemax.split("/").reverse().join("-"));
                var discount = row.cells[1].id;

                let dateString1, dateString2

                if (mindate < startdate) {
                    date1 = startdate
                } else {
                    date1 = mindate
                }

                if (enddate < maxdate) {
                    date2 = enddate
                } else {
                    date2 = maxdate
                }

                const diffInMs = date2 - date1;

                const days = Math.floor(diffInMs / (1000 * 60 * 60 * 24)) + 1;

                var rentcomma = row.cells[6].innerHTML.replace(/,/g, '');

                var rent = (parseInt(rentcomma.match(/\d+/)) * days) - discount;

                table += "<tr>";

                table += "<td>";

                table += row.cells[1].innerHTML;

                var bid = row.cells[1].innerHTML.replace(/BK/g, '');

                table += '<input type="text" name="b_id' + countr + '" id="" class="form-control" value="' + bid + '" required hidden/>';

                table += "</td>";

                table += "<td>";

                table += row.cells[2].innerHTML;
                table += '<input type="text" name="sid' + countr + '" id="" class="form-control" value="' + row.cells[2].innerHTML + '" required hidden/>';
                table += '<input type="text" name="usersb_id' + countr + '" id="" class="form-control" value="' + row.cells[3].id + '" required hidden/>';

                table += "</td>";

                table += "<td>";

                table += row.cells[4].innerHTML;

                table += "</td>";

                table += "<td>";

                table += row.cells[5].innerHTML;

                table += "</td>";

                table += "<td>";

                table += row.cells[6].innerHTML;

                table += "</td>";

                table += "<td>";

                table += days + " วัน";

                table += "</td>";

                table += "<td>";

                table += '<input type="number" name="rentprice' + countr + '" id="" class="form-control w-100" value="' + rent + '" required>';

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

                    table += '<input type="number" name="bill' + countr + 'price' + x + '" id="" class="form-control" value="' + price + '" required/>';

                    table += "</td>";

                }

                table += "<td>";
                let dc
                if (discount > 0) {

                    dc = "หักค่ามัดจำ " + discount + " บาท";

                } else {

                    dc = "-";

                }

                table += dc;
                table += '<input type="text" name="discount' + countr + '" id="" class="form-control" value="' + discount + '" hidden required >';
                table += "</td>";

                table += "</tr>";

                countr += 1;

            }

        }

        table += "</tbody>";

        table += "</table>";

        table += '<input type="number" name="numtbrow" id="" class="form-control" value="' + countr + '"  required hidden/>';



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




    // ลบค่าใช้จ่าย
    const buttonPressed = e => {

        var btnid = e.target.id;

        document.getElementById("parent" + btnid).remove();

    }


    // กรอกครบกดปุ่มได้
    function canclick() {

        var cost = document.getElementById("costname").value;

        var price = document.getElementById("price").value;



        if (cost != "" && price != "") {

            document.getElementById("addcost").disabled = false;

        } else {

            document.getElementById("addcost").disabled = true;

        }

    }


    // เลือกทั้งหมด
    function toggle(source) {

        checkboxes = document.getElementsByClassName('chk');

        for (var i = 0, n = checkboxes.length; i < n; i++) {

            checkboxes[i].checked = source.checked;

        }

    }


    // ข้อความ ** สำหรับบาท/หน่วย
    function checkunit() {

        var u = document.getElementById("unit").value;

        if (u == "2") {

            document.getElementById("lebelunit").style.display = "block";

        } else {

            document.getElementById("lebelunit").style.display = "none";

        }



    }

    // เพิ่มค่าใช้จ่าย
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


    // ค้นหาวันที่
    $(document).ready(function() {

        $.fn.dataTable.ext.search.push(

            function(settings, data, dataIndex) {

                var min = $('#min').datepicker("getDate");

                var max = $('#max').datepicker("getDate");

                var dateString = data[4];

                var dateParts = dateString.split('/');

                var startDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);



                var enddateString = data[5];

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


        window.onload = function curr_m() {
            $("#min").trigger('change');
            $("#max").trigger('change');
        }

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