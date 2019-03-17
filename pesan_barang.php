<?php                   // Memulai session
include 'navbar.php';  
include 'faktur.php';
include "fungsi/cek_login_public.php";
                 // Panggil koneksi ke database
?>
<?php 
if(isset($_POST['pesan_barang']))
{
  $ukuran       = $_POST['ukuran'];
  $jumlah       = $_POST['jumlah'];
  $id_barang = $_GET['id_barang'];

  

    $cari_barang  = "SELECT * FROM tb_barang WHERE id_barang = '$id_barang' ";
    $hasil_barang = mysqli_query($conn, $cari_barang);
    $data_barang  = mysqli_fetch_array($hasil_barang);
    
    $id_barang  = $data_barang['id_barang'];
    $nama_barang  = $data_barang['nama_barang'];
    $harga  = $data_barang['harga'];
    $subtotal = $harga * $jumlah;
  
  // cek data
  $sql ="SELECT * FROM tb_stok WHERE ukuran ='$ukuran' AND stok < '$jumlah' AND id_barang='$id_barang';";
  $cek_stok  = mysqli_query($conn,$sql);
  if(mysqli_num_rows($cek_stok) > 0)
  {
    // Alert/ pemberitahuan email yang dipakai telah ada/ tidak
    echo "<script>alert(' Jumlah Yang Anda Masukkan Melebihi Stok');history.go(-1)</script>";
  }

  else {
    $cari_transaksi   = "SELECT * FROM detail_order WHERE id_customer = '$sesen_id_customer'
                          AND id_barang = '$id_barang' AND id_order = '$faktur' AND ukuran = '$ukuran'";
      $hasil_transaksi  = mysqli_query($conn,$cari_transaksi);
      $data_transaksi   = mysqli_fetch_array($hasil_transaksi);

      if(mysqli_num_rows($hasil_transaksi) == 0)
      {

            $query1 = "INSERT INTO detail_order (id_order,
                                                    id_customer,
                                                    id_barang,
                                                    ukuran,
                                                    jumlah,
                                                    subtotal)
                                            VALUES ('$faktur',
                                                    '$sesen_id_customer',
                                                    '$id_barang',
                                                    '$ukuran',
                                                    '$jumlah',
                                                    '$subtotal')";
    
            if(mysqli_query($conn, $query1))
            {
              $cari_stok  = "SELECT * FROM tb_stok WHERE id_barang = '$id_barang' AND ukuran = '$ukuran' ";
              $hasil_stok = mysqli_query($conn, $cari_stok);
              $data_stok  = mysqli_fetch_array($hasil_stok);
              
              $stok = $data_stok['stok'];
              $stokbaru = $stok - $jumlah;

              $query = "UPDATE tb_stok SET stok = '$stokbaru'
              WHERE id_barang = '$id_barang' AND ukuran='$ukuran' ";

              if(mysqli_query($conn, $query)){
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Barang Berhasil DiTambahkan Ke Keranjang!');\n";
                echo "window.location='keranjang.php'";
                echo "</script>";
               } else
              {
                echo "Error updating record: " . mysqli_error($conn);
              }
            }
              else
              {
                echo "Error updating record: " . mysqli_error($conn);
              }
              
              
            
      }else{
              $jmllama          = $data_transaksi['jumlah'];
              $jmltambah        = $jmllama + $jumlah;
              $subtotaltambah   = $jmltambah * $harga;
    
              $sql ="SELECT * FROM tb_stok WHERE ukuran ='$ukuran' AND stok < '$jumlah' AND id_barang='$id_barang';";
              $cek_stok  = mysqli_query($conn,$sql);
              if(mysqli_num_rows($cek_stok) > 0)
              {
                // Alert/ pemberitahuan email yang dipakai telah ada/ tidak
                echo "<script>alert(' Jumlah Yang Anda Masukkan Ditambah Barang Yang Sama Di Keranjang Anda Melebihi Stok, Silahkan Cek Keranjang Anda');history.go(-1)</script>";
              }else{

    
              $query = "UPDATE detail_order SET jumlah        = '$jmltambah',
                                                    
                                                    subtotal      = '$subtotaltambah'
                                              WHERE id_order  = '$faktur' AND id_barang= '$id_barang' AND ukuran='$ukuran'";
    
              if(mysqli_query($conn, $query))
              {
                $cari_stok  = "SELECT * FROM tb_stok WHERE id_barang = '$id_barang' AND ukuran = '$ukuran' ";
                $hasil_stok = mysqli_query($conn, $cari_stok);
                $data_stok  = mysqli_fetch_array($hasil_stok);
                
                $stok = $data_stok['stok'];
                $stokbaru = $stok - $jumlah;

                $query = "UPDATE tb_stok SET stok = '$stokbaru'
                WHERE id_barang = '$id_barang' AND ukuran='$ukuran' ";

                if(mysqli_query($conn, $query)){
                  echo "<script language=\"JavaScript\">\n";
                  echo "alert('Barang Berhasil DiTambahkan Ke Keranjang!');\n";
                  echo "window.location='keranjang.php'";
                  echo "</script>";
                } else
                {
                  echo "Error updating record: " . mysqli_error($conn);
                }
              }
                else
                {
                  echo "Error updating record: " . mysqli_error($conn);
                }
            }
         
          }     
        
  }

}else{
echo "<script>alert('Barang yang ingin Anda beli tidak ada');location.replace('$base_url')</script>";}
?>


  
 <?php                   // Memulai session
include 'footer.php';                     // Panggil koneksi ke database
?>

