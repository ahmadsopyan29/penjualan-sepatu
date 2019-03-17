<?php
$sql 	= "SELECT * FROM testimoni WHERE status = '1' ";
$data 	= mysqli_query($conn, $sql);
$testiacc 	= mysqli_num_rows($data);
?>