<?php 
if(isset($_SESSION['id_customer']))
{
	$id_customer = $_SESSION['id_customer'];

	$cari 	= "SELECT * FROM tb_order WHERE id_customer = '$id_customer' AND status = 1 ORDER BY id_order DESC";
	$query 	= mysqli_query($conn,$cari);
	$hasil 	= mysqli_fetch_array($query);
	if($hasil > 0)
	{
		$faktur = $hasil['id_order'];
	}
}
?>