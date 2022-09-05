<?php 
    $conn = new mysqli("localhost", "root", "", "marketrental");
    if($conn->connect_errno){
        echo "<script>dberror()</script>";
        exit();
    }
?>
