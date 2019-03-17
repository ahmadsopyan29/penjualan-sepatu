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
        <form action="simpan_barang.php" method="post" enctype="multipart/form-data">
            <div class="row">
            

              <!-- right column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"> Form Input Barang</h3>
              </div>
                  <div class="box-body">
                    <div class="row">
                      
                      <div class="col-xs-4"><label> Nama Barang</label>
                        <input class="form-control" name="nama_barang" type="text"  size="30" placeholder="Nama Barang" required/>
                      </div>
                      <div class="col-xs-5"><label> Deskripsi</label>
                        <input class="form-control" name="keterangan" type="text"  size="1000" placeholder="Deskripsi" required/>
                      </div>
                      <div class="col-xs-3  "><label> Harga</label>
                        <input class="form-control" name="harga" type="number"  size="1000" placeholder="Harga" required/>
                      </div>
                      <div class="col-xs-3  "><label> Kategori</label>
                      <select name="id_kategori" id="cmbkat" class="form-control" required>
                      <option value="">--Pilih Kategori--</option>
                          <?php
                          $query = "SELECT * FROM tb_kategori ORDER BY id_kategori";
                          $sql = mysqli_query($conn, $query);
                          while($data1 = mysqli_fetch_array($sql)){echo '<option value="'.$data1['id_kategori'].'">'.$data1['nama_kategori'].'</option>';}
                          ?>
                        </select>
                        </div>
                      
                    </div><br/>
                    
                    
                    <div class="form-group"><label> Gambar</label><br/>
                      <input type="file" name="img" id="img" onchange="tampilkanPreview(this,'preview')" required/>
                      <br><b>Preview Gambar</b><br>
                      <img id="preview" src="" alt="" width="35%"/>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="data_barang.php" class="btn btn-danger">
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