<?php
$sql 	= "SELECT * FROM subkat";
$data 	= mysqli_query($conn, $sql);
$subkat = mysqli_num_rows($data);
?>