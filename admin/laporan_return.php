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
          <form method="post" enctype="multipart/form-data">
                      <div class="col-xs-2"><label> Dari Tanggal</label>
                        <input class="form-control" name="dari" type="date" />
                        
                      </div>
                      <div class="col-xs-2"><label> Sampai Tanggal</label>
                        <input class="form-control" name="sampai" type="date"/>
                      </div>
                      <div class="col-xs-2  "><label> </label>
                      <button type="submit" name="periode" class="form-control btn btn-success"> Proses</button>
                      </div>
          </form>
          </div>
        </div>
        

        
        <div class="box">
        
          <div class="box-body table-responsive padding">
            
              <?php  
						if (isset($_POST['periode'])) {
              $dari = $_POST['dari'];
              $sampai = $_POST['sampai'];
          $query1        = "SELECT * FROM tb_return a 
                          JOIN detail_return b ON a.id_return = b.id_return
                          JOIN tb_barang c ON b.id_barang = c.id_barang
                          JOIN tb_customer d ON b.id_customer = d.id_customer
                          
                          WHERE a.tanggal BETWEEN '$dari' AND '$sampai'
                          AND a.status_return = 'selesai' ";
          $hasil1        = mysqli_query($conn,$query1);

          
          if(mysqli_num_rows($hasil1) == 0)
          {echo "<center><h4>Dari Tanggal = $dari Sampai Tanggal = $sampai <br> Dalam Periode Ini , Belum Ada Transaksi</h4></center>";}
            else
							{
					
            echo "
            
            <div class='panel-heading' align='center'>
            <a href='cetak_laporan_return.php?dari=$dari&&sampai=$sampai' target='_BLANK' class='btn btn-success'><i class='fa fa-print'></i> Cetak</a>
            </div>
            <table class='col-md-12 table-breturned table-striped table-condensed cf'>
      <thead class='cf'>
        <tr>
          <td align='center'>No.</td>
          <td align='center'>ID Return</td>
          <td align='center'>NO Invoice</td>
          <td align='center'>Tanggal</td>
          <td align='center'>Nama Barang</td>
          <td align='center'>Customer</td>
          <td align='center'>Status</td>
          
          
          <td align='center'>Jumlah</td>
          
        </tr>
      </thead>";

    $no = 1;
    while($data = mysqli_fetch_array($hasil1))
    {
      

      echo "
      <tbody>
        <tr>
          <td data-title='No.' align='center'>".$no."</td>
          <td data-title='Harga Diskon' align='center'>$data[id_return]</td>
          <td data-title='Harga Diskon' align='center'>$data[id_order]</td>
          <td data-title='Harga Diskon' align='center'>$data[tanggal]</td>
          <td data-title='Harga Diskon' align='center'>$data[nama_barang]</td>
          <td data-title='Harga Diskon' align='center'>$data[username]</td>
          <td data-title='Harga Diskon' align='center'>$data[status_return]</td>
          
          <td data-title='Harga Diskon' align='center'>$data[jumlah]</td>
          
          
        </tr>";
      $no++;
    }
					
            }
            $query        = "SELECT sum(jumlah) AS grandtotal FROM tb_return a 
                          JOIN detail_return b ON a.id_return = b.id_return
                          JOIN tb_barang c ON b.id_barang = c.id_barang
                          JOIN tb_customer d ON b.id_customer = d.id_customer
                          
                          WHERE a.tanggal BETWEEN '$dari' AND '$sampai'
                          AND a.status_return = 'selesai' ";
          $hasil        = mysqli_query($conn,$query);
          $data1 = mysqli_fetch_array($hasil);
          $subtotal     = $data1['grandtotal'];
          
          

          echo "
      
        <tr>
          <td data-title='No.' colspan='7' align='right'><b> TOTAL</b></td>
          
          <td data-title='Harga Diskon' align='center'><b>$subtotal</b></td>
          
          
        </tr>";
					?>
					<?php
						}?>
						
				
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
