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
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="text-align: center">No.</th>
                  <th style="text-align: center">Id Transaksi</th>
                  <th style="text-align: center">Nama Pengirim</th>
                  <th style="text-align: center">Nama Bank</th>
                  <th style="text-align: center">No Rekening Pengirim</th>
                  <th style="text-align: center">Jumlah Transfer</th>
                  <th style="text-align: center">Gambar</th>
                  <th style="text-align: center">Nama Customer</th>
                  <th style="text-align: center">Aksi</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $sql = "SELECT * FROM konfirmasi_pembayaran a JOIN tb_customer b ON a.id_customer=b.id_customer ORDER BY id_konfirmasi ASC";
              $result = mysqli_query($conn, $sql);
              $no = 1;
              if (mysqli_num_rows($result) > 0)
              {
                while ($data = mysqli_fetch_array($result))
                {
                  echo "<tr>
                          <td valign='top' align='center'>".$no."</td>
                          <td style='text-align: left'>".$data['id_transaksi']."</td>
                          <td style='text-align: left'>".$data['nama_pengirim']."</td>
                          <td style='text-align: left'>".$data['nama_bank']."</td>
                          <td style='text-align: left'>".$data['no_rek_pengirim']."</td>
                          <td style='text-align: left'>".$data['jumlah_transfer']."</td>
                          <td style='text-align: left'><img src='../gambar/".$data['gambar']."' width='90'></td>
                          <td style='text-align: left'>".$data['username']."</td>
                          <td style='text-align: center'>
                            <a href='data_pembayaran_edit.php?id_konfirmasi=$data[id_konfirmasi]'>
                              <button type='submit' class='btn btn-primary'>Ubah</button>
                            </a>
                            <a href='data_pembayaran_hapus.php?id_konfirmasi=$data[id_konfirmasi]'>
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
