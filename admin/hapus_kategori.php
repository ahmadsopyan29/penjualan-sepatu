<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum


$id_kategori   = mysqli_real_escape_string($conn, $_GET['id_kategori']);


$sql = "DELETE FROM tb_kategori WHERE id_kategori = '$id_kategori' ";
if (mysqli_query($conn, $sql)) 
{
	
  echo "<script>alert('Hapus data berhasil! Klik ok untuk melanjutkan');location.replace('data_kategori.php')</script>"; 
}
  else 
  {
    echo "Error updating record: " . mysqli_error($conn);
  }
?>