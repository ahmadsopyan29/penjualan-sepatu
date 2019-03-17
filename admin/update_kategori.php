<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum


if(isset($_POST['update']))
{
  $id_kategori          = mysqli_real_escape_string($conn, $_POST['id_kategori']);
  $nama_kategori    = mysqli_real_escape_string($conn, $_POST['nama_kategori']);


  $sql = "UPDATE tb_kategori SET 
                                    nama_kategori = '$nama_kategori'
                                    
                                     
                            
                      WHERE id_kategori     = '$id_kategori' ";

  if(mysqli_query($conn, $sql))
  {
    echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('data_kategori.php')</script>";
  }
    else
    {
      echo "Error updating record: " . mysqli_error($conn);
    }
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
  }
?>
