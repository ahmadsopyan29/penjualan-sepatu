<?php 
include "fungsi/cek_session_public.php"; 
include "fungsi/cek_login_public.php"; 

$cari  = "SELECT * FROM tb_return WHERE id_customer = '$sesen_id_customer' AND status = 0 ORDER BY id_return DESC";
$query = mysqli_query($conn,$cari);
$hasil = mysqli_fetch_array($query);

if($hasil > 0)
{
	$faktur = $hasil['id_return'];
}
	else
	{
		$query 	= "INSERT INTO tb_return (id_customer,tanggal,status) VALUES ('$sesen_id_customer',now(),'0')";
		$result = mysqli_query($conn,$query);

		$cari 	= "SELECT * FROM tb_return ORDER BY id_return DESC";
		$query 	= mysqli_query($conn,$cari);
		$hasil 	= mysqli_fetch_array($query);
		
		if ($hasil > 0)
		{
			$faktur = $hasil['id_return'];
		}
}
?>