<?php session_start();
include "config.php";
include "faktur.php";
include "fungsi/base_url.php";
include "fungsi/cek_session_public.php";
include "fungsi/cek_login_public.php";

$cek    = "SELECT * FROM tb_order WHERE id_customer = '$sesen_id_customer' AND status = '0' ";
$hasil  = mysqli_query($conn,$cek);
$data   = mysqli_fetch_array($hasil);

$n      = $_POST['n'];

if(isset($_POST['update']))
{
  if(mysqli_num_rows($hasil) == 0)
  {
    echo "<script>alert('Transaksi tidak ditemukan');location.replace('$base_url')</script>";
  }
    $faktur = $data['id_order'];

    for ($i=1; $i<=$n; $i++)
    {
      $id_barang  = $_POST['id'.$i];

      $cari2        = "SELECT * FROM tb_barang WHERE id_barang = '$id_barang' ";
      $hasil2       = mysqli_query($conn,$cari2);
      $data2        = mysqli_fetch_array($hasil2);

      $harga = $data2['harga'];
      

      if(mysqli_num_rows($hasil2) > 0)
      {
        $jmlubah  = $_POST['jumlah'.$i];
        $ukuran  = $_POST['ukuran'.$i];
        $totubah  = $jmlubah * $harga;
    
              $sql ="SELECT * FROM tb_stok WHERE ukuran ='$ukuran' AND stok < '$jmlubah' AND id_barang='$id_barang';";
              $cek_stok  = mysqli_query($conn,$sql);
              if(mysqli_num_rows($cek_stok) > 0)
              {
                
                echo "<script>alert(' Jumlah Melebihi Stok');history.go(-1)</script>";
              }else{
            $query = "UPDATE detail_order SET jumlah        = '$jmlubah',
                                                  
                                                  subtotal      = '$totubah'
                                            WHERE id_order   = '$faktur'
                                            AND   id_customer      = '$sesen_id_customer'
                                            AND   id_barang    = '$id_barang' ";

            if(mysqli_query($conn, $query))
            {
              echo "<script language=\"JavaScript\">\n";
                echo "alert('Jumlah Berhasil DI Update!');\n";
                echo "window.location='keranjang.php'";
                echo "</script>";
            }
            else
            {
              echo "Error updating record: " . mysqli_error($conn);
            }
          }
        }
        else
        {
          echo "<script>alert('Barang yang ingin Anda beli tidak ditemukan');location.replace('index.php')</script>";
        }
      }
    
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya!');location.replace('keranjang.php')</script>";
  }
?>
