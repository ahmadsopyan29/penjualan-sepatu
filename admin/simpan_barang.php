<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session


if(isset($_POST['simpan']))
{
  $nama_barang    = mysqli_real_escape_string($conn, $_POST['nama_barang']);
  $id_kategori    = mysqli_real_escape_string($conn, $_POST['id_kategori']);
  $keterangan      = mysqli_real_escape_string($conn, $_POST['keterangan']);
  $harga          = mysqli_real_escape_string($conn, $_POST['harga']);

  $cekdata = "SELECT nama_barang FROM tb_barang WHERE nama_barang = '$nama_barang' ";
  $ada     = mysqli_query($conn, $cekdata);
  if(mysqli_num_rows($ada) > 0)
  {
    echo "<script>alert('ERROR: Judul telah terdaftar, silahkan pakai Judul lain!');history.go(-1)</script>";
  }
    else
    {
      $allowed_ext  = array('jpg', 'jpeg', 'png', 'gif');
      $file_name    = $_FILES['img']['name']; // File adalah name dari tombol input pada form
      $file_ext     = strtolower(end(explode('.', $file_name)));
      $file_tmp     = $_FILES['img']['tmp_name'];
      $lokasi       = '../gambar/'.$file_name.'';
      $gambar = $file_name;
      

      if(in_array($file_ext, $allowed_ext) === true)
      {
        move_uploaded_file($file_tmp, $lokasi);
        // Proses insert data dari form ke db
        $sql = "INSERT INTO tb_barang (nama_barang,
                                    id_kategori,
                                    harga,
                                    gambar,
                                    keterangan
                                    
                                    )
                            VALUES ('$nama_barang',
                                    '$id_kategori',
                                    '$harga',
                                    '$gambar  ',
                                    '$keterangan'
                                    
                                    )";
        if(mysqli_query($conn, $sql))
        {
          echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('data_barang.php')</script>";
        }
          else
          {
            echo "Error updating record: " . mysqli_error($conn);
          }
      }
        else
        {
          echo "<script>alert('Jenis file tidak sesuai!');history.go(-1)</script>";
        }
    }
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
  }
?>
