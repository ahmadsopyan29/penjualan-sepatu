<?php 
include "fungsi/cek_session_public.php"; 
include "fungsi/cek_login_public.php"; 

$cari  = "SELECT * FROM order WHERE id_customer = '$sesen_id_customer' AND status = '0' ";
$query = mysqli_query($conn,$cari);
$hasil = mysqli_fetch_array($query);

if($hasil > 0)
{
	$faktur = $hasil['id_order'];
}
	else
	{
		$query 	= "INSERT INTO order (tanggal,id_customer,status) VALUES (now(),'$sesen_id_customer','0')";
		$result = mysqli_query($conn,$query);

		$cari 	= "SELECT * FROM order ORDER BY id_order DESC";
		$query 	= mysqli_query($conn,$cari);
		$hasil 	= mysqli_fetch_array($query);
		
		if ($hasil > 0)
		{
			$faktur = $hasil['id_order'];
		}
}
?>