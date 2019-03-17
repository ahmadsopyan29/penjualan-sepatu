<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session


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
        

        <section class="content">
        <form action="simpan_kategori.php" method="post" enctype="multipart/form-data">
            <div class="row">
            

              <!-- right column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"> Form Input Kategori</h3>
              </div>
                  <div class="box-body">
                    <div class="row">
                      
                      <div class="col-xs-4"><label> Nama Kategori</label>
                        <input class="form-control" name="nama_kategori" type="text"  size="30" placeholder="Nama Kategori" />
                      </div>
                      
                      
                    </div><br/>
                    
                    
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="data_kategori.php" class="btn btn-danger">
                    Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-success"> Simpan</button>
                    
                  </div>
                </div><!-- /.box -->
                <!-- right column -->
              </div>
            </div>
          </form>


        </section>
      </div>

      <?php include "footer.php" ?>

    </div>
    
  </body>
</html>