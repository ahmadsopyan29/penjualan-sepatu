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
        

        <section class="content">
        <?php
          $id_barang        = mysqli_real_escape_string($conn, $_GET['id_barang']);
          $sql              = "SELECT * FROM tb_barang WHERE id_barang = $id_barang ";
          $result           = mysqli_query($conn, $sql);
          $data             = mysqli_fetch_array($result);
        ?>
        <form action="update_barang.php" method="post" enctype="multipart/form-data">
            <div class="row">
            

              <!-- right column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title"> Form Ubah Barang</h3>
              </div>
                  <div class="box-body">
                    <div class="row">
                      
                      <div class="col-xs-4"><label> Nama Barang</label>
                        <input class="form-control" name="id_barang" type="hidden" value="<?php echo $data['id_barang'] ?>"/>
                        <input class="form-control" name="nama_barang" type="text"  size="30" placeholder="Nama Barang" value="<?php echo $data['nama_barang'] ?>"/>
                      </div>
                      <div class="col-xs-5"><label> Deskripsi</label>
                        <input class="form-control" name="keterangan" type="text"  size="1000" placeholder="Deskripsi" value="<?php echo $data['keterangan'] ?>"/>
                      </div>
                      <div class="col-xs-3  "><label> Harga</label>
                        <input class="form-control" name="harga" type="text"  size="1000" placeholder="Harga" value="<?php echo $data['harga'] ?>"/>
                      </div>
                      <div class="col-xs-3  "><label> Kategori</label>
                      <select name="id_kategori" id="cmbkat" class="form-control" required>
                      <option value="">--Pilih Kategori--</option>
                          <?php
                          $query = "SELECT * FROM tb_kategori ORDER BY id_kategori";
                          $sql = mysqli_query($conn, $query);
                          while($data1 = mysqli_fetch_array($sql)){echo '<option value="'.$data1['id_katategori'].'">'.$data1['nama_kategori'].'</option>';}
                          ?>
                        </select>
                        </div>
                      
                    </div><br/>
                    
                    
                    <div class="form-group"><label>Gambar Sebelumnya</label>
                      <br/>
                      <?php echo "<img src='../gambar/".$data['gambar']."' width='150' height='150'>"; ?>
                    </div>
                    <div class="form-group"><label>Gambar Baru</label>
                      <input type="file" name="img" id="img" onchange="tampilkanPreview(this,'preview')"/>
                      <br><b>Preview Gambar</b><br>
                      <img id="preview" src="" alt="" width="50%"/>
                    </div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <a href="data_barang.php" class="btn btn-danger">
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
