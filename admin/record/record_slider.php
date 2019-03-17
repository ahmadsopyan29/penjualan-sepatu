<?php
$sql 	= "SELECT * FROM slider";
$data 	= mysqli_query($conn, $sql);
$slider = mysqli_num_rows($data);
?>