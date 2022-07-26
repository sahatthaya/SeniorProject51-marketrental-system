<?php
session_start();
session_destroy();
echo "<script>alert('ออกจากระบบสำเร็จ'); window.location = '../index.php';</script>";
?>