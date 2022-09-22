<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MarketRental - เกี่ยวกับเว็บไซต์</title>

    <!-- css  -->
    <link rel="stylesheet" href="../css/contact.css" type="text/css">
</head>
<?php
include "profilebar.php";
?>
<?php
include "nav.php";
include "../backend/1-connectDB.php";
require "../backend/qry-contact.php";
include "../backend/1-import-link.php";

?>

<body>

    <h1>เกี่ยวกับเว็บไซต์</h1>

    <div class="parent mt-3">
        <div class="logo_img">
            <img src="../<?php echo $row["ct_logo"] ?>" alt="logo_marketremtal" class="img-fluid p-3">
        </div>
        <div class="contentbox web-info">
            <figure class="text-center">
                <blockquote class="blockquote">
                    <p>“<?php echo $row["ct_webinfo"] ?></p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    <cite title="Source Title">MarketRental</cite>
                </figcaption>
            </figure>
        </div>
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
                        <p class="center">
                            <a href="mailto:<?php echo $row['ct1_email'] ?>">
                                <?php echo $row['ct1_email']; ?>
                            </a>
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
                        <p class="center">
                        <a href="mailto:<?php echo $row['ct2_email'] ?>">
                                <?php echo $row['ct2_email']; ?>
                            </a>
                        </p>
                        <p class="center"><?php echo $row["ct2_tel"] ?></p>


                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>