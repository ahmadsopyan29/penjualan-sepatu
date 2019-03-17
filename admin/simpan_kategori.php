<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session


if(isset($_POST['simpan']))
{
  $nama_kategori   = mysqli_real_escape_string($conn, $_POST['nama_kategori']);
  

  $cekdata = "SELECT nama_kategori FROM tb_kategori WHERE nama_kategori = '$nama_kategori' ";
  $ada     = mysqli_query($conn, $cekdata);
  if(mysqli_num_rows($ada) > 0)
  {
    echo "<script>alert('ERROR: Judul telah terdaftar, silahkan pakai Judul lain!');history.go(-1)</script>";
  }
    else
    {
      
        // Proses insert data dari form ke db
        $sql = "INSERT INTO tb_kategori (nama_kategori)
                            VALUES ('$nama_kategori')";
        if(mysqli_query($conn, $sql))
        {
          echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('data_kategori.php')</script>";
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
