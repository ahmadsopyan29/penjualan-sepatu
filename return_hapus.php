<?php 

session_start();                    // Memulai session
include 'config.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include "faktur_return.php"; 



 

$cek		= "SELECT * FROM tb_return WHERE id_customer = '$sesen_id_customer' AND status ='0'";
$hasil 	= mysqli_query($conn,$cek);
$data 	= mysqli_fetch_array($hasil);

if(mysqli_num_rows($hasil) == 0)
{
	echo "<script>alert('Data tidak ditemukan');location.replace('return.php')</script>";
}
else
{
	$faktur 		= $data['id_return'];
	$id_detail_return 	= $_GET['id_detail_return'];
	$cari_return  = "SELECT * FROM detail_return WHERE id_detail_return = '$id_detail_return'";
    $hasil_return = mysqli_query($conn, $cari_return);
    $data_return  = mysqli_fetch_array($hasil_return);
                
				
	
	
	
	$query1 = "DELETE FROM detail_return WHERE id_return = '$faktur' AND id_detail_return = '$id_detail_return' ";
	if(mysqli_query($conn, $query1)) 
  	{	
		  echo "<script>alert('Barang berhasil dihapus');location.replace('return.php')</script>";
	  }  
		  else
		  {
			  echo "Error updating record: " . mysqli_error($conn);
		  }
  	
  
}
?>