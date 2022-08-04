<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขแผนผังตลาด</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/market-plan.css" type="text/css">
    
    <?php
    include "profilebar.php";
    include "nav.php";
    include "../backend/connectDB.php";
    include "../backend/import-link.php";
    ?>

</head>
<script>
    $(document).ready(function() {
        var x; // To store cloned div

        $(".div_1").draggable({
            helper: "clone",
            cursor: "move",
            revert: true
        });

      
        $(".plan").droppable({
            drop: function(event, ui) {
                x = ui.helper.clone(); // Store cloned div in x
                ui.helper.remove(); // Escape from revert the original div
                x.appendTo('.plan'); // To append the reverted image
                x.draggable({
                    cursor: "move",
                    revert: true,
                    containment: "parent"
                });
            }
        });

    });
    $(document).ready(function(){
        $( ".plan" ).resizable({
      animate: true
    });
    })
</script>

<body>
    <h1>แก้ไขแผนผังตลาด</h1>

    <div class="mrkplan">
        ลากเพื่อเพิ่ม:
        <div class="div_1 ui-widget-content resizablePiP">
        </div>
        <select class="mrk-zone" name="mrk-zone" id="mrkplan">
            <option value="โซน/ชั้น">โซน/ชั้น</option>
            <option value=""></option>
        </select>
        <select name="mrk-price" id="mrkplan">
            <option value="ช่วงราคาที่สนใจ">ช่วงราคาที่สนใจ</option>
            <option value=""></option>
        </select>

    </div>

    <div class="plan"> </div>



</body>


</html>