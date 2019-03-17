<?php
$sql = "SELECT * FROM supersubkat";
$data = mysqli_query($conn, $sql);
$supersubkat = mysqli_num_rows($data);
?>