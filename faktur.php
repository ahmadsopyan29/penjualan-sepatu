<?php 
include "fungsi/cek_session_public.php"; 
include "fungsi/cek_login_public.php"; 

$cari  = "SELECT * FROM tb_order WHERE id_customer = '$sesen_id_customer' AND status = 0 ORDER BY id_order DESC";
$query = mysqli_query($conn,$cari);
$hasil = mysqli_fetch_array($query);

if($hasil > 0)
{
	$faktur = $hasil['id_order'];
}
	else
	{
		$query 	= "INSERT INTO tb_order (id_customer,tanggal,status) VALUES ('$sesen_id_customer',now(),'0')";
		$result = mysqli_query($conn,$query);

		$cari 	= "SELECT * FROM tb_order ORDER BY id_order DESC";
		$query 	= mysqli_query($conn,$cari);
		$hasil 	= mysqli_fetch_array($query);
		
		if ($hasil > 0)
		{
			$faktur = $hasil['id_order'];
		}
}
?>