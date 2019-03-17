<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum


if(isset($_POST['update']))
{
  $id_user          = mysqli_real_escape_string($conn, $_POST['id_user']);
  $username    = mysqli_real_escape_string($conn, $_POST['username']);
  $password      = mysqli_real_escape_string($conn, $_POST['password']);
  $nama_lengkap          = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
  $alamat          = mysqli_real_escape_string($conn, $_POST['alamat']);
  $email          = mysqli_real_escape_string($conn, $_POST['email']);
  $telepon          = mysqli_real_escape_string($conn, $_POST['telepon']);
  $level          = mysqli_real_escape_string($conn, $_POST['level']);
  
 

  
  $sql = "UPDATE tb_user SET 
                                    username = '$username',
                                    
                                    password = '$password',
                                    
                                    nama_lengkap = '$nama_lengkap',
                                    alamat = '$alamat',
                                    email = '$email',
                                    telepon = '$telepon',
                                    level = '$level' 
                            
                      WHERE id_user     = '$id_user' ";

  if(mysqli_query($conn, $sql))
  {
    echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('data_user.php')</script>";
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
