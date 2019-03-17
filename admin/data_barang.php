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
          <h1>Data Barang <small><a href="tambah_barang.php">Tambah</a></small></h1>
          
        </section>

        <section class="content">
        <div class="box">
          <div class="box-body table-responsive padding">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="text-align: center">No.</th>
                  <th style="text-align: center">Nama Paket</th>
                  <th style="text-align: center">Gambar</th>
                  <th style="text-align: center">Kategori</th>
                  <th style="text-align: center">Deskripsi</th>
                  <th style="text-align: center">Harga</th>
                  <th style="text-align: center">Aksi</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $sql = "SELECT * FROM tb_barang JOIN tb_kategori ON tb_barang.id_kategori=tb_kategori.id_kategori ORDER BY id_barang ASC";
              $result = mysqli_query($conn, $sql);
              $no = 1;
              if (mysqli_num_rows($result) > 0)
              {
                while ($data = mysqli_fetch_array($result))
                {
                  echo "<tr>
                          <td valign='top' align='center'>".$no."</td>
                          <td style='text-align: left'>".$data['nama_barang']."</td>
                          
                          <td style='text-align: left'><img src='../gambar/".$data['gambar']."' width='90'></td>
                          <td style='text-align: left'>".$data['nama_kategori']."</td>
                          <td style='text-align: left'>".$data['keterangan']."</td>
                          <td style='text-align: left'>".$data['harga']."</td>
                          <td style='text-align: center'>
                            <a href='edit_barang.php?id_barang=$data[id_barang]'>
                              <button type='submit' class='btn btn-primary'>Ubah</button>
                            </a>
                            <a href='hapus_barang.php?id_barang=$data[id_barang]'>
                              <button type='submit' class='btn btn-danger' OnClick=\"return confirm('Apakah Anda yakin?');\">Hapus</button>
                            </a>
                          </td>
                        </tr>";
                        $no++;
                }
              }
              else
              {
                echo "Belum ada data";
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
