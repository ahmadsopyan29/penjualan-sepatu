<?php
if(isset($_SESSION['level']))
{
	$sesen_id_user	= $_SESSION['id_user'];
	$sesen_nama_lengkap 		= $_SESSION['nama_lengkap'];
	$sesen_username = $_SESSION['username'];
	$sesen_level = $_SESSION['level'];
	$sesen_alamat	= $_SESSION['alamat'];
	$sesen_telepon	= $_SESSION['telepon'];
	$sesen_email	= $_SESSION['email'];
}
else{
	die("<script>alert('Anda tidak memiliki akses!');history.go(-1)</script>");
}
?>
