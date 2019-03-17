<?php
$sql 	= "SELECT * FROM berita";
$data 	= mysqli_query($conn, $sql);
$berita = mysqli_num_rows($data);
?>