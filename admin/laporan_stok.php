<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

include '../fungsi/tgl_indo.php';         // Panggil fungsi merubah tanggal menjadi format seperti 2 Mei 2015
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title> Petshop | drh.Reny</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/fav.ico" />
    <!-- JS -->
    <?php include 'js.php'; ?>
    <!-- Data Tables -->
    <link href="template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
    <script src="template/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="template/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- Skrip Datatables -->
    <script type="text/javascript">
    $(document).ready( function () {
      $('#example1').DataTable();
    });
    </script>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include 'header.php'; ?>

      <div class="content-wrapper">
        <section class="content-header">
          <h1>Daftar Pembayaran</h1>
          
        </section>
        <section class="content">
        <div class="box">
        
          <div class="box-body table-responsive padding">
            
              <?php  
						
          $query1        = "SELECT * FROM tb_barang a 
                          JOIN tb_stok b ON a.id_barang = b.id_barang
                          JOIN tb_barang c ON b.id_barang = c.id_barang
                          JOIN tb_kategori d ON d.id_kategori = c.id_kategori
                          ORDER BY a.id_barang DESC";
          $hasil1        = mysqli_query($conn,$query1);

          
          if(mysqli_num_rows($hasil1) == 0)
          {echo "<center><h4> Data Tidak Ditemukan</h4></center>";}
            else
							{
					
            echo "
            
            <div class='panel-heading' align='center'>
            <a href='cetak_laporan_stok.php' target='_BLANK' class='btn btn-success'><i class='fa fa-print'></i> Cetak</a>
            </div>
            <table class='col-md-12 table-breturned table-striped table-condensed cf'>
      <thead class='cf'>
        <tr>
          <td align='center'>No.</td>
          <td align='center'>ID Barang</td>
          <td align='center'>Nama Barang</td>
          <td align='center'>Kategori</td>
          <td align='center'>Ukuran</td>
          <td align='center'>Stok</td>
          
          
        </tr>
      </thead>";

    $no = 1;
    while($data = mysqli_fetch_array($hasil1))
    {
      

      echo "
      <tbody>
        <tr>
          <td data-title='No.' align='center'>".$no."</td>
          <td data-title='Harga Diskon' align='center'>$data[id_barang]</td>
          <td data-title='Harga Diskon' align='center'>$data[nama_barang]</td>
          <td data-title='Harga Diskon' align='center'>$data[nama_kategori]</td>
          <td data-title='Harga Diskon' align='center'>$data[ukuran]</td>
          <td data-title='Harga Diskon' align='center'>$data[stok]</td>
          
          
          
        </tr>";
      $no++;
    }
					
            }
            
					?>
					
						
				
            </tbody>
          </table>
          
          </div>
        </div>
        </section>
        
      </div>

      <?php include "footer.php" ?>

    </div>

  </body>
</html>
