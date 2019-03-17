<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session


if(isset($_POST['simpan']))
{
  
  $username    = mysqli_real_escape_string($conn, $_POST['username']);
  $password      = mysqli_real_escape_string($conn, $_POST['password']);
  $nama_lengkap          = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
  $alamat          = mysqli_real_escape_string($conn, $_POST['alamat']);
  $email          = mysqli_real_escape_string($conn, $_POST['email']);
  $telepon          = mysqli_real_escape_string($conn, $_POST['telepon']);
  $level          = mysqli_real_escape_string($conn, $_POST['level']);

  $cekdata = "SELECT username FROM tb_user WHERE username = '$username' ";
  $ada     = mysqli_query($conn, $cekdata);
  if(mysqli_num_rows($ada) > 0)
  {
    echo "<script>alert('ERROR: Username telah terdaftar, silahkan pakai Judul lain!');history.go(-1)</script>";
  }
    else
    {
      
        // Proses insert data dari form ke db
        $sql = "INSERT INTO tb_user (username,
                                    password,
                                    nama_lengkap,
                                    
                                    alamat,
                                    email,
                                    telepon,
                                    level)
                            VALUES ('$username',
                                    '$password',
                                    '$nama_lengkap',
                                    
                                    '$alamat',
                                    '$email',
                                    '$telepon',
                                    '$level')";
        if(mysqli_query($conn, $sql))
        {
          echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('data_user.php')</script>";
        }
          else
          {
            echo "Error updating record: " . mysqli_error($conn);
          }
      
    }
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
  }
?>
