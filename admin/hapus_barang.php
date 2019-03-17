<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum


$id_barang   = mysqli_real_escape_string($conn, $_GET['id_barang']);

$del_img  = "SELECT gambar FROM tb_barang WHERE id_barang = '$id_barang' ";
$res      = mysqli_query($conn, $del_img);
$data     = mysqli_fetch_array($res);
$img   		= $data['gambar'];
$tmpfile 	= "../gambar/$img";

$sql = "DELETE FROM tb_barang WHERE id_barang = '$id_barang' ";
if (mysqli_query($conn, $sql)) 
{
	unlink ($tmpfile);
  echo "<script>alert('Hapus data berhasil! Klik ok untuk melanjutkan');location.replace('data_barang.php')</script>"; 
}
  else 
  {
    echo "Error updating record: " . mysqli_error($conn);
  }
?>