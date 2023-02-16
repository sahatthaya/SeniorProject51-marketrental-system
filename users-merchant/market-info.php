<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> MarketRental - ข้อมูลตลาด</title>

    <!-- css  -->

    <link rel="stylesheet" href="../css/market-info.css">

</head>

<?php

include "profilebar.php";

include "nav.php";

include "../backend/1-connectDB.php";

require "../backend/qry-market-info.php"

?>



<body>

    <nav aria-label="breadcrumb mb-3">

        <ol class="breadcrumb ">

            <li class="breadcrumb-item fs-5 "><a href="all-market.php?mkr_id=<?php echo $row['mkr_id'] ?>" class="text-decoration-none">ตลาดทั้งหมด</a></li>

            <li class="breadcrumb-item active fs-5" aria-current="page"><?php echo $row['mkr_name'] ?></li>

        </ol>

    </nav>

    <div class="mkrpic center">

        <img src="../<?php echo $row['mkr_pic'] ?>" class="img-fluid img-thumbnail shadow-sm rounded-4" alt="...">

    </div>

    <div class="mrk_info border rounded shadow-sm">

        <p id="mkr_name"><?php echo $row['mkr_name']; ?> <span class="fs-5">(<?php echo $row['opening'] ?>)</span></p>

        <h5>รายละเอียด</h5>
       
        <p class="text_desc">

            <?php echo $row['mkr_descrip']; ?>

        </p>

        <h5>ข้อมูลติดต่อ</h5>

        <p class="text_desc">

            เบอร์โทร : <?php echo $row['tel']; ?>

            <br>

            อีเมล : <a href="mailto:<?php echo $row['email'] ?>">

                <?php echo $row['email']; ?>

            </a>

            <br>

            ที่อยู่ : <?php echo $row['house_no']; ?> ซอย <?php echo $row['soi']; ?> หมู่ <?php echo $row['moo']; ?> ถนน <?php echo $row['road']; ?> ตำบล/แขวง <?php echo $row['district_name']; ?> อำเภอ/เขต <?php echo $row['amphure_name']; ?> จังหวัด <?php echo $row['province_name']; ?> รหัสไปรษณีย์ <?php echo $row['postalcode']; ?>



        </p>



    </div>



    <div id="quick-menu2" class="guide">

        <a type="button" class="quick-menu2 rounded shadow-sm" id="merchant-btn" href="<?php echo $pathbook ?>?mkr_id=<?php echo $row['mkr_id']; ?>">

            <i class='bx bx-calendar-edit text-light'></i>

            <p> สนใจเช่าจองพื้นที่ </p>

        </a>

        <a type="button" class="quick-menu2 rounded shadow-sm" href="complain.php?mkr_id=<?php echo $row['mkr_id']; ?>">

            <i class='bx bxs-megaphone'></i>

            <p> การร้องเรียน </p>

        </a>

    </div>

    <?php echo $opening_period ?>

    <div class="mrk_news border rounded shadow-sm">

        <h5>ข่าวสารตลาด</h5>

        <hr>

        <ul class="list-group list-group-flush">
            <?php
            if (mysqli_num_rows($result3) == 0) { ?>
                <li class="list-group-item">
                    <i class="text-secondary">ไม่มีข่าวสารสำหรับตลาด<?php echo $row['mkr_name']; ?>ในขณะนี้</i>
                </li>
                <?php
            } else {
                while ($row1 = $result3->fetch_assoc()) : ?>
                    <li class="list-group-item">
                        <a class="hstack gap-3 text-decoration-none modal_data1" id="<?php echo $row1['n_id']; ?>">
                            <p><?php echo date("d/m/Y", strtotime($row1['timestamp'])) ?></p>
                            <p><?php echo $row1['n_sub']; ?></p>
                        </a>
                    </li>
            <?php
                endwhile;
            } ?>
        </ul>

    </div>

    <?php require '../backend/modal-news.php' ?>



</body>

<script>
    //detail popup

    $(document).ready(function() {

        $("body").on("click", ".modal_data1", function(event) {

            var newsid = $(this).attr("id");

            $.ajax({

                url: "../backend/news.php",

                method: "POST",

                data: {

                    newsid: newsid

                },

                success: function(data) {

                    $('#bannerdetail').html(data);

                    $('#bannerdataModal').modal('show');

                }

            });



        })

    });



    // datepicker
    var now = new Date();
    var colorset = [
        '#abdee6',
        '#cbaacb',
        '#ffffb5',
        '#ffccb6',
        '#f3b0c3',
        '#c6dbda',
        '#fee1e8',
        '#fed7c3',
        '#f6eac2',
        '#ecd5e3',

    ];
    mobiscroll.datepicker('#demo-colored', {
        dataTimezone: 'utc',
        displayTimezone: 'Asia/Bangkok',
        controls: ['calendar'],
        display: 'inline',
        showOuterDays: false,
        colors: [
            <?php
            $countcolor = 0;
            while ($q = $qrycalendar->fetch_assoc()) :
                $sdate = str_replace('-', ',', $q['start']);
                $sa = explode(',', $sdate);
                $sm = $sa[1] - 1;
                $startr = $sa[0] . "," . $sm . "," . $sa[2];

                $edate = str_replace('-', ',', $q['end']);
                $ea = explode(',', $edate);
                $em = $ea[1] - 1;
                $endr = $ea[0] . "," . $em . "," . $ea[2];
            ?> {
                    start: new Date(<?php echo $startr; ?>),
                    end: new Date(<?php echo $endr ?>),
                    background: colorset[<?php echo $countcolor; ?>]
                },
            <?php
                $countcolor++;
                if ($countcolor > 10) {
                    $countcolor = 0;
                }
            endwhile ?>
        ]
    });
</script>



</html>