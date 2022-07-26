<?php
include "profilebar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ติดต่อเรา</title>
    <!-- css  -->
    <link rel="stylesheet" href="../css/contact.css" type="text/css">
</head>
<?php
include "nav.php";
include "../backend/connectDB.php";
require "../backend/qry-contact.php";
include "../backend/import-link.php";

?>

<body>

    <h1>ติดต่อเรา</h1>

    <div class="logo_img center">
        <img src="../<?php echo $row["ct_logo"] ?>" alt="logo_marketremtal" class="img-fluid">
    </div>
    <div class="boxcard">
        <div class=" cardcontact" id="ct1">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="../<?php echo $row["ct1_pic"] ?>" class="img-fluid rounded-start ctimg">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h2 class="center"><?php echo $row["ct1_fname"] . " " . $row["ct1_lname"] ?></h2>
                        <p class="center"><?php echo $row["ct1_email"] ?>
  
                        </p>
                        <p class="center"> <?php echo $row["ct1_tel"] ?></p>


                    </div>
                </div>
            </div>
        </div>

        <div class=" cardcontact" id="ct2">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="../<?php echo $row["ct2_pic"] ?>" class="img-fluid rounded-start ctimg">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h2 class="center"><?php echo $row["ct2_fname"] . " " . $row["ct2_lname"] ?></h2>
                        <p class="center"><?php echo $row["ct2_email"] ?>
                        </p>
                        <p class="center"><?php echo $row["ct2_tel"] ?></p>


                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>