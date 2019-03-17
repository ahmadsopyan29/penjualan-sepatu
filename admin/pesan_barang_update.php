<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum


if(isset($_POST['update']))
{
  $id_order          = mysqli_real_escape_string($conn, $_POST['id_order']);
  $status_order    = mysqli_real_escape_string($conn, $_POST['status_order']);

  $sql = "UPDATE tb_order SET 
                                    status_order = '$status_order'
                            
                      WHERE id_order     = '$id_order' ";

  if(mysqli_query($conn, $sql))
  {
    echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('pesan_barang.php')</script>";
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
