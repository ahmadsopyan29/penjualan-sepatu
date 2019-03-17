<?php
$sql = "SELECT * FROM tb_user";
$data = mysqli_query($conn, $sql);
$user = mysqli_num_rows($data);
?>