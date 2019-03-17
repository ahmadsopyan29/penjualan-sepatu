<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session


if(isset($_POST['simpan']))
{
  $id_barang   = mysqli_real_escape_string($conn, $_POST['id_barang']);
  $ukuran   = mysqli_real_escape_string($conn, $_POST['ukuran']);
  $stok   = mysqli_real_escape_string($conn, $_POST['stok']);
  

  $cekdata = "SELECT id_barang,ukuran FROM tb_stok WHERE id_barang = '$id_barang' AND ukuran ='$ukuran' ";
  $ada     = mysqli_query($conn, $cekdata);
  if(mysqli_num_rows($ada) > 0)
  {
      $cari2        = "SELECT stok FROM tb_stok WHERE id_barang = '$id_barang' AND ukuran ='$ukuran' ";
      $hasil2       = mysqli_query($conn,$cari2);
      $data2        = mysqli_fetch_array($hasil2);

      $stok2         = $data2['stok'];
      $stokk = $stok2 + $stok;
    // Proses insert data dari form ke db
    $sql = "UPDATE tb_stok SET stok = '$stokk'      
                      WHERE id_barang = '$id_barang' AND ukuran ='$ukuran' ";
          if(mysqli_query($conn, $sql))
          {
          echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('data_stok.php')</script>";
          }
          else
          {
          echo "Error updating record: " . mysqli_error($conn);
          }
  }
    else
    {
      
        // Proses insert data dari form ke db
        $sql = "INSERT INTO tb_stok (id_barang,stok,ukuran)
                            VALUES ('$id_barang','$stok','$ukuran')";
        if(mysqli_query($conn, $sql))
        {
          echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('data_stok.php')</script>";
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
