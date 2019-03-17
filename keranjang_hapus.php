<?php 

session_start();                    // Memulai session
include 'config.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include "faktur.php"; 



 

$cek		= "SELECT * FROM tb_order WHERE id_customer = '$sesen_id_customer' AND status ='0'";
$hasil 	= mysqli_query($conn,$cek);
$data 	= mysqli_fetch_array($hasil);

if(mysqli_num_rows($hasil) == 0)
{
	echo "<script>alert('Data tidak ditemukan');location.replace('keranjang.php')</script>";
}
else
{
	$faktur 		= $data['id_order'];
	$id_detail_order 	= $_GET['id_detail_order'];
	$cari_order  = "SELECT * FROM detail_order WHERE id_detail_order = '$id_detail_order'";
    $hasil_order = mysqli_query($conn, $cari_order);
    $data_order  = mysqli_fetch_array($hasil_order);
                
                $jumlah = $data_order['jumlah'];
				$id_barang = $data_order['id_barang'];
				$ukuran = $data_order['ukuran'];

				$cari_stok  = "SELECT * FROM tb_stok WHERE id_barang = '$id_barang' AND ukuran = '$ukuran' ";
                $hasil_stok = mysqli_query($conn, $cari_stok);
                $data_stok  = mysqli_fetch_array($hasil_stok);
                
                $stok = $data_stok['stok'];
				$stokbaru = $stok + $jumlah;

				$query = "UPDATE tb_stok SET stok = '$stokbaru'
                WHERE id_barang = '$id_barang' AND ukuran='$ukuran' ";
				
	
	
	if(mysqli_query($conn, $query)) 
  {
	$query1 = "DELETE FROM detail_order WHERE id_order = '$faktur' AND id_detail_order = '$id_detail_order' ";
	if(mysqli_query($conn, $query1)) 
  	{	
		  echo "<script>alert('Barang berhasil dihapus');location.replace('keranjang.php')</script>";
	  }  
		  else
		  {
			  echo "Error updating record: " . mysqli_error($conn);
		  }
  	
  }  
  	else
  	{
  		echo "Error updating record: " . mysqli_error($conn);
  	}
}
?>