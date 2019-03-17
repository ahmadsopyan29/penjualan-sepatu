<?php session_start(); 										// Memulai session
include 'config.php'; 										// Memanggil koneksi ke database
include 'faktur_return.php'; 									// Memanggil faktur
include 'fungsi/base_url.php';  					// Memanggil fungsi base_url
include 'fungsi/cek_session_public.php'; 	// Memanggil fungsi cek_session_public
include 'fungsi/cek_login_public.php';  	// Memanggil fungsi cek_login_public

// Cek faktur pembelian berdasarkan notransaksi, username, dan status
	
$cek_faktur 	= mysqli_query($conn,"SELECT * FROM detail_return
								LEFT JOIN tb_return ON tb_return.id_return = detail_return.id_return
								WHERE tb_return.id_return = '$faktur' AND tb_return.id_customer = '$sesen_id_customer' 
								AND tb_return.status = 0 ");
// Jika tidak ditemukan maka akan muncul alert/ pemberitahuan
if(mysqli_num_rows($cek_faktur) == 0)
{
	header("location:return.php");
}
	// Apabila ditemukan maka lanjut proses checkout dengan mengupdate status menjadi 1, tanggal checkout hari itu 
	// berdasarkan notransaksi dan username
	else
	{
		// Proses update
		$query = "UPDATE tb_return SET status = 1, tanggal = now(),  status_return = 'menunggu pengiriman'
							WHERE id_return = '$faktur' AND id_customer = '$sesen_id_customer' ";
		// Jika berhasil, maka akan diarahkan ke halaman transaksi selesai
		if(mysqli_query($conn,$query)) 
	  {
	  	header("location:$base_url"."return_selesai.php");
	  }
	  	// Jika gagal, maka akan muncul alert
	  	else 
	  	{
	  		echo "<script>alert('Mohon maaf, Transaksi gagal. Mohon ulangi kembali');location.replace('return.php')</script>";
	  	} 
	}

 



?>