<?php session_start(); 										// Memulai session
include 'config.php'; 										// Memanggil koneksi ke database
include 'faktur.php'; 									// Memanggil faktur
include 'fungsi/base_url.php';  					// Memanggil fungsi base_url
include 'fungsi/cek_session_public.php'; 	// Memanggil fungsi cek_session_public
include 'fungsi/cek_login_public.php';  	// Memanggil fungsi cek_login_public

// Cek faktur pembelian berdasarkan notransaksi, username, dan status

if(isset($_POST['checkout']))
{
  
  
  
	
$cek_faktur 	= mysqli_query($conn,"SELECT tb_order.id_order,tb_order.id_customer,tb_order.status,
								detail_order.subtotal FROM detail_order
								LEFT JOIN tb_order ON tb_order.id_order = detail_order.id_order
								WHERE tb_order.id_order = '$faktur' AND tb_order.id_customer = '$sesen_id_customer' 
								AND tb_order.status = 0 ");
// Jika tidak ditemukan maka akan muncul alert/ pemberitahuan
if(mysqli_num_rows($cek_faktur) == 0)
{
	header("location:keranjang.php");
}
	// Apabila ditemukan maka lanjut proses checkout dengan mengupdate status menjadi 1, tanggal checkout hari itu 
	// berdasarkan notransaksi dan username
	else
	{
		// Proses update
		$query = "UPDATE tb_order SET status = 1, tanggal = now(),  status_order = 'menunggu pembayaran'
							WHERE id_order = '$faktur' AND id_customer = '$sesen_id_customer' ";
		// Jika berhasil, maka akan diarahkan ke halaman transaksi selesai
		if(mysqli_query($conn,$query)) 
	  {
	  	header("location:$base_url"."transaksi_selesai.php");
	  }
	  	// Jika gagal, maka akan muncul alert
	  	else 
	  	{
	  		echo "<script>alert('Mohon maaf, Transaksi gagal. Mohon ulangi kembali');location.replace('keranjang.php')</script>";
	  	} 
	}
}

// Jika gagal, maka akan muncul alert
else 
{
	echo "<script>alert('Mohon maaf, Transaksi gagal. Mohon ulangi kembali');location.replace('keranjang.php')</script>";
} 



?>