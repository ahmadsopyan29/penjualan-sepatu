<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum


if(isset($_POST['update']))
{
  $id_barang          = mysqli_real_escape_string($conn, $_POST['id_barang']);
  $nama_barang    = mysqli_real_escape_string($conn, $_POST['nama_barang']);
  $keterangan      = mysqli_real_escape_string($conn, $_POST['keterangan']);
  $harga          = mysqli_real_escape_string($conn, $_POST['harga']);

  $allowed_ext    = array('jpg', 'jpeg', 'png', 'gif');
  $file_name      = $_FILES['img']['name']; // File adalah name dari tombol input pada form
  $file_ext       = strtolower(end(explode('.', $file_name)));
  $file_tmp       = $_FILES['img']['tmp_name'];
  $lokasi         = '../gambar/'.$file_name.'';
 

  if(!empty($file_tmp))
  {
    if(in_array($file_ext, $allowed_ext) === true)
    {
      //Hapus photo yang lama jika ada
      $del  = "SELECT gambar FROM tb_barang WHERE id_barang = '$id_barang' ";
      $res  = mysqli_query($conn, $del);
      $d    = mysqli_fetch_object($res);
      if(file_exists($d->gambar))
      {
        // Memutuskan koneksi file yang lama
        unlink($d->gambar);
      }
      move_uploaded_file($file_tmp, $lokasi);
      // Update photo dengan yang baru
      $update = "UPDATE tb_barang SET gambar = '$file_name' WHERE id_barang = '$id_barang' ";
      $upd = mysqli_query($conn, $update);
    }
      else
      {
        echo "<script>alert('Format file tidak sesuai!');history.go(-1)</script>";
      }
  }

  $sql = "UPDATE tb_barang SET 
                                    nama_barang = '$nama_barang',
                                    
                                    keterangan = '$keterangan',
                                    
                                    harga = '$harga' 
                            
                      WHERE id_barang     = '$id_barang' ";

  if(mysqli_query($conn, $sql))
  {
    echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('data_barang.php')</script>";
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
