<?php session_start();
include '../config.php';                // Panggil koneksi ke database
include '../fungsi/cek_login.php';      // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';    // Panggil fungsi cek session

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Ubah Data Produk | <?php include "title.php" ?></title>
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
          <h1>Ubah Data Kategori</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Kategori</li>
            <li class="active"><a href="#">Ubah Data Kategori</a></li>
          </ol>
        </section>

        <section class="content">
        <?php
          $id_kategori        = mysqli_real_escape_string($conn, $_GET['id_kategori']);
          $sql              = "SELECT * FROM tb_kategori WHERE id_kategori = $id_kategori ";
          $result           = mysqli_query($conn, $sql);
          $data             = mysqli_fetch_array($result);
        ?>
        <form action="update_kategori.php" method="post" enctype="multipart/form-data">
            <div class="row">
            

              <!-- right column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"> Form Ubah kategori</h3>
              </div>
                  <div class="box-body">
                    <div class="row">
                      
                      <div class="col-xs-4"><label> Nama Kategori</label>
                        <input class="form-control" name="id_kategori" type="hidden" value="<?php echo $data['id_kategori'] ?>"/>
                        <input class="form-control" name="nama_kategori" type="text"  size="30" placeholder="Nama kategori" value="<?php echo $data['nama_kategori'] ?>"/>
                      </div>
                      
                      
                    </div><br/>
                    
                   
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="data_kategori.php" class="btn btn-danger">
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
