<?php 
    $conn = new mysqli("localhost", "root", "", "marketrental");
    if($conn->connect_errno){
        echo "<script>alert('เชื่อมต่อฐานข้อมูลไม่สำเร็จ')</script>";
        exit();
    }
?>
