<?php session_start();
include '../config.php';                // Panggil koneksi ke database
include '../fungsi/cek_login.php';      // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';    // Panggil fungsi cek session

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Ubah Data Produk </title>
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
          <h1>Input Data User</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>User</li>
            <li class="active"><a href="#">Input Data User</a></li>
          </ol>
        </section>

        <section class="content">
        
        <form action="data_user_simpan.php" method="post" enctype="multipart/form-data">
            <div class="row">
            

              <!-- right column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"> Form Input Data User</h3>
              </div>
                  <div class="box-body">
                    <div class="row">
                      
                      <div class="col-xs-4"><label> Username</label>
                        
                        <input class="form-control" name="username" type="text"  size="30" placeholder="Username" "/>
                      </div>
                      <div class="col-xs-5"><label> Password</label>
                        <input class="form-control" name="password" type="password"  size="1000" placeholder="Password" />
                      </div>
                      <div class="col-xs-3  "><label> Nama Lengkap</label>
                        <input class="form-control" name="nama_lengkap" type="text"  size="1000" placeholder="Nama Lengkap" />
                      </div>
                      
                    </div><br/>
                    <div class="col-xs-4"><label> Alamat</label>
                      
                        <input class="form-control" name="alamat" type="text"  size="30" placeholder="Alamat" />
                      </div>
                      <div class="col-xs-5"><label> Email</label>
                        <input class="form-control" name="email" type="text"  size="1000" placeholder="Email" />
                      </div>
                      <div class="col-xs-3  "><label> Telepon</label>
                        <input class="form-control" name="telepon" type="text"  size="1000" placeholder="Telepon" />
                      </div>
                      <div class="col-xs-3  "><label> Level</label>
                      <select class="form-control" name="level" required>
                          <option value='admin'> Admin</option>
					                <option value='pemilik'> Pimilik</option>
                    
                      </select>
                      </div>
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="data_customer.php" class="btn btn-danger">
                    Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-success"> Simpan</button>
                    
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
