<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum


$id_paket_grooming   = mysqli_real_escape_string($conn, $_GET['id_paket_grooming']);

$del_img  = "SELECT gambar FROM paket_grooming WHERE id_paket_grooming = '$id_paket_grooming' ";
$res      = mysqli_query($conn, $del_img);
$data     = mysqli_fetch_array($res);
$img   		= $data['gambar'];
$tmpfile 	= "../gambar/$img";

$sql = "DELETE FROM paket_grooming WHERE id_paket_grooming = '$id_paket_grooming' ";
if (mysqli_query($conn, $sql)) 
{
	unlink ($tmpfile);
  echo "<script>alert('Hapus data berhasil! Klik ok untuk melanjutkan');location.replace('paket_grooming.php')</script>"; 
}
  else 
  {
    echo "Error updating record: " . mysqli_error($conn);
  }
?>