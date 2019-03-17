<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum


if(isset($_POST['update']))
{
  $id_customer          = mysqli_real_escape_string($conn, $_POST['id_customer']);
  $username    = mysqli_real_escape_string($conn, $_POST['username']);
  $password      = mysqli_real_escape_string($conn, $_POST['password']);
  $nama_lengkap          = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
  $alamat          = mysqli_real_escape_string($conn, $_POST['alamat']);
  $email          = mysqli_real_escape_string($conn, $_POST['email']);
  $telepon          = mysqli_real_escape_string($conn, $_POST['telepon']);
  
 

  
  $sql = "UPDATE tb_customer SET 
                                    username = '$username',
                                    
                                    password = '$password',
                                    
                                    nama_lengkap = '$nama_lengkap',
                                    alamat = '$alamat',
                                    email = '$email',
                                    telepon = '$telepon' 
                            
                      WHERE id_customer     = '$id_customer' ";

  if(mysqli_query($conn, $sql))
  {
    echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('data_customer.php')</script>";
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
