<?php
include "../config.php";

$sql = "SELECT * FROM bseller";
$data = mysqli_query($conn, $sql);
$bseller = mysqli_num_rows($data);
?>