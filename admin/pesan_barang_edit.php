<?php session_start();
include '../config.php';                // Panggil koneksi ke database
include '../fungsi/cek_login.php';      // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';    // Panggil fungsi cek session

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
    
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include 'header.php'; ?>
      
      <div class="content-wrapper">
        <section class="content-header">
          
          
        </section>

        <section class="content">
        <?php
          $id_order       = mysqli_real_escape_string($conn, $_GET['id_order']);
          $sql              = "SELECT * FROM tb_order WHERE id_order= $id_order";
          $result           = mysqli_query($conn, $sql);
          $data             = mysqli_fetch_array($result);
        ?>
        <form action="pesan_barang_update.php" method="post" enctype="multipart/form-data">
            <div class="row">
            

              <!-- right column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"> Form Edit status Order</h3>
              </div>
                  <div class="box-body">
                    <div class="row">
                      
                      <div class="col-xs-4"><label> Id Transaksi</label>
                        <input class="form-control" name="id_order" type="text" value="<?php echo $data['id_order'] ?>" readonly/>
                        
                      </div>
                      <div class="col-xs-5"><label> Status Order</label>
                      <select name="status_order" class="form-control">
                      <?php
                      $status=$data['status_order'];
                          if ($status== "menunggu pembayaran") echo "<option value='menunggu pembayaran' selected>menunggu  pembayaran</option>";
                          else echo "<option value='menunggu pembayaran'>menunggu pembayaran</option>";
                          if ($status== "sedang di proses") echo "<option value='sedang di proses' selected>sedang di proses</option>";
                          else echo "<option value='sedang di proses'>sedang di proses</option>";
                          if ($status== "selesai") echo "<option value='selesai' selected>selesai</option>";
                          else echo "<option value='selesai'>selesai</option>";
                                                
                      ?>
                      </select>
                      </div>
                      
                      
                    </div><br/>
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="pesan_barang.php" class="btn btn-danger">
                    Kembali</a>
                    <button type="submit" name="update" class="btn btn-success"> Simpan</button>
                    
                  </div>
                </div><!-- /.box -->
                <!-- right column -->
              </div>
            </div>
          </form>

          <?php
          include "../fungsi/imgpreview.php"; // Preview gambar yang akan diupload
          
          ?>
          
                    
        </section>
      </div>

      <?php include "footer.php" ?>

    </div>
    
  </body>
</html>
