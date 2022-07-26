<?php 
$sql = "SELECT * FROM contact ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
extract($row);
mysqli_close($conn);

?>