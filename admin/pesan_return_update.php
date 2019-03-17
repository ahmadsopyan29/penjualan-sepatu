<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum


if(isset($_POST['update']))
{
  $id_return          = mysqli_real_escape_string($conn, $_POST['id_return']);
  $status_return    = mysqli_real_escape_string($conn, $_POST['status_return']);

  $sql = "UPDATE tb_return SET 
                                    status_return = '$status_return'
                            
                      WHERE id_return     = '$id_return' ";

  if(mysqli_query($conn, $sql))
  {
    echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('pesan_return.php')</script>";
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
